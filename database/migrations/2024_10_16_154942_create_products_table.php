<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
            $table->unsignedInteger('product_category_id');
            $table->foreign('product_category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('main_image_url', 255);
            $table->bigInteger('view_count')->default(0);
            $table->double('discount', 16, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description');
            $table->string('sku');
            $table->text('subtitle');
            $table->string('slug');
            $table->tinyInteger('is_active')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
