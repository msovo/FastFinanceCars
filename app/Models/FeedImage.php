<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedImage extends Model
{
    use HasFactory;

    protected $fillable = ['car_media_feed_id', 'media_path', 'media_type'];

    public function feed()
    {
        return $this->belongsTo(car_media_feed::class, 'car_media_feed_id');
    }
}