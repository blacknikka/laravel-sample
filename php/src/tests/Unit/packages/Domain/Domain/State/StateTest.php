<?php

namespace Tests\Unit\packages\Domain\Domain\State;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\State\State;
use packages\Domain\Domain\Game\State\StateStatics;

class StateTest extends TestCase
{
    /**
     * @test
     */
    public function Stateのコンストラクタ()
    {
        $state = new State();
        $this->assertTrue($state->isState(StateStatics::STATE_INIT));
    }

    /**
     * @test
     */
    public function Stateの確認_AnotherStateへのトランジション()
    {
        $state = new State();

        // 5回Playするとトランジションする
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();

        $this->assertTrue($state->isState(StateStatics::STATE_ANOTHER));
    }

    /**
     * @test
     */
    public function Stateの確認_AnotherStateからInitStateへのトランジション()
    {
        $state = new State();

        // 5回Playするとトランジションする
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();

        // さらに5回Playするとトランジションする
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();
        $state->PlayAndTransitState();

        $this->assertTrue($state->isState(StateStatics::STATE_INIT));
    }
}
