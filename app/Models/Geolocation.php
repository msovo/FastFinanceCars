<?php

// app/Models/Geolocation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;

    protected $primaryKey = 'location_id';

    protected $fillable = [
        'vehicle_id',
        'latitude',
        'longitude',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
