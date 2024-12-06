<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $primaryKey = 'product_image_id';
    protected $fillable = [
        'product_id',
        'color_id',
        'url',
        'attribute_product_id',
    ];
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function attributeProduct()
    {
        return $this->belongsTo(AttributeProduct::class, 'attribute_product_id');
    }
}
