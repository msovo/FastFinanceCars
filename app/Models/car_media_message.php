<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class car_media_message extends Model
{
    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'car_media_feed_id', 
        'car_media_story_id', 
        'message_type', 
        'message'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function feed()
    {
        return $this->belongsTo(car_media_feed::class, 'car_media_feed_id');
    }

    public function story()
    {
        return $this->belongsTo(car_media_story::class, 'car_media_story_id');
    }
}