<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class car_media_feed extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'user_id',
        'caption',
        'post_type',
        'price',
        'location',
        'is_negotiable',
        'is_featured',
        'is_urgent',
        'allow_comments',
        'show_views',
        'allow_sharing',
    ];

    protected $casts = [
        'is_negotiable' => 'boolean',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'allow_comments' => 'boolean',
        'show_views' => 'boolean',
        'allow_sharing' => 'boolean',
        'price' => 'decimal:2',
    ];
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

    public function getIsLikedByUserAttribute()
{
    return $this->likes()->where('user_id', auth()->id())->exists();
}

public function features()
{
    return $this->hasMany(PostFeature::class, 'car_media_feed_id');
}
}