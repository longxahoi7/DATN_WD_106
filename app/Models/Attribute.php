<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory;

    protected $primaryKey = 'attribute_id';
    protected $fillable = ['name', 'value'];

    public function products()

    {
        return $this->belongsToMany(Product::class, 'attribute_products', 'attribute_id', 'product_id')
            ->withPivot(['image', 'in_stock', 'price']);
    }
}
