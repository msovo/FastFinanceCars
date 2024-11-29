<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingRating extends Model
{
    use HasFactory;

    protected $table = 'Listing_ratings';
    protected $fillable = ['listing_id', 'user_id', 'rating'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
