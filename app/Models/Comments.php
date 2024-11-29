<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['news_id', 'user_id', 'content'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Specify the custom key
    }

    public function news()
{
    return $this->belongsTo(News::class, 'news_id'); 
}
}



