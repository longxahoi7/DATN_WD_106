<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table='employees';
    protected $primaryKey='employee_id';

    protected $fillable = ['user_id','role','salary'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
