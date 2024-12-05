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
        Schema::table('payments', function (Blueprint $table) {
            //
            $table->string('vnp_txnref')->nullable();         // Mã giao dịch VNPay
            $table->string('vnp_bankcode')->nullable();       // Mã ngân hàng
            $table->string('vnp_responsecode')->nullable();   // Mã phản hồi từ VNPay
            $table->string('vnp_transactionno')->nullable();  // Số giao dịch VNPay
            $table->string('vnp_securehash')->nullable();     // Mã hash bảo mật
            $table->timestamp('vnp_transdate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'vnp_txnref',
                'vnp_bankcode',
                'vnp_responsecode',
                'vnp_transactionno',
                'vnp_securehash',
                'vnp_transdate',
            ]);
        });
    }
};
