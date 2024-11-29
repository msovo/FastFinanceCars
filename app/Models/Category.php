<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'category_type',
        'category_name',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'category_id');
    }
}
