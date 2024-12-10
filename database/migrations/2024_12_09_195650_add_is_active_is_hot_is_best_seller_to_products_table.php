<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Thêm các cột
            $table->boolean('is_active')->default(true);  // Mặc định là 'active'
            $table->boolean('is_hot')->default(false);    // Mặc định là 'không hot'
            $table->boolean('is_best_seller')->default(false);  // Mặc định là 'không phải bán chạy'
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Xóa các cột nếu rollback migration
            $table->dropColumn('is_active');
            $table->dropColumn('is_hot');
            $table->dropColumn('is_best_seller');
        });
    }
};