<?php

namespace packages\Domain\Domain\Account;


interface AccountRepositoryInterface
{
    /**
     * @param Account $account
     * @return mixed
     */
    public function save(Account $account);

    /**
     * @param AccountId $id
     * @return Account
     */
    public function find(AccountId $id): Account;

    /**
     * update balance by ID
     *
     * @param AccountId $id
     * @param integer $balance
     * @return void
     */
    public function updateBalance(AccountId $id, int $balance): void;
}
