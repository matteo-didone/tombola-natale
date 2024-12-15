<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = ['name'];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
