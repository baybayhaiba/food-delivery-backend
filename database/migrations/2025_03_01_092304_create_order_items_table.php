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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng orders
            $table->foreignId('dish_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng dishes
            $table->integer('quantity');        // Số lượng món ăn
            $table->decimal('price', 10, 2);    // Giá của món ăn tại thời điểm đặt hàng (có thể khác giá hiện tại)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
