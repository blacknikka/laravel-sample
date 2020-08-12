<?php

namespace packages\Domain\Domain\Account;

use Exception;

class Account
{
    /**
     * @var AccountId
     */
    private $id;
    /**
     * @var int
     */
    private $balance;

    /**
     * Account constructor.
     * @param AccountId $id
     * @param int $balance
     */
    public function __construct(AccountId $id, int $balance = 0)
    {
        $this->id = $id;

        if ($balance < 0) {
            throw new Exception('balance value should be positive value.');
        }
        $this->balance = $balance;
    }

    /**
     * @return AccountId
     */
    public function getId(): AccountId
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int
     * @return void
     */
    public function useBalance(int $value): void
    {
        if ($value > $this->balance) {
            throw new Exception('short balance');
        }

        $this->balance -= $value;
    }

    /**
     * @param int
     * @return void
     */
    public function addBalance(int $value): void
    {
        if ($value < 0) {
            throw new Exception('added value is invalid');
        }

        $this->balance += $value;
    }
}
