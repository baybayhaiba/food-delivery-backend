<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Phân quyền có thể thêm ở đây, tạm thời cho phép
    }

    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'shipping_address' => 'required|string',
            'phone_number' => 'required|string',
            'items' => 'required|array|min:1', // Ít nhất 1 item trong đơn hàng
            'items.*.dish_id' => 'required|exists:dishes,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }
}
