<?php

namespace Tests\Unit\packages\Domain\Domain\Account;

use PHPUnit\Framework\TestCase;
use packages\Domain\Domain\Account\AccountId;
use packages\Domain\Domain\Account\Account;
use Exception;

class AccountTest extends TestCase
{
    private const AccountIdStr = 'accountId';
    private $accountId;

    public function setUp(): void
    {
        parent::setUp();

        // id 作成
        $this->accountId = new AccountId(self::AccountIdStr);
    }

    /**
     * @test
     */
    public function Accountのコンストラクタ_残高指定なし()
    {
        $account = new Account($this->accountId);
        $this->assertEquals($account->getId()->getValue(), self::AccountIdStr);
        $this->assertEquals($account->getBalance(), 0);
    }

    /**
     * @test
     */
    public function Accountのコンストラクタ_残高指定正常系()
    {
        $account = new Account($this->accountId, 100);
        $this->assertEquals($account->getId()->getValue(), self::AccountIdStr);
        $this->assertEquals($account->getBalance(), 100);
    }

    /**
     * @test
     */
    public function Accountのコンストラクタ_マイナス値はエラー()
    {
        $this->expectException(Exception::class);

        new Account($this->accountId, -100);
    }

    /**
     * @test
     */
    public function Account_getId()
    {
        $account = new Account($this->accountId, 100);
        $this->assertEquals($account->getId()->getValue(), self::AccountIdStr);
    }

    /**
     * @test
     */
    public function Account_getBalance()
    {
        $account = new Account($this->accountId, 100);
        $this->assertEquals($account->getBalance(), 100);
    }

    /**
     * @test
     */
    public function Account_useBalance()
    {
        $account = new Account($this->accountId, 100);
        $account->useBalance(20);
        $this->assertEquals($account->getBalance(), 80);
    }

    /**
     * @test
     */
    public function Account_useBalance_残高より多く使った場合()
    {
        $this->expectException(Exception::class);

        $account = new Account($this->accountId, 100);
        $account->useBalance(200);
    }

    /**
     * @test
     */
    public function Account_addBalance()
    {
        $account = new Account($this->accountId, 100);
        $account->addBalance(20);
        $this->assertEquals($account->getBalance(), 120);
    }

    /**
     * @test
     */
    public function Account_addBalance_マイナスの値を足す()
    {
        $this->expectException(Exception::class);

        $account = new Account($this->accountId, 100);
        $account->addBalance(-20);
    }
}
