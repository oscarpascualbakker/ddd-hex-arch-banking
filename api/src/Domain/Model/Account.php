<?php

declare(strict_types=1);

namespace src\Domain\Model;

use src\Domain\ValueObject\AccountId;
use src\Domain\ValueObject\UserId;
use src\Domain\ValueObject\Money;
use src\Domain\ValueObject\TransactionId;
use src\Domain\ValueObject\Transaction;


final class Account
{
    private AccountId $accountId;
    private UserId $userId;
    private Money $balance;
    private array $transactions = [];

    public function __construct(AccountId $accountId, UserId $userId, Money $balance)
    {
        $this->accountId = $accountId;
        $this->userId = $userId;
        $this->balance = $balance;
    }

    public function deposit(Money $amount): Transaction
    {
        $this->balance = $this->balance->add($amount);

        $transaction = new Transaction(
            new TransactionId(uniqid()),
            $this->accountId,
            $this->accountId,
            $amount,
            'deposit'
        );

        $this->addTransaction($transaction);

        return $transaction;
    }

    public function withdraw(Money $amount): Transaction
    {
        if ($this->balance->lessThan($amount)) {
            throw new \InvalidArgumentException('Insufficient funds');
        }

        $this->balance = $this->balance->subtract($amount);

        $transaction = new Transaction(
            new TransactionId(uniqid()),
            $this->accountId,
            null,
            $amount,
            'withdraw'
        );

        $this->addTransaction($transaction);

        return $transaction;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function hasSufficientFunds(Money $amount): bool
    {
        return !$this->balance->lessThan($amount);
    }

    public function toArray(): array
    {
        return [
            'accountId' => $this->accountId->value(),
            'userId' => $this->userId->value(),
            'balance' => (string) $this->balance->value(),
            'transactions' => array_map(fn($t) => $t->toArray(), $this->transactions)
        ];
    }

    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getBalance(): Money
    {
        return $this->balance;
    }
}
