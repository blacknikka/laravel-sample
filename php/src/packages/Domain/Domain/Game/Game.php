<?php

namespace packages\Domain\Domain\Game;

use packages\Domain\Domain\Game\Play\GamePlayInterface;
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
    private $gamePlayInterface;

    /**
     * Game
     */
    public function __construct(GamePlayInterface $gamePlayInterface, State $state = null)
    {
        if (is_null($state)) {
            $this->state = new State();
        } else {
            $this->state = $state;
        }

        $this->gamePlayInterface = $gamePlayInterface;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @return PlayData
     */
    public function play(): PlayData
    {
        return $this->gamePlayInterface->play($this);
    }
}
