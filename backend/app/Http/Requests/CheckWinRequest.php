<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckWinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'playerId' => 'required|exists:players,id',
            'winType' => 'required|in:ambo,terno,quaterna,cinquina,tombola'
        ];
    }
}