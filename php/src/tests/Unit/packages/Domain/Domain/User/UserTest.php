<?php

namespace Tests\Unit\packages\Domain\Domain\User;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\User\User;
use packages\Domain\Domain\User\UserId;
use packages\Domain\Domain\Account\AccountId;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function UserのgetValueの値が正しい()
    {
        $id = new UserId('id');
        $user = new User($id);
        $this->assertEquals($user->getId()->getValue(), 'id');
    }

    /**
     * @test
     */
    public function UserのgetAccountIdの値が正しい_accouttIdがNULL()
    {
        $id = new UserId('id');
        $user = new User($id);
        $this->assertEquals(strlen($user->getAccountId()->getValue()), 40);
    }

    /**
     * @test
     */
    public function UserのgetAccountIdの値が正しい_accouttId指定()
    {
        $id = new UserId('id');
        $accountId = new AccountId('account');
        $user = new User($id, $accountId);
        $this->assertEquals($user->getAccountId()->getValue(), 'account');
    }
}
