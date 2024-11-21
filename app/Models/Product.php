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
        'is_active'
    ];
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'attribute_products', 'product_id', 'color_id')
            ->withPivot('size_id', 'price', 'in_stock'); // Lưu các thông tin bổ sung như size, giá và stock trong bảng pivot
    }
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
    public function attributeProducts()
    {
        return $this->hasMany(AttributeProduct::class, 'product_id', 'product_id');
    }
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product', 'product_id', 'coupon_id');
    }
}