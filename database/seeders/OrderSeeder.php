<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'customer')->get(); // Chỉ lấy user khách hàng
        $restaurants = Restaurant::all();

        foreach ($users as $user) {
            $restaurants->each(function ($restaurant) use ($user) {
                Order::factory()->count(2)->create([ // Mỗi user đặt 2 đơn hàng từ mỗi nhà hàng
                    'user_id' => $user->id,
                    'restaurant_id' => $restaurant->id,
                ]);
            });
        }
    }
}
