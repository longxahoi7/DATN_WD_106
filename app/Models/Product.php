<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $with = ['category', 'coupons'];
    protected $fillable = [
        'brand_id',
        'product_category_id',
        'sku',
        'name',
        'main_image_url',
        'discount',
        'start_date',
        'end_date',
        'view_count',
        'description',
        'subtitle',
        'slug',
        'is_active',
        'is_best_seller',
        'is_hot',
        'view_count',
    ];
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'attribute_products', 'product_id', 'color_id')
            ->withPivot('size_id', 'price', 'in_stock');
    }

    // Mối quan hệ với bảng sizes thông qua bảng pivot
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'attribute_products', 'product_id', 'size_id')
            ->withPivot('color_id', 'price', 'in_stock');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product', 'product_id', 'coupon_id');
    }
    public function productImages()
    {
        return $this->hasManyThrough(ProductImage::class, AttributeProduct::class, 'product_id', 'attribute_product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_id', 'order_id');
    }
    public function attributeProducts()
    {
        return $this->hasMany(AttributeProduct::class, 'product_id', 'product_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); 
    }
    public function cartItems() {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    
    public static function getBestSellers()
    {
        return self::where('is_best_seller', 1)->limit(10)->get(); // Giới hạn số lượng sản phẩm bán chạy
    }
    public static function getHotProducts()
    {
        return self::where('is_hot', 1)->limit(10)->get(); // Giới hạn số lượng sản phẩm hot
    }
}