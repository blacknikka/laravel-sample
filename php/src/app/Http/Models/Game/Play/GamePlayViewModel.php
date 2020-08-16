<?php

namespace App\Http\Models\Game\Play;

use packages\Domain\Domain\Game\PlayResult\PlayResult;

class GamePlayViewModel
{
    private $playResult;

    public function __construct(PlayResult $playResult)
    {
        $this->playResult = $playResult;
    }

    public function toArray(): array
    {
        return [
            'account' => [
                'balance' => $this->playResult->getAccount()->getBalance(),
            ],
            'playData' => [
                'result' => $this->playResult->getPlayData()->getResult(),
                'score' => $this->playResult->getPlayData()->getScore(),
            ],
        ];
    }
}
