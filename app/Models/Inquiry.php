<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable timestamps

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'listing_id',
        'user_id',
        'status',
        'dealer_message'
    ];


        public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'listing_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id');
    }

  
}
