<?php

namespace packages\Domain\Domain\User;

use packages\Domain\Domain\Account\AccountId;

class User
{
    /**
     * @var UserId
     */
    private $id;
    /**
     * @var AccountId
     */
    private $accountId;

    /**
     * User constructor.
     * @param UserId $id
     * @param AccountId $accountId
     * @param string $name
     */
    public function __construct(UserId $id, AccountId $accountId)
    {
        $this->id = $id;
        $this->accountId = $accountId;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return AccountId
     */
    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }
}
