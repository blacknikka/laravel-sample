<?php

namespace Tests\Unit\packages\Domain\Domain\State;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\State\StateStatics;

class StateStaticsTest extends TestCase
{
    /**
     * @test
     */
    public function isValid_正常系()
    {
        $this->assertTrue(StateStatics::isValid(StateStatics::STATE_INIT));
        $this->assertTrue(StateStatics::isValid(StateStatics::STATE_ANOTHER));
    }

    /**
     * @test
     */
    public function isValid_異常系()
    {
        $this->assertFalse(StateStatics::isValid("hogehoge"));
        $this->assertFalse(StateStatics::isValid(""));
    }

    /**
     * @test
     */
    public function getStates()
    {
        $this->assertSame(StateStatics::getStates(), [StateStatics::STATE_INIT, StateStatics::STATE_ANOTHER]);
    }
}
