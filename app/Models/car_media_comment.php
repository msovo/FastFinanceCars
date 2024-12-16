<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class car_media_comment extends Model
{
    protected $fillable = ['user_id', 'car_media_feed_id', 'car_media_story_id', 'comment', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feed()
    {
        return $this->belongsTo(car_media_feed::class);
    }

    public function story()
    {
        return $this->belongsTo(car_media_story::class);
    }

    public function replies()
    {
        return $this->hasMany(car_media_reply::class);
    }
}