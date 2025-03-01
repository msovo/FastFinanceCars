<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PostFeature extends Model
{
    protected $fillable = [
        'car_media_feed_id',
        'feature_type',
        'value'
    ];

    protected $casts = [
        'value' => 'json'
    ];

    public function feed()
    {
        return $this->belongsTo(car_media_feed::class, 'car_media_feed_id');
    }
}