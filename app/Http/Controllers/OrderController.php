<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Http\Resources\OrderResource; // Giả sử bạn tạo OrderResource
use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade để dùng transactions

class OrderController extends Controller
{
    public function store(OrderStoreRequest $request)
    {
        // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
        return DB::transaction(function () use ($request) {
            $totalAmount = 0;
            $orderItemsData = [];

            // Tính tổng tiền và chuẩn bị dữ liệu order items
            foreach ($request->items as $itemData) {
                $dish = Dish::findOrFail($itemData['dish_id']);
                $quantity = $itemData['quantity'];
                $itemPrice = $dish->price; // Giá tại thời điểm đặt hàng
                $totalAmount += $itemPrice * $quantity;
                $orderItemsData[] = [
                    'dish_id' => $dish->id,
                    'quantity' => $quantity,
                    'price' => $itemPrice, // Lưu giá tại thời điểm đặt hàng
                ];
            }

            // Tạo order
            $order = Order::create([
                'user_id' => auth()->id(), // Giả sử user đã đăng nhập
                'restaurant_id' => $request->restaurant_id,
                'shipping_address' => $request->shipping_address,
                'phone_number' => $request->phone_number,
                'total_amount' => $totalAmount,
                'status' => 'pending', // Trạng thái mặc định khi tạo đơn hàng
            ]);

            // Tạo order items
            $order->orderItems()->createMany($orderItemsData);

            // return new OrderResource($order); // Nếu có OrderResource
            return response()->json($order, 201); // Tạm thời trả về JSON đơn giản
        });
    }

    public function history()
    {
        $orders = Order::where('user_id', auth()->id())->paginate(10);
        // return OrderResource::collection($orders); // Nếu có OrderResource
        return response()->json($orders); // Tạm thời trả về JSON đơn giản
    }

    // ... (Thêm các actions khác như index, show, updateStatus cho admin nếu cần) ...
}
