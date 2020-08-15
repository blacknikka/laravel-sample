<?php

namespace packages\UseCase\User;

use packages\Domain\Domain\User\User;

interface UserCreateUseCaseInterface
{
    /**
     * Create a user and an account.
     *
     * @return User
     */
    public function createUser(): User;
}
