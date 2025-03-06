<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Phân quyền có thể thêm ở đây, tạm thời cho phép
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
    }
}
