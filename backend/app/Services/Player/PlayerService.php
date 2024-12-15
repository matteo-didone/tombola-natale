<?php

namespace App\Services\Player;

use App\Models\Player;

class PlayerService
{
    public function createPlayer(string $name): Player
    {
        return Player::create(['name' => $name]);
    }
}