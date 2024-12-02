<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'content',
        'user_id',
        'product_id',
    ];

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Quan hệ với Product (nếu bình luận liên quan đến sản phẩm)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
