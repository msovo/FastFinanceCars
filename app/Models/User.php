<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $table = 'users'; // Specify the table name if it's not the default 'users'

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'password',
        'email',
        'user_type',
        'phone',
        'address',
        'city',
        'country',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
    // Define the relationship with enquiries
    public function enquiries()
    {
        return $this->hasMany(Inquiry::class, 'user_id', 'user_id');
    }

    // Define the relationship with dealership
    public function dealership()
    {
        return $this->hasOne(Dealer::class, 'user_id', 'user_id');
    }

    // Define the relationship with products
    public function products()
    {
        return $this->hasMany(Listing::class, 'user_id', 'user_id');
    }

    
    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id', 'user_id');
    }

    public function feeds()
    {
        return $this->hasMany(car_media_feed::class);
    }

    public function stories()
    {
        return $this->hasMany(car_media_story::class,'user_id','user_id',);
    }

    public function car_comments()
    {
        return $this->hasMany(car_media_comment::class);
    }

    public function car_media_likes ()
    {
        return $this->hasMany(car_media_like::class);
    }
}