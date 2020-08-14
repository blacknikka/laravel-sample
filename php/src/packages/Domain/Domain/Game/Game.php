<?php

namespace packages\Domain\Domain\Game;

use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\Random\Random;
use packages\Domain\Domain\Game\Random\Randomize;


class Game
{
    private $state = "stateX";
    /**
     * Game
     */
    public function __construct()
    {
    }

    /**
     * @return PlayData
     */
    public function play(): PlayData
    {
        $random = new Random($this->state, new Randomize());
        return $random->getResultFromState();
    }
}
