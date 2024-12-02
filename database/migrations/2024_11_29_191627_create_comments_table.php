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
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id'); // Khóa chính cho bảng comment
            $table->text('content'); // Nội dung bình luận
            $table->integer('user_id')->unsigned(); // ID của người bình luận
            $table->integer('product_id')->nullable()->unsigned(); // ID của sản phẩm, có thể là null nếu không áp dụng cho sản phẩm
            $table->timestamps(); // Các trường created_at và updated_at

            // Thiết lập khóa ngoại cho user_id và product_id/post_id nếu cần
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
