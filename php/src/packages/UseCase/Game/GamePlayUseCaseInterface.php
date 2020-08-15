<?php

namespace packages\UseCase\Game;

use packages\Domain\Domain\User\User;
use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Token\Token;

interface GamePlayUseCaseInterface
{
    /**
     * @param Token
     *
     * @return PlayData
     */
    public function play(Token $token): PlayData;
}
