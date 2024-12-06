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
    Schema::table('cart_items', function (Blueprint $table) {
        // Thêm các cột color_id và size_id
        $table->unsignedInteger('color_id')->nullable()->after('product_id');
        $table->unsignedInteger('size_id')->nullable()->after('color_id');
        
        // Tạo khóa ngoại cho color_id và size_id
        $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('set null');
        $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('cart_items', function (Blueprint $table) {
        // Xóa khóa ngoại và cột khi rollback
        $table->dropForeign(['color_id']);
        $table->dropForeign(['size_id']);
        $table->dropColumn(['color_id', 'size_id']);
    });
}

};
