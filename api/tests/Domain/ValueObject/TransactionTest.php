<?php

declare(strict_types=1);

namespace Tests\Domain\ValueObject;

use src\Domain\ValueObject\Transaction;
use src\Domain\ValueObject\TransactionId;
use src\Domain\ValueObject\AccountId;
use src\Domain\ValueObject\Money;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testTransactionCreation()
    {
        $transactionId = new TransactionId('txn123');
        $sourceAccountId = new AccountId('acc123');
        $destinationAccountId = new AccountId('acc124');
        $amount = new Money(50.0);
        $type = "Diposit";

        $transaction = new Transaction(
            $transactionId,
            $sourceAccountId,
            $destinationAccountId,
            $amount,
            $type
        );

        $this->assertInstanceOf(Transaction::class, $transaction);







    }
}
