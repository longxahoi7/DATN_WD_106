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
        Schema::create('attribute_products', function (Blueprint $table) {
            $table->increments('attribute_product_id');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('attribute_id');
            $table->foreign('attribute_id')->references('attribute_id')->on('attributes')->onDelete('cascade');
            $table->integer('in_stock');
            $table->double('price', 16, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_products');
    }
};
