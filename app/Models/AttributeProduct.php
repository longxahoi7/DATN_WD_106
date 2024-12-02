<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    use HasFactory;
    protected $table = 'attribute_products';
    protected $primaryKey = 'attribute_product_id';
    protected $fillable = ['product_id', 'color_id', 'size_id', 'in_stock', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class,'attribute_product_id');
    }
}
