<?php

declare(strict_types=1);

namespace Tests\Domain\Account;

use src\Domain\Model\Account;
use src\Domain\ValueObject\AccountId;
use src\Domain\ValueObject\Money;
use src\Domain\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public function testAccountCreation()
    {
        $accountId = new AccountId('123');
        $userId = new UserId('user1');
        $balance = new Money(100.0);

        $account = new Account($accountId, $userId, $balance);

        $this->assertInstanceOf(Account::class, $account);
        $this->assertEquals($accountId, $account->getAccountId());
        $this->assertEquals($userId, $account->getUserId());
        $this->assertEquals($balance, $account->getBalance());
    }

    public function testAccountToArray()
    {
        $accountId = new AccountId('123');
        $userId = new UserId('user1');
        $balance = new Money(100.0);

        $account = new Account($accountId, $userId, $balance);

        $expectedArray = [
            'accountId' => '123',
            'userId' => 'user1',
            'balance' => 100.00,
            'transactions' => []
        ];

        $this->assertEquals($expectedArray, $account->toArray());
    }
}

