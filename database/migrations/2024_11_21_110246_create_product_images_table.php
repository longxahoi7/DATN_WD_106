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
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('product_image_id');
            $table->unsignedInteger('attribute_product_id');
            $table->foreign('attribute_product_id')->references('attribute_product_id')->on('attribute_products')->onDelete('cascade');
            $table->unsignedInteger('color_id');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('cascade');
            $table->string('url', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
