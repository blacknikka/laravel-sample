<?php

namespace Tests\Unit\packages\Domain\Domain\Game;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\Game;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function play正常系()
    {
        $game = new Game();
        $play = $game->play();
        $this->assertContains($play->getResult(), ["resultA", "resultB", "resultC"]);
        $this->assertContains($play->getScore(), [0, 100, 150]);
    }
}
