<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Phân quyền có thể thêm ở đây, tạm thời cho phép
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'image' => 'nullable|string',
            'category_id' => 'exists:categories,id',
            'restaurant_id' => 'exists:restaurants,id',
        ];
    }
}
