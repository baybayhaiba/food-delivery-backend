<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2); // Giá tiền
            $table->string('image')->nullable(); // Đường dẫn ảnh món ăn
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng categories
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng restaurants
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
