<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantUpdateRequest extends FormRequest
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
            'address' => 'string',
            'phone_number' => 'nullable|string',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',
            'image' => 'nullable|string',
        ];
    }
}
