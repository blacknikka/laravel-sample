<?php


namespace packages\Domain\Application\User;


use packages\UseCase\User\UserCreateUseCaseInterface;
use packages\Domain\Domain\User\UserRepositoryInterface;
use packages\Domain\Domain\User\UserId;
use packages\Domain\Domain\User\User;
use Illuminate\Support\Str;


class UserCreateInteractor implements UserCreateUseCaseInterface
{
    private $userRepositoryInterface;

    /**
     * create
     *
     * @param UserRepositoryInterface $userRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    /**
     * create token(add token to repository)
     *
     * @return User
     */
    public function createUser(): User
    {
        $userId = new UserId(Str::random(40));
        $user = new User($userId);
        $this->userRepositoryInterface->save($user);

        return $user;
    }
}
