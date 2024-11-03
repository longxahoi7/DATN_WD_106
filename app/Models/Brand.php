<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='brands';
protected $primaryKey ='brand_id';
    protected $fillable=['name','description','slug','is_active'];
    protected $dates = ['deleted_at'];
    public function isActive(){
        return  $this->is_active==1   ; 
    }

}
