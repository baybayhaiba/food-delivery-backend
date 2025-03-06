<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 5, 50), // Giá từ 5 đến 50
            'image' => 'https://via.placeholder.com/100x100.png?text=Dish', // Ảnh placeholder
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id; // Lấy category ngẫu nhiên
            },
            'restaurant_id' => function () {
                return Restaurant::inRandomOrder()->first()->id; // Lấy restaurant ngẫu nhiên
            },
        ];
    }
}
