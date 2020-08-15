<?php

namespace Tests\Unit\packages\Domain\Domain\Token;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Token\TokenCreator;

class TokenTest extends TestCase
{
    /**
     * @test
     */
    public function コンストラクタ()
    {
        $created = TokenCreator::createToken();
        $token = new Token($created);
        $this->assertEquals($token->getToken(), $created);
    }

    /**
     * @test
     */
    public function コンストラクタ_例外()
    {
        $this->expectException(InvalidArgumentException::class);

        $token = new Token("");
    }
}
