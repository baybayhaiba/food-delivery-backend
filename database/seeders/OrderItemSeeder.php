<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            $dishes = Dish::inRandomOrder()->limit(rand(1, 5))->get(); // Chọn ngẫu nhiên 1-5 món
            foreach ($dishes as $dish) {
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'dish_id' => $dish->id,
                    'price' => $dish->price, // Lưu giá tại thời điểm đặt hàng
                    'quantity' => rand(1, 3), // Số lượng ngẫu nhiên 1-3
                ]);
            }
        }
    }
}
