<?php

declare(strict_types=1);

namespace src\Domain\Service;

use src\Domain\Exceptions\InsufficientFundsException;
use src\Domain\Repository\AccountRepositoryInterface;
use src\Domain\Repository\TransactionRepositoryInterface;
use src\Domain\ValueObject\Money;
use src\Domain\Model\Transaction;


class TransferMoney
{
    private AccountRepositoryInterface $accountRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(
        AccountRepositoryInterface $accountRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function transfer(string $fromAccountId, string $toAccountId, Money $amount)
    {
        $fromAccount = $this->accountRepository->findById($fromAccountId);
        $toAccount = $this->accountRepository->findById($toAccountId);

        if (!$fromAccount->hasSufficientFunds($amount)) {
            throw new InsufficientFundsException;
        }

        $fromAccount->withdraw($amount);
        $toAccount->deposit($amount);

        $transaction = new Transaction(
            uniqid(),
            $fromAccount,
            $toAccount,
            $amount
        );

        $this->transactionRepository->save($transaction);

        return $transaction;
    }
}
