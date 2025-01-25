<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class car_media_reply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_media_comment_id', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(car_media_comment::class);
    }

    public function likes()
    {
        return $this->hasMany(ReplyLike::class, 'reply_id');
    }

    public function isLikedByUser($userId = null)
    {
        if (!$userId && auth()->check()) {
            $userId = auth()->id();
        }
        
        return $this->likes()->where('user_id', $userId)->exists();
    }
}