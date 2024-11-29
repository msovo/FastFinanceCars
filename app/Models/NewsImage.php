<?php
// app/Models/NewsImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'image_id';
    protected $table = 'newsimages'; // Specify the correct table name
    public $timestamps = false;

    protected $fillable = [
        'news_id',
        'image_url',
        'caption',
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
