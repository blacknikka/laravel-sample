<?php

namespace Tests\Unit\packages\Infrastructure\Eloquent\Account;

use Illuminate\Support\Facades\Artisan;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use packages\Infrastructure\Eloquent\Account\AccountRepository;
use packages\Domain\Domain\Account\Account;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Account\AccountStatics;

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
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
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
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
        ]);

        $account->addBalance(100);
        $this->sut->save($account);

        $this->assertDatabaseHas('accounts', [
            'id' => $id,
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE + 100,
        ]);

    }

    /**
     * @test
     */
    public function updateBalance正常系()
    {
        $id = new AccountId(uniqid());
        $account = new Account($id);
        $this->sut->save($account);

        // 前提条件を確認
        $this->assertDatabaseHas('accounts', [
            'id' => $id->getValue(),
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
        ]);

        // update
        $updatedValue = 7000;
        $this->sut->updateBalance($id, $updatedValue);

        // check
        $this->assertDatabaseHas('accounts', [
            'id' => $id->getValue(),
            'balance' => $updatedValue,
        ]);
    }

    /**
     * @test
     */
    public function updateBalance異常系()
    {
        $id = new AccountId(uniqid());
        $account = new Account($id);
        $this->sut->save($account);

        // 前提条件を確認
        $this->assertDatabaseHas('accounts', [
            'id' => $id->getValue(),
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
        ]);

        // update
        $updatedValue = 7000;
        $this->sut->updateBalance(new AccountId(""), $updatedValue);

        // check (変わっていないことをチェック)
        $this->assertDatabaseHas('accounts', [
            'id' => $id->getValue(),
            'balance' => AccountStatics::DEFAULT_BALANCE_VALUE,
        ]);
    }
}
