<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory,SoftDeletes;
protected $table='attributes';
protected $primaryKey='attribute_id';
protected $fillable=['name','value'];
    
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
