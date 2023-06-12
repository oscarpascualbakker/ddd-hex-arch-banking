<?php

declare(strict_types=1);

namespace src\Domain\Model;

use DateTimeImmutable;
use src\Domain\ValueObject\Money;


class Transaction
{
    private string $id;
    private ?Account $sourceAccount;
    private ?Account $destinationAccount;
    private Money $amount;
    private DateTimeImmutable $createdAt;

    public function __construct(
        string $id,
        ?Account $sourceAccount,
        ?Account $destinationAccount,
        Money $amount
    ) {
        $this->id = $id;
        $this->sourceAccount = $sourceAccount;
        $this->destinationAccount = $destinationAccount;
        $this->amount = $amount;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSourceAccount(): ?Account
    {
        return $this->sourceAccount;
    }

    public function getDestinationAccount(): ?Account
    {
        return $this->destinationAccount;
    }

    public function getAmount(): Money
    {
        return $this->amount;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
