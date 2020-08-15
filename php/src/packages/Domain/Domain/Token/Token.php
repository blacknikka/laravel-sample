<?php

namespace packages\Domain\Domain\Token;

use Illuminate\Support\Str;
use InvalidArgumentException;
use packages\Domain\Domain\Token\TokenCreator;

class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * token
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        if (strlen($token) !== TokenCreator::TOKEN_LENGTH) {
            throw new InvalidArgumentException('token length should be ' . TokenCreator::TOKEN_LENGTH);
        }
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
