<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    use HasFactory;

    protected $table = 'car_media_comment_likes';

    protected $fillable = [
        'user_id',
        'comment_id'
    ];

    // Disable timestamps if you don't need them
    public $timestamps = false;

    /**
     * Get the user who liked the comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comment that was liked
     */
    public function comment()
    {
        return $this->belongsTo(car_media_comment::class, 'comment_id');
    }

    /**
     * Check if a comment is already liked by a user
     */
    public static function isLikedBy($commentId, $userId)
    {
        return static::where('comment_id', $commentId)
                    ->where('user_id', $userId)
                    ->exists();
    }
}

