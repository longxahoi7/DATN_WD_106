<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $table = 'shopping_carts';
    protected $fillable = ['user_id'];

    public function items(){
        return $this->hasMany(CartItem::class,'shopping_cart_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'shopping_cart_id');
    }
    public function getContent() {
        return $this->items;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
