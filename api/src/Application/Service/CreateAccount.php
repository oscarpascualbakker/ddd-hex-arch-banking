<?php

declare(strict_types=1);

namespace src\Application\Service;

use src\Domain\Service\AccountService;
use src\Domain\ValueObject\UserId;
use src\Domain\Model\Account;
use src\Domain\ValueObject\Money;
use src\Domain\Repository\AccountRepositoryInterface;

class CreateAccount
{
    private AccountService $accountService;
    private AccountRepositoryInterface $accountRepository;

    public function __construct(AccountService $accountService, AccountRepositoryInterface $accountRepository)
    {
        $this->accountService = $accountService;
        $this->accountRepository = $accountRepository;
    }

    public function execute(string $userId): Account
    {
        $userId = new UserId($userId);
        $balance = new Money(0);

        $account = $this->accountService->createAccount($userId, $balance);

        $this->accountRepository->save($account);

        return $account;
    }
}
