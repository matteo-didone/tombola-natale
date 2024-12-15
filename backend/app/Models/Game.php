<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['status', 'current_number'];
    
    protected $casts = [
        'extracted_numbers' => 'array',
        'status' => 'string',
    ];
}