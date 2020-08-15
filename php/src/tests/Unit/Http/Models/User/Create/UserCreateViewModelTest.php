<?php

namespace Tests\Unit\Http\Models\User\Create;

use PHPUnit\Framework\TestCase;
use App\Http\Models\User\Create\UserCreateViewModel;
use App\Http\Models\User\Game\UserGameViewMode;
use packages\Domain\Domain\Game\State\State;
use packages\Domain\Domain\Game\State\StateStatics;

class UserCreateViewModelTest extends TestCase
{
    /**
     * @test
     */
    public function toArray()
    {
        $model = new UserCreateViewModel(
            "token",
            new UserGameViewMode(new State(StateStatics::STATE_INIT, 100))
        );

        $this->assertEquals(
            json_encode($model->toArray()),
            '{"token":"token","state":{"state":"stateX","counter":0}}'
        );

    }
}
