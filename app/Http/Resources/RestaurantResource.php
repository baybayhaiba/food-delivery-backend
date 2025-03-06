<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'opening_time' => $this->opening_time ? $this->opening_time->format('H:i') : null, // Format time nếu có
            'closing_time' => $this->closing_time ? $this->closing_time->format('H:i') : null, // Format time nếu có
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Thêm các trường khác bạn muốn hiển thị trong API response
        ];
    }
}
