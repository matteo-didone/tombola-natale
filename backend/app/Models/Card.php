<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['rows'];
    
    protected $casts = [
        'rows' => 'array'
    ];
    
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}