<?php

declare(strict_types=1);

namespace src\Application\Service;

use src\Domain\Repository\AccountRepositoryInterface;
use src\Domain\ValueObject\AccountId;
use src\Domain\Exceptions\AccountNotFoundException;


class ShowAccountDetails
{
    private AccountRepositoryInterface $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(string $accountId)
    {
        $account = $this->accountRepository->findByAccountId(new AccountId($accountId));

        if (!$account) {
            throw new AccountNotFoundException;
        }

        return $account->toArray();
    }
}