<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $fillable = ['player_id', 'rows'];

    protected $casts = [
        'rows' => 'array'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
