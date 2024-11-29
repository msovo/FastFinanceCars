<?php

// app/Models/Listing.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $primaryKey = 'listing_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'listing_status',
        'featured',
        'sponsored'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }



    public function reviews()
    {
        return $this->hasMany(Review::class, 'listing_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function images()
    {
        return $this->hasMany(VehicleImage::class, 'vehicle_id', 'vehicle_id');
    }
 
}
