<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car_brand extends Model
{
    protected $fillable = ['name'];

    public function models()
    {
        return $this->hasMany(Vehicle::class);
    }
}