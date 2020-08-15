<?php

namespace packages\UseCase\Game;

use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Game\PlayResult\PlayResult;

interface GamePlayUseCaseInterface
{
    /**
     * @param Token
     *
     * @return PlayResult
     */
    public function play(Token $token): PlayResult;
}
