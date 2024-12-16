<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class car_media_like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_media_feed_id', 'car_media_story_id', 'description'];

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
}