<?php

namespace packages\Domain\Domain\User;

use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\User\User;
use packages\Domain\Domain\Game\State\State;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function save(User $user);

    /**
     * @param UserId $id
     * @return User
     */
    public function find(UserId $id);

    /**
     * @param Token
     * @return User
     */
    public function findByToken(Token $token): ?User;

    /**
     * update game state
     *
     * @param UserId $id
     * @param State $state
     * @return void
     */
    public function updateGameState(UserId $id, State $state): void;
}
