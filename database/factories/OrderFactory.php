<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::where('role', 'customer')->inRandomOrder()->first()->id; // Lấy user customer ngẫu nhiên
            },
            'restaurant_id' => function () {
                return Restaurant::inRandomOrder()->first()->id; // Lấy restaurant ngẫu nhiên
            },
            'total_amount' => fake()->randomFloat(2, 20, 200), // Tổng tiền ngẫu nhiên từ 20 đến 200
            'shipping_address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'delivering', 'completed', 'cancelled']), // Trạng thái ngẫu nhiên
        ];
    }
}
