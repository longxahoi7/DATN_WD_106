<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Coupon extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='coupons';
    protected $primaryKey ='coupon_id';
    protected $fillable =[
        'code',
        'discount_amount',
        'discount_percentage',
        'quantity',
        'min_order_value',
        'max_order_value',
        'condition',
        'user_id',
        'is_public',
        'start_date',
        'end_date',
        'is_active'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_user', 'coupon_id', 'user_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_product', 'coupon_id', 'product_id');
    }
}
