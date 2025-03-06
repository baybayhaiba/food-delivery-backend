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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết với bảng orders
            $table->string('payment_method'); // Phương thức thanh toán (VNPay, Momo, Cash, ...)
            $table->string('transaction_id')->nullable(); // Mã giao dịch từ cổng thanh toán
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending'); // Trạng thái thanh toán
            $table->decimal('amount', 10, 2); // Số tiền thanh toán
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
