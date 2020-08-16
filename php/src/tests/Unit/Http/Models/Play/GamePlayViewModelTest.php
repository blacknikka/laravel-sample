<?php

namespace Tests\Unit\Http\Models\Play;

use PHPUnit\Framework\TestCase;
use App\Http\Models\Game\Play\GamePlayViewModel;
use packages\Domain\Domain\Game\PlayResult\PlayResult;
use packages\Domain\Domain\Account\Account;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Game\PlayData\PlayData;

class GamePlayViewModelTest extends TestCase
{
    /**
     * @test
     */
    public function toArray()
    {
        $model = new GamePlayViewModel(
            new PlayResult(
                new Account(new AccountId('id')),
                new PlayData('resultA', 100)
            )
        );

        $this->assertEquals(
            json_encode($model->toArray()),
            '{"account":{"balance":5000},"playData":{"result":"resultA","score":100}}'
        );

    }
}
