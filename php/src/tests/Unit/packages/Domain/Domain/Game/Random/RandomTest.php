<?php

namespace Tests\Unit\packages\Domain\Domain\Game\Random;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\Random\Random;
use packages\Domain\Domain\Game\Random\RandomizeInterface;
use packages\Domain\Domain\Game\PlayData\PlayData;

class RandomTest extends TestCase
{
    /**
     * @test
     * @dataProvider table_random正常系
     */
    public function random正常系($state, $rand, $result, $score)
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
            ["stateX", 0, "resultA", 0,],
            ["stateX", 501, "resultB", 100,],
            ["stateAnother", 200, "resultA", 0,],
            ["stateAnother", 201, "resultC", 150,],
        ];
    }
}
