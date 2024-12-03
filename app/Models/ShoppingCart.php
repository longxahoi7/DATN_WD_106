<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function items(){
        return $this->hasMany(CartItem::class,'shopping_cart_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'id');
    }
}
