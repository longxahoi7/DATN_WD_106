<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable =['shopping_cart_id','product_id','qty'];

    public function productItem(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
