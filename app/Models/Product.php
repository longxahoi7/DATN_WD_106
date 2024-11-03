<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
        'brand_id',
        'product_category_id',
        'name',
        'description',
        'sku',
        'subtitle',
        'slug',
        'is_active',

    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_products', 'product_id', 'attribute_id')
            ->withPivot(['image', 'in_stock', 'price']);
    }
}
