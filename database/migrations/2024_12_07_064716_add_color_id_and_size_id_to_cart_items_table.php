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
        // Kiểm tra xem cột color_id đã tồn tại chưa, nếu chưa thì thêm
        if (!Schema::hasColumn('cart_items', 'color_id')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->unsignedInteger('color_id')->after('product_id');
            });
        }
    
        // Kiểm tra xem cột size_id đã tồn tại chưa, nếu chưa thì thêm
        if (!Schema::hasColumn('cart_items', 'size_id')) {
            Schema::table('cart_items', function (Blueprint $table) {
                $table->unsignedInteger('size_id')->after('color_id');
            });
        }
    }
    
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('color_id');
            $table->dropColumn('size_id');
        });
    }
    
};
