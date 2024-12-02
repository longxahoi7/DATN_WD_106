<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table='reports';
    protected $primaryKey='report_id';
    protected $fillable = ['user_id', 'review_id', 'comment_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function review()
    {
        return $this->belongsTo(Reviews::class);
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
