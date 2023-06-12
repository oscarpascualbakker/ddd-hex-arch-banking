<?php

declare(strict_types=1);

namespace src\Application\Service;

use src\Domain\ValueObject\Money;
use src\Domain\Repository\AccountRepositoryInterface;
use src\Domain\ValueObject\AccountId;
use src\Domain\ValueObject\Transaction;
use src\Domain\Exceptions\AccountNotFoundException;


class DepositMoney
{
    private AccountRepositoryInterface $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(string $accountId, float $amount): Transaction
    {
        $account = $this->accountRepository->findByAccountId(new AccountId($accountId));

        if ($account === null) {
            throw new AccountNotFoundException;
        }

        $money = new Money($amount);

        return $account->deposit($money);
    }
}
