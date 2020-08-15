<?php

namespace packages\Domain\Domain\User;

use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\User\User;

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
}
