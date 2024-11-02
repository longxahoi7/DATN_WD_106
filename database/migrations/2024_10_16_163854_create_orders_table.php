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
            $table->increments('order_id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamp('order_date');
            $table->enum('status', [
                'pending',
                'processing',
                'shipped',
                'delivered',
                'cancelled',
                'completed',
            ])->default('pending');
            $table->decimal('total', 10, 2);
            $table->timestamp('invoice_date')->nullable();
            $table->enum('payment_status', [
                'pending',     // Đang chờ xử lý
                'paid',        // Đã thanh toán
                'failed',      // Thanh toán thất bại
                'refunded',    // Đã hoàn tiền
                'cancelled',   // Đã hủy
                'authorized',  // Đã xác thực nhưng chưa thanh toán
            ])->default('pending');
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
