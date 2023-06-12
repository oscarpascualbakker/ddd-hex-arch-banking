<?php

declare(strict_types=1);

namespace src\Domain\Service;

use src\Domain\ValueObject\AccountId;
use src\Domain\ValueObject\Money;
use src\Domain\ValueObject\UserId;
use src\Domain\Model\Account;

class AccountService
{
    public function createAccount(UserId $userId, Money $balance): Account
    {
        $accountId = new AccountId(uniqid());
        return new Account($accountId, $userId, $balance);
    }
}
