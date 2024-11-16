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
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('coupon_id');
            $table->string('code')->unique();
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('min_order_value', 10, 2)->nullable(); // Giá trị tối thiểu của đơn hàng
            $table->decimal('max_order_value', 10, 2)->nullable(); // Giá trị tối đa của đơn hàng
            $table->text('condition')->nullable();
            $table->boolean('is_public')->default(true); // Công khai hoặc cá nhân
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
