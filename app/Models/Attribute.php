<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
<<<<<<< HEAD
    use HasFactory,SoftDeletes;
protected $table='attributes';
protected $primaryKey='attribute_id';
protected $fillable=['name','value'];
    
    public function productImages()
=======
    use HasFactory;

    protected $primaryKey = 'attribute_id';
    protected $fillable = ['name', 'value'];

    public function products()
>>>>>>> Hieu
    {
        return $this->belongsToMany(Product::class, 'attribute_products', 'attribute_id', 'product_id')
            ->withPivot(['image', 'in_stock', 'price']);
    }
}
