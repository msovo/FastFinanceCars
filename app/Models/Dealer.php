<?php

// app/Models/Dealer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    protected $primaryKey = 'dealer_id';

    protected $fillable = [
        'user_id',
        'dealership_name',
        'license_number',
        'verified',
        'address',
        'city_town',
        'postal_code',
        'logo',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class, 'dealer_id');
    }

    
}
