<?php

namespace App\Repositories\Card;

use App\Models\Card;

class CardRepository
{
    public function create(array $data): Card
    {
        return Card::create($data);
    }
}