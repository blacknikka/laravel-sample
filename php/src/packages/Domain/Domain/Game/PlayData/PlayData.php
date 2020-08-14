<?php

namespace packages\Domain\Domain\Game\PlayData;

use Exception;

class PlayData
{
    private $result;
    private $score;

    /**
     * Game
     */
    public function __construct(string $result, string $score)
    {
        $this->result = $result;
        $this->score = $score;
    }

    /**
     * get result
     *
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * get score
     *
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}
