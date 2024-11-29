<?php

// app/Models/NewsCategory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $table = 'newscategory'; // Specify the correct table name
    public $timestamps = false;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'newscategories', 'category_id', 'news_id');
    }
}
