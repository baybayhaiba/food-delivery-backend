<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        foreach ($restaurants as $restaurant) {
            $categories->each(function ($category) use ($restaurant) {
                Dish::factory()->count(3)->create([ // Mỗi category 3 món cho mỗi nhà hàng
                    'restaurant_id' => $restaurant->id,
                    'category_id' => $category->id,
                ]);
            });
        }
    }
}
