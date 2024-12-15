<?php

namespace App\Exceptions;

use Exception;

class GameException extends Exception
{
    public static function allNumbersExtracted(): self
    {
        return new self('All numbers have been extracted');
    }
    
    public static function invalidWinType(string $type): self
    {
        return new self("Invalid win type: {$type}");
    }
}