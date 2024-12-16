<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

// Story.php
class car_media_story extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['user_id', 'media_path', 'media_type', 'caption'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(car_media_like::class);
    }

    public function comments()
    {
        return $this->hasMany(car_media_comment::class);
    }
}