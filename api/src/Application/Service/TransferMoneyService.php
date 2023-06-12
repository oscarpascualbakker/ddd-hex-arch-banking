<?php

declare(strict_types=1);

namespace src\Application\Service;

use src\Domain\Service\TransferMoney as TransferMoneyDomainService;
use src\Domain\Repository\AccountRepositoryInterface;
use src\Domain\Repository\TransactionRepositoryInterface;
use src\Domain\ValueObject\Money;


class TransferMoneyService
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

    public function execute(string $fromAccountId, string $toAccountId, float $amount)
    {
        $transferMoneyDomainService = new TransferMoneyDomainService(
            $this->accountRepository,
            $this->transactionRepository
        );

        $money = new Money($amount);

        return $transferMoneyDomainService->transfer(
            $fromAccountId,
            $toAccountId,
            $money
        );
    }
}