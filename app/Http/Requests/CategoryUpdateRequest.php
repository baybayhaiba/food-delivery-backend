<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Phân quyền có thể thêm ở đây, tạm thời cho phép
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
        ];
    }
}
