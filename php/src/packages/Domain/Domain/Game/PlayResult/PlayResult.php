<?php

namespace packages\Domain\Domain\Game\PlayResult;

use Exception;
use packages\Domain\Domain\Account\Account;
use packages\Domain\Domain\Game\PlayData\PlayData;

class PlayResult
{
    private $playData;
    private $account;

    /**
     * Game
     */
    public function __construct(Account $account, PlayData $playData)
    {
        $this->account = $account;
        $this->playData = $playData;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getPlayData(): PlayData
    {
        return $this->playData;
    }
}
