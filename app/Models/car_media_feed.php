<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class car_media_feed extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'caption'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(car_media_comment::class,'car_media_feed_id');
    }

    public function likes()
    {
        return $this->hasMany(car_media_like::class);
    }

    public function images()
    {
        return $this->hasMany(FeedImage::class, 'car_media_feed_id');
    }
}