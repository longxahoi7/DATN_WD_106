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
    protected $with = ['category'];
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

    public function promPerProducts()
    {
        return $this->hasMany(PromPerProduct::class, 'product_id', 'product_id');
    }
    public function productImages()
    {
        return $this->hasManyThrough(ProductImage::class, AttributeProduct::class, 'product_id', 'attribute_product_id');
    }
    public function attributes()
    {
        return $this->belongsToMany(AttributeProduct::class, 'attribute_products', 'product_id', 'attribute_id');
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
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }


    public static function getBestSellers()
    {
        return self::where('is_best_seller', 1)
            ->where('is_active', 1)  // Kiểm tra sản phẩm có đang hoạt động
            ->limit(10)  // Giới hạn số lượng sản phẩm bán chạy
            ->get();
    }

    public static function getHotProducts()
    {
        return self::where('is_hot', 1)
            ->where('is_active', 1)  // Kiểm tra sản phẩm có đang hoạt động
            ->limit(10)  // Giới hạn số lượng sản phẩm hot
            ->get();
    }


//     public function getFinalPriceAttribute()
// {
//     // Giá gốc của sản phẩm
//     $originalPrice = $this->attributeProducts->first()?->price ?? 0;

//     // Kiểm tra xem có giảm giá không
//     $promotion = $this->promPerProducts->first()?->promPer;

//     if ($promotion) {
//         // Áp dụng giảm giá theo số tiền hoặc phần trăm
//         if ($promotion->discount_amount) {
//             return max(0, $originalPrice - $promotion->discount_amount); // Không để giá âm
//         } elseif ($promotion->discount_percentage) {
//             return max(0, $originalPrice * (1 - $promotion->discount_percentage / 100));
//         }
//     }

//     // Trả về giá gốc nếu không có giảm giá
//     return $originalPrice;
// }
  
}
