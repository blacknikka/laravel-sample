<?php

namespace Tests\Unit\packages\Domain\Domain\User;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\User\User;
use packages\Domain\Domain\User\UserId;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Game\State\StateStatics;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Token\TokenCreator;
use packages\Domain\Domain\Game\Game;
use packages\Domain\Domain\Game\Play\GamePlay;
use packages\Domain\Domain\Game\State\State;

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

    /**
     * @test
     */
    public function UserのTokenの値が正しい_tokenがNULL()
    {
        $id = new UserId('id');
        $user = new User($id);
        $this->assertEquals(strlen($user->getToken()->getToken()), 40);
    }

    /**
     * @test
     */
    public function UserのTokenの値が正しい_token指定()
    {
        $id = new UserId('id');

        $tokenStr = TokenCreator::createToken();
        $token = new Token($tokenStr);
        $user = new User($id, null, $token);
        $this->assertEquals($user->getToken()->getToken(), $tokenStr);
    }

    /**
     * @test
     */
    public function UserのGameの値が正しい_gameがNULL()
    {
        $id = new UserId('id');
        $user = new User($id);
        $game = $user->getGame();
        $this->assertTrue($game->getState()->isState(StateStatics::STATE_INIT));
    }

    /**
     * @test
     */
    public function UserのGameの値が正しい_game指定()
    {
        $id = new UserId('id');
        $game = new Game(new GamePlay(), new State(StateStatics::STATE_ANOTHER));
        $user = new User($id, null, null, $game);

        $this->assertTrue($user->getGame()->getState()->isState(StateStatics::STATE_ANOTHER));
    }

}
