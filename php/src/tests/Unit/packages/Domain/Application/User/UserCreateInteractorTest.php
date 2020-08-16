<?php

namespace Tests\Unit\packages\Domain\Application\User;

use Tests\TestCase;
use Exception;
use packages\Domain\Application\User\UserCreateInteractor;
use packages\Infrastructure\Eloquent\User\UserRepository;
use packages\Domain\Domain\Account\AccountStatics;
use packages\Domain\Domain\Game\State\StateStatics;

class UserCreateInteractorTest extends TestCase
{
    /**
     * @test
     */
    public function createUser正常系()
    {
        $sut = new UserCreateInteractor(new UserRepository());
        $user = $sut->createUser();

        $this->assertDatabaseHas('users', [
            'id' => $user->getId()->getValue(),
            'state' => StateStatics::STATE_INIT,
            'counter' => 0,
        ]);

        $this->assertDatabaseHas('accounts', [
            'id' => $user->getAccountId()->getValue(),
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
        ]);
    }
}
