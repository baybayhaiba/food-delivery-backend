<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pizza'],
            ['name' => 'Burger'],
            ['name' => 'Sushi'],
            ['name' => 'Mì Ý'],
            ['name' => 'Đồ uống'],
            ['name' => 'Tráng miệng'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
