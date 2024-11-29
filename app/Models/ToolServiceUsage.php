<?php

// app/Models/ToolServiceUsage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolServiceUsage extends Model
{
    use HasFactory;

    protected $primaryKey = 'usage_id';

    protected $fillable = [
        'user_id',
        'tool_id',
        'service_id',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tool()
    {
        return $this->belongsTo(Tool::class, 'tool_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
