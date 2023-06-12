<?php

declare(strict_types=1);

namespace src\Domain\ValueObject;

use src\Domain\ValueObject\TransactionId;
use src\Domain\ValueObject\AccountId;
use src\Domain\ValueObject\Money;


class Transaction
{
    private TransactionId $transactionId;
    private ?AccountId $sourceAccountId;
    private ?AccountId $destinationAccountId;
    private Money $amount;
    private \DateTimeImmutable $dateTime;
    private string $type;

    public function __construct(TransactionId $transactionId, ?AccountId $sourceAccountId, ?AccountId $destinationAccountId, Money $amount, string $type)
    {
        $this->transactionId = $transactionId;
        $this->sourceAccountId = $sourceAccountId;
        $this->destinationAccountId = $destinationAccountId;
        $this->amount = $amount;
        $this->dateTime = new \DateTimeImmutable();
        $this->type = $type;
    }

    public function toArray(): array
    {
        return [
            'transactionId' => (string) $this->transactionId->value(),
            'sourceAccountId' => (string) $this->sourceAccountId,
            'destinationAccountId' => (string) $this->destinationAccountId,
            'amount' => (float) $this->amount->value(),
            'dateTime' => $this->dateTime->format('Y-m-d\TH:i:s.uP'),
            'type' => $this->type
        ];
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }
}
