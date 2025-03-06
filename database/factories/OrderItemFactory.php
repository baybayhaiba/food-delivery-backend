<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => function () {
                return Order::inRandomOrder()->first()->id; // Lấy order ngẫu nhiên
            },
            'dish_id' => function () {
                return Dish::inRandomOrder()->first()->id; // Lấy dish ngẫu nhiên
            },
            'quantity' => fake()->numberBetween(1, 5), // Số lượng ngẫu nhiên từ 1 đến 5
            'price' => function (array $attributes) {
                // Lấy giá dish tại thời điểm tạo order item (có thể khác giá hiện tại)
                return Dish::find($attributes['dish_id'])->price;
            },
        ];
    }
}
