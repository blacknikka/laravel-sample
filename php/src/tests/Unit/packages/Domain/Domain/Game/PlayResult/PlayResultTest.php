<?php

namespace Tests\Unit\packages\Domain\Domain\Game\PlayResult;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Game\PlayData\PlayData;
use packages\Domain\Domain\Game\PlayResult\PlayResult;
use packages\Domain\Domain\Account\Account;
use packages\Domain\Domain\Account\AccountId;

class PlayResultTest extends TestCase
{
    /**
     * @test
     */
    public function PlayResultコンストラクタ()
    {
        $account = new Account(new AccountId("id"), 5000);
        $data = new PlayData("a", 1);

        $result = new PlayResult($account, $data);

        $this->assertEquals($result->getAccount(), $account);
        $this->assertEquals($result->getPlayData(), $data);
    }
}
