<?php

// app/Models/Tag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'tag_id';

    protected $fillable = [
        'tag_name',
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'newstags', 'tag_id', 'news_id');
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class, 'reviewtags', 'tag_id', 'review_id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_tags', 'tag_id', 'vehicle_id');
    }
}
