<?php

declare(strict_types=1);

namespace Tests\Domain\ValueObject;

use src\Domain\ValueObject\TransactionId;
use PHPUnit\Framework\TestCase;

class TransactionIdTest extends TestCase
{
    public function testTransactionIdCreation()
    {
        $transactionId = new TransactionId('txn123');

        $this->assertInstanceOf(TransactionId::class, $transactionId);
        $this->assertEquals('txn123', $transactionId->value());
    }

    public function testTransactionIdEquality()
    {
        $transactionId1 = new TransactionId('txn123');
        $transactionId2 = new TransactionId('txn123');
        $transactionId3 = new TransactionId('txn124');

        $this->assertTrue($transactionId1->equals($transactionId2));
        $this->assertFalse($transactionId1->equals($transactionId3));
    }
}
