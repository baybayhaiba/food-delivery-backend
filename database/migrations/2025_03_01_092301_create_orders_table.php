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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng users (khách hàng)
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng restaurants
            $table->decimal('total_amount', 10, 2); // Tổng tiền đơn hàng
            $table->string('shipping_address'); // Địa chỉ giao hàng
            $table->string('phone_number');     // Số điện thoại giao hàng
            $table->enum('status', ['pending', 'confirmed', 'delivering', 'completed', 'cancelled'])->default('pending'); // Trạng thái đơn hàng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
