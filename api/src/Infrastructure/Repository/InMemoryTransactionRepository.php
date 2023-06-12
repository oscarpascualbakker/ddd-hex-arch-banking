<?php

declare(strict_types=1);

namespace src\Infrastructure\Repository;

use src\Domain\Model\Transaction;
use src\Domain\Repository\TransactionRepositoryInterface;


class InMemoryTransactionRepository implements TransactionRepositoryInterface
{
    private array $transactions = [];

    public function save(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function all(): array
    {
        return $this->transactions;
    }
}