<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromPerProduct extends Model
{
    use HasFactory;
    protected $table='prom_per_product';
    protected $primaryKey='prom_per_product_id';
    protected $fillable=[
        'prom_per_id','product_id'
    ];
}
