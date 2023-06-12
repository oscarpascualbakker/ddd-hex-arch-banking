<?php

declare(strict_types=1);

namespace src\Infrastructure\Repository;

use src\Domain\Model\Account;
use src\Domain\ValueObject\AccountId;
use src\Domain\Repository\AccountRepositoryInterface;


class InMemoryAccountRepository implements AccountRepositoryInterface
{
    private $accounts = [];

    public function save(Account $account): void
    {
        $this->accounts[$account->getAccountId()->value()] = $account;
    }

    public function findByAccountId(AccountId $accountId): ?Account
    {
        $key = $accountId->value();
        return $this->accounts[$key] ?? null;
    }

    public function findById(string $accountId): ?Account
    {
        return $this->accounts[$accountId] ?? null;
    }

    public function all(): array
    {
        return $this->accounts;
    }
}