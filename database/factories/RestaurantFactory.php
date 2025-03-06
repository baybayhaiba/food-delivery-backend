<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'opening_time' => fake()->time('H:i'),
            'closing_time' => fake()->time('H:i'),
            'image' => 'https://via.placeholder.com/200x150.png?text=Restaurant', // Ảnh placeholder
        ];
    }
}
