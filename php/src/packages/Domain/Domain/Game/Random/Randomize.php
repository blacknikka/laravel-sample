<?php

namespace packages\Domain\Domain\Game\Random;

use packages\Domain\Domain\Game\Random\RandomizeInterface;

class Randomize implements RandomizeInterface
{
    /**
     * get randomized int
     *
     * @return int
     */
    public function random(): int
    {
        return random_int(0, 999);
    }
}
