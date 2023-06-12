<?php

declare(strict_types=1);

namespace Tests\Application\Service;

use PHPUnit\Framework\TestCase;
use src\Application\Service\TransferMoneyService;
use src\Domain\Model\Account;
use src\Domain\ValueObject\UserId;
use src\Domain\ValueObject\Money;
use src\Domain\ValueObject\AccountId;
use src\Infrastructure\Repository\InMemoryAccountRepository;
use src\Infrastructure\Repository\InMemoryTransactionRepository;


class TransferMoneyServiceTest extends TestCase
{
    public function testTransferMoneyService()
    {
        $accountRepo = new InMemoryAccountRepository();
        $transactionRepo = new InMemoryTransactionRepository();

        $transferMoneyService = new TransferMoneyService($accountRepo, $transactionRepo);

        $userId = new UserId('test-user-123');
        $account1 = new Account(new AccountId('account-id-123'), $userId, new Money(500));
        $account2 = new Account(new AccountId('account-id-456'), $userId, new Money(100));

        $accountRepo->save($account1);
        $accountRepo->save($account2);

        $transaction = $transferMoneyService->execute(
            (string)$account1->getAccountId(),
            (string)$account2->getAccountId(),
            100.0
        );

        $this->assertNotNull($transaction);
        $this->assertEquals(400, $account1->getBalance()->value());
        $this->assertEquals(200, $account2->getBalance()->value());
    }
}
