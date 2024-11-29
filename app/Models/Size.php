<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='sizes';
protected $primaryKey ='size_id';
    protected $fillable=['name'];
    public function attributeProducts()
    {
        return $this->hasMany(AttributeProduct::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'attribute_products', 'size_id', 'color_id')
                    ->withPivot('price', 'in_stock');  // Lấy các trường từ bảng trung gian
    }
}
