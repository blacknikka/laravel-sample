<?php

namespace packages\Domain\Domain\Game\Play;

use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\Play\GamePlayInterface;
use packages\Domain\Domain\Game\Game;
use packages\Domain\Domain\Game\Random\Random;
use packages\Domain\Domain\Game\Random\Randomize;

Class GamePlay implements GamePlayInterface
{
    /**
     * @return PlayData
     */
    public function play(Game $game): PlayData
    {
        $random = new Random($game->getState(), new Randomize());
        return $random->getResultFromState();
    }
}
