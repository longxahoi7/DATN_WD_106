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
        // Kiểm tra nếu cột chưa tồn tại thì thêm
        if (!Schema::hasColumn('cart_items', 'color_id')) {
            Schema::table('table_name', function (Blueprint $table) {
                $table->unsignedBigInteger('color_id')->nullable(); // Có thể thêm 'nullable()' nếu cần
            });
        }
    }

    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
            $table->dropForeign(['size_id']);
            $table->dropColumn('size_id');
        });
    }
};
