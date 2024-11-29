<?php

// app/Models/News.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $primaryKey = 'news_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'category_id',
        'thumbnail_url',
        'published_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
  return $this->belongsTo(NewsCategory::class, 'category_id', 'category_id');    }

    public function images()
    {
        return $this->hasMany(NewsImage::class, 'news_id');
    }public function comments()
    {
        return $this->hasMany(Comments::class, 'news_id'); 
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'newstags', 'news_id', 'tag_id');
    }
}
