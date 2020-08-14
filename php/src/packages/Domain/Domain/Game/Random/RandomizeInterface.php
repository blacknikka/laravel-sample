<?php

namespace packages\Domain\Domain\Game\Random;

interface RandomizeInterface
{
    /**
     * get randomized int
     *
     * @return int
     */
    public function random(): int;
}
