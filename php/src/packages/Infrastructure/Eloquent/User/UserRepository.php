<?php

namespace packages\Infrastructure\Eloquent\User;

use Exception;
use packages\Domain\Domain\User\User;
use packages\Domain\Domain\User\UserId;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Account\AccountStatics;
use packages\Domain\Domain\Game\Game;
use packages\Domain\Domain\Game\Play\GamePlay;
use packages\Domain\Domain\Game\State\State;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\User\UserRepositoryInterface;
use packages\Infrastructure\Eloquent\User\UserEloquent;
use packages\Infrastructure\Eloquent\Account\AccountEloquent;
use packages\Domain\Domain\Token\TokenCreator;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $account = AccountEloquent::create([
            'id' => $user->getAccountId()->getValue(),
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
        ]);
        UserEloquent::create([
            'id' => $user->getId()->getValue(),
            'account_id' => $account->id,
            'token' => $user->getToken()->getToken(),
            'state' => $user->getGame()->getState()->getState(),
            'counter' => $user->getGame()->getState()->getCounter(),
        ]);
    }

    /**
     * @param UserId $id
     * @return User
     */
    public function find(UserId $id): User
    {
        $user = UserEloquent::find($id->getValue());

        return $this->createUserFromEloquent($user);
    }

    /**
     * @param Token
     * @return User
     */
    public function findByToken(Token $token): ?User
    {
        try {
            $user = UserEloquent::where('token', $token->getToken())
            ->firstOrFail();

            return $this->createUserFromEloquent($user);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * update game state
     *
     * @param UserId $id
     * @param State $state
     * @return void
     */
    public function updateGameState(UserId $id, State $state): void
    {
        UserEloquent::where([
            'id' => $id->getValue()
            ])
            ->update([
                'state' => $state->getState(),
                'counter' => $state->getCounter(),
            ]);
    }

    private function createUserFromEloquent(UserEloquent $user): User
    {
        return new User(
            new UserId($user->id),
            new AccountId($user->account_id),
            new Token($user->token),
            new Game(new GamePlay(), new State($user->state)
        ));
    }
}
