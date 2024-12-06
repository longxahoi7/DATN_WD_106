<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'status',
        'vnp_txnref',
        'vnp_bankcode',
        'vnp_responsecode',
        'vnp_transactionno',
        'vnp_securehash',
        'vnp_transdate',
    ];
}