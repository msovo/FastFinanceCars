<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class car_media_feed extends Model
{
    use HasFactory;
   protected $fillable = ['user_id', 'media_path', 'media_type', 'caption'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(car_media_comment::class);
    }

    public function likes()
    {
        return $this->hasMany(car_media_like::class);
    }
}