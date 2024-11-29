<?php

// app/Models/Tool.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $primaryKey = 'tool_id';

    protected $fillable = [
        'tool_name',
        'description',
        'tool_type',
        'url',
    ];

    public function usages()
    {
        return $this->hasMany(ToolServiceUsage::class, 'tool_id');
    }
}
