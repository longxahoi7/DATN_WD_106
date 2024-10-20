<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='products';
    protected $primaryKey='product_id ';
    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'description',
        'sku',
        'subtitle',
        'slug','is_active'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
