<?php

namespace Tests\Unit\packages\Domain\Domain\Game\Random;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\Random\Random;
use packages\Domain\Domain\Game\Random\RandomizeInterface;
use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\State\State;
use packages\Domain\Domain\Game\State\StateStatics;

class RandomTest extends TestCase
{
    /**
     * @test
     * @dataProvider table_random正常系
     */
    public function random正常系(State $state, $rand, $result, $score)
    {
        $mock = \Mockery::mock(RandomizeInterface::class);
        $mock->shouldReceive('random')->andReturn($rand);

        $random = new Random($state, $mock);
        $gotResult = $random->getResultFromState();
        $this->assertEquals($gotResult, new PlayData($result, $score));
    }

    public function table_random正常系()
    {
        return [
            [$this->getInitState(), 0, "resultA", 0,],
            [$this->getInitState(), 501, "resultB", 100,],
            [$this->getAnotherState(), 200, "resultA", 0,],
            [$this->getAnotherState(), 201, "resultC", 150,],
        ];
    }

    private function getInitState(): State
    {
        return new State();
    }

    private function getAnotherState(): State
    {
        $state = new State();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();

        return $state;
    }
}