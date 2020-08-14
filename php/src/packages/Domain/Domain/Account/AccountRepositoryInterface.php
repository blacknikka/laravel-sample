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
    public function find(AccountId $id);

    /**
     * @param AccountId $id
     * @return void
     */
    public function add(int $value);

    /**
     * @param AccountId $id
     * @return void
     */
    public function use(int $value);

}
