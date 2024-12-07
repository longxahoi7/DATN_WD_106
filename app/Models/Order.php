<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
        'total',
        'invoice_date',
        'payment_status',
        // Thêm các thuộc tính khác nếu cần
    ];
   
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); 
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
}
}
