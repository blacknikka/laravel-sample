<?php

namespace packages\Infrastructure\Eloquent\Account;

use packages\Domain\Domain\Account\Account;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Account\AccountRepositoryInterface;
use packages\Infrastructure\Eloquent\Account\AccountEloquent;

class AccountRepository implements AccountRepositoryInterface
{
    /**
     * @param Account $account
     * @return mixed
     */
    public function save(Account $account)
    {
        $found = AccountEloquent::firstOrCreate([
            'id' => $account->getId()->getValue(),
        ]);

        $found->balance = $account->getBalance();
        $found->save();
    }

    /**
     * @param AccountId $id
     * @return Account
     */
    public function find(AccountId $id): Account
    {
        $account = AccountEloquent::find($id->getValue());

        return new Account($id, $account->balance);
    }
}
