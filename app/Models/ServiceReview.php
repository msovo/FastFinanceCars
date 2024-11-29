<?php

// app/Models/ServiceReview.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';

    protected $fillable = [
        'service_id',
        'user_id',
        'rating',
        'review_text',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
