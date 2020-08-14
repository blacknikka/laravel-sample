<?php

namespace packages\Domain\Domain\Game\Random;

use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\Random\RandomizeInterface;

class Random
{
    private $state;
    private $random;

    /**
     * Random
     */
    public function __construct(string $state, RandomizeInterface $random)
    {
        $this->state = $state;
        $this->random = $random;
    }

    /**
     * get result
     *
     * @return string
     */
    public function getResultFromState(): PlayData
    {
        $rand = $this->random->random();

        if ($this->state === "stateX") {
            if ($rand <= 500) {
                $result = new PlayData("resultA", 0);
            } else {
                $result = new PlayData("resultB", 100);
            }
        } else {
            if ($rand <= 200) {
                $result = new PlayData("resultA", 0);
            } else {
                $result = new PlayData("resultC", 150);
            }
        }
        return $result;
    }
}
