<?php

// app/Models/ReviewImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'review_id',
        'image_url',
        'caption',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }
}
