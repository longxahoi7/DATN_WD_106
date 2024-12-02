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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_hot')->default(false); // Đánh dấu sản phẩm hot
            $table->boolean('is_sale')->default(false); // Đánh dấu sản phẩm đang sale
            $table->unsignedBigInteger('sold_count')->default(0); // Số lượng đã bán
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['is_hot', 'is_sale', 'sold_count']);
        });
    }
};
