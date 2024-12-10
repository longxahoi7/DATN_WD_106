<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table='customers';
    protected $primaryKey='customer_id';

    protected $fillable = ['user_id','loyalty_points'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
