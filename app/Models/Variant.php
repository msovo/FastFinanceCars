<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $fillable = ['model_id', 'name'];

    public function model()
    {
        return $this->belongsTo(CarModel::class);
    }

    public function vehicles() {
        return $this->hasOne(Vehicle::class);
    }
}