<?php

namespace packages\Domain\Domain\Game;

use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\Random\Random;
use packages\Domain\Domain\Game\Random\Randomize;
use packages\Domain\Domain\Game\State\State;


class Game
{
    /**
     * state
     *
     * @var State
     */
    private $state;
    /**
     * Game
     */
    public function __construct()
    {
        $this->state = new State();
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
