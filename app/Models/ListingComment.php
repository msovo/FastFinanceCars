<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingComment extends Model
{
    use HasFactory;

    protected $table = 'Listing_comments';
    protected $fillable = ['listing_id', 'user_id', 'content'];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
