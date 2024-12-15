<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'status',
        'current_number',
        'extracted_numbers'
    ];

    protected $casts = [
        'extracted_numbers' => 'array'
    ];
}