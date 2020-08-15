<?php

namespace App\Http\Models\Game\Play;

use packages\Domain\Domain\Game\PlayData\PlayData;

class GamePlayViewModel
{
    private $playData;

    public function __construct(PlayData $playData)
    {
        $this->playData = $playData;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'state' => $this->gameState->toArray(),
        ];
    }
}
