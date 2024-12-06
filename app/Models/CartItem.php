<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable =['shopping_cart_id','product_id','qty'];

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
    
}