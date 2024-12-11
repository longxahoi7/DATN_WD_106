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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->unsignedInteger('user_id'); 
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('loyalty_points')->default(0);  // Điểm tích lũy của khách hàng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};