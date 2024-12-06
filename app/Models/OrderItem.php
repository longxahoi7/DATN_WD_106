<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', // Thêm trường này
        'product_id',
        'quantity',
        'price',
        'total',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function attributeProduct()
{
    return $this->hasOneThrough(
        AttributeProduct::class,
        Product::class,
        'product_id', // Foreign key trên bảng products
        'product_id', // Foreign key trên bảng attribute_products
        'product_id', // Local key trên bảng order_items
        'product_id'  // Local key trên bảng products
    );
}
}
