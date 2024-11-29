<?php

// app/Models/Review.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'listing_id',
        'user_id',
        'rating',
        'review_text',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'review_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'reviewtags', 'review_id', 'tag_id');
    }
}
