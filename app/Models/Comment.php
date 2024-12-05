<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $primaryKey='comment_id';
    protected $fillable = [
        'user_id', 'commentable_type', 'commentable_id', 'content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
       // Quan hệ với các đối tượng mà người dùng có thể bình luận
       public function commentable()
       {
           return $this->morphTo();
       }
       public function isBanned()
    {
        return $this->is_banned;
    }
    public function replies()
    {
        return $this->hasMany(CommentReply::class, 'comment_id');
    }
}
