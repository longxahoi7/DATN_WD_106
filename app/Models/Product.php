<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='products';
    protected $primaryKey='product_id';
    protected $with = ['category', 'attributes', 'coupons'];
    protected $fillable =[
        'product_id',
        'brand_id',
        'product_category_id',
        'sku',
        'name',
        'main_image_url',
        'view_count',
        'description',
        'subtitle',
        'slug',
        'is_active'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'product_category_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_products', 'product_id', 'attribute_id');
    }
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product', 'product_id', 'coupon_id');
    }
}
