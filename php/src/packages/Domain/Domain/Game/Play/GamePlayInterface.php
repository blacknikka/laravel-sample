<?php

namespace packages\Domain\Domain\Game\Play;

use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\Game;

interface GamePlayInterface
{
    /**
     * @return PlayData
     */
    public function play(Game $game): PlayData;
}
