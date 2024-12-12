<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromPer extends Model
{
    use HasFactory;
    protected $table='prom_pers';
    protected $primaryKey='prom_per_id';
    protected $fillable=[
        'code',
        'discount_amount',
        'discount_percentage',
        'is_active',
        'start_date',
        'end_date',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'prom_per_product', 'prom_per_id', 'product_id')
                    ->withTimestamps(); // Với các cột created_at và updated_at
    }
}
