<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyLike extends Model
{
    use HasFactory;

    protected $table = 'car_media_reply_likes';

    protected $fillable = [
        'user_id',
        'reply_id'
    ];

    // Disable timestamps if you don't need them
    public $timestamps = false;

    /**
     * Get the user who liked the reply
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reply that was liked
     */
    public function reply()
    {
        return $this->belongsTo(car_media_reply::class, 'reply_id');
    }

    /**
     * Check if a reply is already liked by a user
     */
    public static function isLikedBy($replyId, $userId)
    {
        return static::where('reply_id', $replyId)
                    ->where('user_id', $userId)
                    ->exists();
    }
}