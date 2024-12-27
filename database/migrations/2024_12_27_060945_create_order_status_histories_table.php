<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('order_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id'); // ID của đơn hàng
            $table->string('previous_status')->nullable(); // Trạng thái cũ
            $table->string('new_status'); // Trạng thái mới
            $table->unsignedInteger('updated_by')->nullable(); // ID người thực hiện thay đổi
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('updated_by')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_status_histories');
    }
}
