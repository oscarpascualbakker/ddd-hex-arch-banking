<?php

declare(strict_types=1);

namespace src\Domain\Repository;

use src\Domain\Model\Account;
use src\Domain\ValueObject\AccountId;


interface AccountRepositoryInterface
{
    public function save(Account $account): void;

    public function findByAccountId(AccountId $accountId): ?Account;

    public function findById(string $accountId): ?Account;
}