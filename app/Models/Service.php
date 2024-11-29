<?php

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_name',
        'description',
        'service_type',
        'provider_name',
        'provider_url',
        'phone_number',
        'email',
    ];

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id');
    }

    public function reviews()
    {
        return $this->hasMany(ServiceReview::class, 'service_id');
    }
}
