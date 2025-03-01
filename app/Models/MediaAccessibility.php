<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MediaAccessibility extends Model
{
    protected $fillable = [
        'feed_image_id',
        'alt_text'
    ];

    public function feedImage()
    {
        return $this->belongsTo(FeedImage::class, 'feed_image_id');
    }
}