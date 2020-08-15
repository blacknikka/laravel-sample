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
}
