<?php

namespace App\Repositories\Player;

use App\Models\Player;

class PlayerRepository
{
    public function findWithCards(string $id): Player
    {
        return Player::with('cards')->findOrFail($id);
    }
    
    public function create(array $data): Player
    {
        return Player::create($data);
    }
}