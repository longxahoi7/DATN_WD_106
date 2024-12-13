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
            $table->unsignedInteger('color_id')->after('product_id');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('cascade');
    
            $table->unsignedInteger('size_id')->after('color_id');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });
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
