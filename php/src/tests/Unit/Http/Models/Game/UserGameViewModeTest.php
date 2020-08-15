<?php

namespace Tests\Unit\Http\Models\User\Create;

use PHPUnit\Framework\TestCase;
use App\Http\Models\User\Create\UserCreateViewModel;
use App\Http\Models\User\Game\UserGameViewMode;
use packages\Domain\Domain\Game\State\State;
use packages\Domain\Domain\Game\State\StateStatics;

class UserGameViewModeTest extends TestCase
{
    /**
     * @test
     */
    public function toArray()
    {
        $model = new UserGameViewMode(new State(StateStatics::STATE_INIT, 100));

        $this->assertEquals(
            json_encode($model->toArray()),
            '{"state":"stateX","counter":0}'
        );

    }
}
