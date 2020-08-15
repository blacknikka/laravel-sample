<?php

namespace Tests\Unit\packages\Infrastructure\Eloquent\User;

use Illuminate\Support\Facades\Artisan;
use packages\Domain\Domain\Token\Token;
use packages\Domain\Domain\Token\TokenCreator;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use packages\Infrastructure\Eloquent\User\UserRepository;
use packages\Domain\Domain\User\User;
use packages\Domain\Domain\User\UserId;
use Illuminate\Support\Str;
use packages\Domain\Domain\Game\State\State;
use packages\Domain\Domain\Game\State\StateStatics;

class UserRepositoryTest extends TestCase
{
    /**
     * sut
     *
     * @var UserRepository
     */
    private $sut;
    protected function setUp(): void
    {
        parent::setUp();

        // データベースマイグレーション
        Artisan::call('migrate:fresh');

        $this->sut = new UserRepository();
    }

    /**
     * @test
     */
    public function create正常系()
    {
        $id = uniqid();
        $user = new User(new UserId($id));
        $this->sut->save($user);

        $this->assertDatabaseHas('users', [
            'id' => $id,
        ]);

        $this->assertDatabaseHas('accounts', [
            'id' => $user->getAccountId()->getValue(),
            'balance' => 0,
        ]);
    }

    /**
     * @test
     */
    public function find正常系()
    {
        $id = uniqid();
        $user = new User(new UserId($id));
        $this->sut->save($user);

        $found = $this->sut->find($user->getId());

        $this->assertEquals($user, $found);
    }

    /**
     * @test
     */
    public function findByToken正常系()
    {
        $id = uniqid();
        $user = new User(new UserId($id));
        $this->sut->save($user);

        $token = new Token($user->getToken()->getToken());
        $found = $this->sut->findByToken($token);

        $this->assertEquals($user, $found);
    }

    /**
     * @test
     */
    public function findByToken異常系()
    {
        $id = uniqid();
        $user = new User(new UserId($id));
        $this->sut->save($user);

        // 別のTokenを作る
        $token = new Token(Str::random(TokenCreator::TOKEN_LENGTH));
        $found = $this->sut->findByToken($token);

        $this->assertNull($found);
    }

    /**
     * @test
     */
    public function updateGameState正常系()
    {
        $id = new UserId(uniqid());
        $user = new User($id);
        $this->sut->save($user);

        // 前提条件をチェックする
        $this->assertDatabaseHas('users', [
            'id' => $id->getValue(),
            'state' => StateStatics::STATE_INIT,
            'counter' => 0,
        ]);

        // 新しいstateを作る
        $state = new State(StateStatics::STATE_ANOTHER);
        $state->PlayAndTransitState();

        $this->sut->updateGameState($id, $state);

        $this->assertDatabaseHas('users', [
            'id' => $id->getValue(),
            'state' => StateStatics::STATE_ANOTHER,
            'counter' => 1,
        ]);
    }

    /**
     * @test
     */
    public function updateGameState異常系()
    {
        $id = new UserId(uniqid());
        $user = new User($id);
        $this->sut->save($user);

        // 前提条件をチェックする
        $this->assertDatabaseHas('users', [
            'id' => $id->getValue(),
            'state' => StateStatics::STATE_INIT,
            'counter' => 0,
        ]);

        // 新しいstateを作る
        $state = new State(StateStatics::STATE_ANOTHER);
        $state->PlayAndTransitState();

        // 存在しないIDで検索する
        $this->sut->updateGameState(new UserId(uniqid()), $state);

        // データが変わっていないことを確認する
        $this->assertDatabaseHas('users', [
            'id' => $id->getValue(),
            'state' => StateStatics::STATE_INIT,
            'counter' => 0,
        ]);
    }
}
