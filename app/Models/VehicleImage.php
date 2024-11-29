<?php

// app/Models/VehicleImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'image_id';
    protected $table = 'vehicleimages'; // Specify the correct table name

    protected $fillable = [
        'vehicle_id',
        'image_url',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
