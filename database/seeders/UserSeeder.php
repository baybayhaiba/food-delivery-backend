<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo user admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Mật khẩu 'password'
            'role' => 'admin',
            'phone_number' => '123-456-7890',
            'address' => 'Admin Address',
        ]);

        // Tạo thêm user khách hàng mẫu
        User::factory()->count(20)->create(); // Tạo 20 user khách hàng mẫu
    }
}
