<?php

namespace Tests\Unit\packages\Domain\Domain\Game\PlayData;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\PlayData\PlayData;

class PlayDataTest extends TestCase
{
    /**
     * @test
     */
    public function PlayData正常系()
    {
        $data = new PlayData("a", 1);
        $this->assertEquals($data->getResult(), "a");
        $this->assertEquals($data->getScore(), 1);
    }
}
