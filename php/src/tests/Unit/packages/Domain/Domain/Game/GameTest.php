<?php

namespace Tests\Unit\packages\Domain\Domain\Game;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\Game;
use packages\Domain\Domain\Game\State\StateStatics;
use packages\Domain\Domain\Game\State\State;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function コンストラクタ_null()
    {
        $game = new Game();
        $state = $game->getState();
        $this->assertTrue($state->isState(StateStatics::STATE_INIT));
    }

    /**
     * @test
     */
    public function コンストラクタ_not_null()
    {
        $game = new Game(new State(StateStatics::STATE_ANOTHER));
        $state = $game->getState();
        $this->assertTrue($state->isState(StateStatics::STATE_ANOTHER));
    }

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
