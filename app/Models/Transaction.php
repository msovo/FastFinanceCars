<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'buyer_id',
        'listing_id',
        'amount',
        'status',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}