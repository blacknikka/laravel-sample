<?php

namespace packages\Domain\Domain\Token;

use Illuminate\Support\Str;
use InvalidArgumentException;

class TokenCreator
{
    const TOKEN_LENGTH = 40;

    static function createToken():string
    {
        return Str::random(self::TOKEN_LENGTH);
    }
}
