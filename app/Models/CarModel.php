<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = ['make_id', 'name'];

    public function make()
    {
        return $this->belongsTo(Car_brand::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}