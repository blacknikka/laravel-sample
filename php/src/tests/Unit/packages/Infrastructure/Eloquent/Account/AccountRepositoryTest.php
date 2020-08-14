<?php

namespace Tests\Unit\packages\Infrastructure\Eloquent\Account;

use Illuminate\Support\Facades\Artisan;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use packages\Infrastructure\Eloquent\Account\AccountRepository;
use packages\Domain\Domain\Account\Account;
use packages\Domain\Domain\Account\AccountId;

class AccountRepositoryTest extends TestCase
{
    /**
     * sut
     *
     * @var AccountRepository
     */
    private $sut;
    protected function setUp(): void
    {
        parent::setUp();

        // データベースマイグレーション
        Artisan::call('migrate:fresh');

        $this->sut = new AccountRepository();
    }

    /**
     * @test
     */
    public function save正常系()
    {
        $id = uniqid();
        $account = new Account(new AccountId($id));
        $this->sut->save($account);

        $this->assertDatabaseHas('accounts', [
            'id' => $id,
            'balance' => 0,
        ]);
    }

    /**
     * @test
     */
    public function save_上書き正常系()
    {
        $id = uniqid();
        $account = new Account(new AccountId($id));
        $this->sut->save($account);

        $this->assertDatabaseHas('accounts', [
            'id' => $id,
            'balance' => 0,
        ]);

        $account->addBalance(100);
        $this->sut->save($account);

        $this->assertDatabaseHas('accounts', [
            'id' => $id,
            'balance' => 100,
        ]);

    }
}
