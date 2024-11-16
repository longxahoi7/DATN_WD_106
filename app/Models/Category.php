<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes ;
    protected $table='categories';
    protected $primaryKey='category_id';
    protected $fillable=['name','description','image','slug','is_active','parent_id'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
