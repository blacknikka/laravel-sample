<?php


namespace App\Http\Models\User\Create;

use App\Http\Models\User\Game\UserGameViewMode;


class UserCreateViewModel
{
    /**
     * @var string
     */
    private $token;
    private $gameState;

    public function __construct(string $token, UserGameViewMode $gameState)
    {
        $this->token = $token;
        $this->gameState = $gameState;

    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'state' => $this->gameState->toArray(),
        ];
    }
}
