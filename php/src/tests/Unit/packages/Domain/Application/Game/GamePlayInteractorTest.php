<?php

namespace Tests\Unit\packages\Domain\Application\Game;

use Tests\TestCase;
use Exception;
use packages\Domain\Application\Game\GamePlayInteractor;
use packages\Domain\Application\User\UserCreateInteractor;
use packages\Domain\Domain\Token\Token;
use packages\Infrastructure\Eloquent\Account\AccountRepository;
use packages\Infrastructure\Eloquent\User\UserRepository;
use packages\Domain\Domain\Game\Play\GamePlayInterface;
use Mockery;
use packages\Domain\Domain\Game\PlayData\PlayData;

class GamePlayInteractorTest extends TestCase
{
    private $user;
    private $account;

    public function setUp(): void
    {
        parent::setUp();

        // create a user.
        $creation = new UserCreateInteractor(new UserRepository());
        $this->user = $creation->createUser();

        $accountRepository = new AccountRepository();
        $this->account = $accountRepository->find($this->user->getAccountId());
    }

    /**
     * @test
     */
    public function play正常系()
    {
        // use mock for playing game.
        $mock = \Mockery::mock(GamePlayInterface::class);

        $playData = new PlayData('resultX', 0);
        $mock->shouldReceive('play')->andReturn($playData);


        // crate stub.
        $sut = new GamePlayInteractor(
            new UserRepository(),
            new AccountRepository(),
            $mock
        );

        $playResult = $sut->play($this->user->getToken());

        $this->assertSame($playResult->getPlayData(), $playData);
        $this->assertSame(
            $playResult->getAccount()->getBalance(),
            $this->account->getBalance()
        );
    }

    /**
     * @test
     */
    public function play_score加算()
    {
        // use mock for playing game.
        $mock = \Mockery::mock(GamePlayInterface::class);

        $addedScore = 500;
        $playData = new PlayData('resultX', $addedScore);
        $mock->shouldReceive('play')->andReturn($playData);


        // crate stub.
        $sut = new GamePlayInteractor(
            new UserRepository(),
            new AccountRepository(),
            $mock
        );

        $playResult = $sut->play($this->user->getToken());

        $this->assertSame(
            $playResult->getAccount()->getBalance(),
            $this->account->getBalance() + $addedScore
        );
    }
}
