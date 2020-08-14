<?php

namespace packages\Infrastructure\Eloquent\User;

use packages\Domain\Domain\User\User;
use packages\Domain\Domain\User\UserId;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\User\UserRepositoryInterface;
use packages\Infrastructure\Eloquent\User\UserEloquent;
use packages\Infrastructure\Eloquent\Account\AccountEloquent;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $account = AccountEloquent::create([
            'id' => $user->getAccountId()->getValue(),
            'balance' => 0,
        ]);
        UserEloquent::create([
            'id' => $user->getId()->getValue(),
            'account_id' => $account->id,
        ]);
    }

    /**
     * @param UserId $id
     * @return User
     */
    public function find(UserId $id): User
    {
        $user = UserEloquent::find($id->getValue());

        return new User($id, new AccountId($user->account_id));
    }
}
