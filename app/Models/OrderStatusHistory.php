<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'previous_status',
        'new_status',
        'updated_by',
    ];

    // Liên kết với đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Liên kết với người dùng (người thực hiện thay đổi)
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
