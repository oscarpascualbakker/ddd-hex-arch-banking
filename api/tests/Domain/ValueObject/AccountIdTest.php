<?php

declare(strict_types=1);

namespace Tests\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use src\Domain\ValueObject\AccountId;


class AccountIdTest extends TestCase
{
    public function testAccountIdCanBeConstructed()
    {
        $accountId = new AccountId('some-account-id');
        $this->assertInstanceOf(AccountId::class, $accountId);
    }

    public function testAccountIdCannotBeEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        new AccountId('');
    }

    public function testEqualsReturnsTrueWhenAccountIdsAreEqual()
    {
        $accountId1 = new AccountId('account-id-123');
        $accountId2 = new AccountId('account-id-123');

        $this->assertTrue($accountId1->equals($accountId2));
    }

    public function testEqualsReturnsFalseWhenAccountIdsAreNotEqual()
    {
        $accountId1 = new AccountId('account-id-123');
        $accountId2 = new AccountId('account-id-456');

        $this->assertFalse($accountId1->equals($accountId2));
    }

    public function testValueMethodReturnsCorrectAccountId()
    {
        $accountId = new AccountId('account-id-123');
        $this->assertEquals('account-id-123', $accountId->value());
    }
}
