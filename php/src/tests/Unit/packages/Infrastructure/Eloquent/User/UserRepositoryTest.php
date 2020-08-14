<?php

namespace Tests\Unit\packages\Infrastructure\Eloquent\User;

use Illuminate\Support\Facades\Artisan;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use packages\Infrastructure\Eloquent\User\UserRepository;
use packages\Domain\Domain\User\User;
use packages\Domain\Domain\User\UserId;

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
}
