<?php

// app/Models/Vehicle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'vehicle_id';
    public $timestamps = false;

    protected $fillable = [
        'year',
        'price',
        'mileage',
        'fuel_type',
        'transmission',
        'body_type',
        'color',
        'engine_size',
        'description',
        'listed_at',
        'car_condition',
        'car_brand_id',
        'car_model_id',
        'variant_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class, 'vehicle_id');
    }

    public function geolocation()
    {
        return $this->hasOne(Geolocation::class, 'vehicle_id');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class, 'vehicle_id');
    }
 
    public function features()
    {
        return $this->hasMany(Feature::class, 'vehicle_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'vehicle_tags', 'vehicle_id', 'tag_id');
    }



    public function isListed()
    {
        return $this->hasOne(Listing::class, 'vehicle_id')->where('listing_status', 'active')->exists();
    }

    public function isSold()
    {
        return $this->hasOne(Listing::class, 'vehicle_id')->where('listing_status', 'sold')->exists();
    }
    public function listing()
    {
        return $this->hasOne(Listing::class, 'vehicle_id');
    }
    public function model() {
        return $this->belongsTo(CarModel::class);
    }

    public function car_brand() {
        return $this->belongsTo(CarBrand::class);
    }

    public function variant() {
        return $this->belongsTo(Variant::class);
    }
    
    public function car_model() {
        return $this->belongsTo(CarModel::class);
    }
    public function dealer()
    {
        return $this->hasOneThrough(Dealer::class, User::class, 'user_id', 'user_id');
    }

    public function inquiries()
    {
        return $this->hasManyThrough(
            Inquiry::class,
            Listing::class,
            'vehicle_id', // Foreign key on Listing table
            'listing_id', // Foreign key on Inquiry table
            'vehicle_id', // Local key on Vehicle table
            'listing_id'  // Local key on Listing table
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
