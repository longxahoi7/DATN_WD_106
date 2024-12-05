<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    use HasFactory;
    protected $table='comment_replies';
    protected $primaryKey='reply_id';
    protected $fillable = [
        'user_id','comment_id','content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với bình luận mẹ
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}

