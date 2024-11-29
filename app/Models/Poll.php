<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['question'];

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }
}

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = ['poll_id', 'option'];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }
}

class PollVote extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['poll_option_id', 'user_id'];

    public function option()
    {
        return $this->belongsTo(PollOption::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
