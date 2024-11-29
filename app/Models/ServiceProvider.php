<?php
// app/Models/ServiceProvider.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $primaryKey = 'provider_id';

    protected $fillable = [
        'provider_name',
        'description',
        'website_url',
        'contact_email',
        'contact_phone',
        'address',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'provider_id');
    }
}
