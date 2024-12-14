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
        Schema::create('prom_per_product', function (Blueprint $table) {
            $table->increments('prom_per_product_id');
            $table->unsignedInteger('prom_per_id');
            $table->foreign('prom_per_id')->references('prom_per_id')->on('prom_pers')->onDelete('cascade');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prom_per_product');
    }
};
