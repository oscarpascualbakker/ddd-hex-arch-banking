<?php

declare(strict_types=1);

namespace src\Domain\Repository;

use src\Domain\Model\Transaction;


interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;

    public function all(): array;
}
