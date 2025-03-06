<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RestaurantSeeder::class,
            CategorySeeder::class,
            DishSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}
