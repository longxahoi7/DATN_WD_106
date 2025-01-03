<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $fillable = [
        'shopping_cart_id',
        'product_id',
        'color_id',
        'size_id',
        'qty',
    ];

    // public function productItem(){
    //     return $this->belongsTo(Product::class,'product_id');
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class, 'shopping_cart_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function attributeProducts()
    {
        return $this->hasManyThrough(
            AttributeProduct::class,
            Product::class,
            'product_id', // Foreign key on Product table
            'product_id', // Foreign key on AttributeProduct table
            'product_id', // Local key on CartItem table
            'product_id'  // Local key on Product table
        );
    }
    public function attributeProduct()
{
    return $this->hasOne(AttributeProduct::class, 'product_id', 'product_id')
        ->where('color_id', $this->color_id)
        ->where('size_id', $this->size_id);
}

public function user()
    {
        return $this->belongsTo(User::class);
    }
}