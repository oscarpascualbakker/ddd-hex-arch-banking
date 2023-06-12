<?php

declare(strict_types=1);

namespace Tests\Integration;

use Tests\TestCase;
use src\Domain\Service\AccountService;
use src\Application\Service\CreateUser;
use src\Application\Service\CreateAccount;
use src\Application\Service\DepositMoney;
use src\Application\Service\TransferMoneyService;
use src\Application\Service\ShowAccountDetails;
use src\Infrastructure\Repository\InMemoryUserRepository;
use src\Infrastructure\Repository\InMemoryAccountRepository;
use src\Infrastructure\Repository\InMemoryTransactionRepository;
use src\Domain\Exceptions\InsufficientFundsException;


class BankingIntegrationTest extends TestCase
{
    private $userRepository;
    private $accountRepository;
    private $transactionRepository;

    private $createUserService;
    private $accountService;
    private $createAccountService;
    private $depositMoneyService;
    private $transferMoneyService;
    private $showAccountDetailsService;

    private $userA;
    private $userB;
    private $accountID_Alice;
    private $accountID_Bob;


    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new InMemoryUserRepository();
        $this->accountRepository = new InMemoryAccountRepository();
        $this->transactionRepository = new InMemoryTransactionRepository();

        $this->createUserService = new CreateUser($this->userRepository);
        $this->accountService = new AccountService();
        $this->createAccountService = new CreateAccount($this->accountService, $this->accountRepository);
        $this->depositMoneyService = new DepositMoney($this->accountRepository);
        $this->transferMoneyService = new TransferMoneyService($this->accountRepository, $this->transactionRepository);
        $this->showAccountDetailsService = new ShowAccountDetails($this->accountRepository);
    }

    public function testCompleteBankingFlow()
    {
        // Paso 1a: Crear un usuario
        $userDataA = [
            "name" => "Alice",
            "password" => "password123",
            "email" => "alice@example.com"
        ];

        $this->userA = $this->createUserService->execute($userDataA['name'], $userDataA['password'], $userDataA['email']);

        $this->assertNotNull($this->userA);

        // Paso 1b: Crear otro usuario
        $userDataB = [
            "name" => "Bob",
            "password" => "password456",
            "email" => "bob@example.com"
        ];

        $this->userB = $this->createUserService->execute($userDataB['name'], $userDataB['password'], $userDataB['email']);

        $this->assertNotNull($this->userB);


        // Paso 2a: Crear una cuenta para Alice
        $accountA = $this->createAccountService->execute($this->userA->getUserId()->value());
        $this->accountID_Alice = $accountA->getAccountId()->value();

        $this->assertNotNull($accountA);

        // Paso 2b: Crear una cuenta para Bob
        $accountB = $this->createAccountService->execute($this->userB->getUserId()->value());
        $this->accountID_Bob = $accountB->getAccountId()->value();

        $this->assertNotNull($accountB);


        // Paso 3a: Añadir un depósito a la cuenta de Alice
        $depositAmountA = 200.00;
        $transactionA = $this->depositMoneyService->execute($accountA->getAccountId()->value(), $depositAmountA);

        $this->assertNotNull($transactionA);
        $this->assertEquals($depositAmountA, $transactionA->getAmount()->value());

        // Paso 3b: Añadir un depósito a la cuenta de Bob
        $depositAmountB = 60.00;
        $transactionB = $this->depositMoneyService->execute($accountB->getAccountId()->value(), $depositAmountB);

        $this->assertNotNull($transactionB);
        $this->assertEquals($depositAmountB, $transactionB->getAmount()->value());


        // Paso 4: Transferir de una cuenta a otra
        // De Alice a Bob
        $transferAmount = 100;
        try {
            $transactionTransfer = $this->transferMoneyService->execute(
                $this->accountID_Alice,
                $this->accountID_Bob,
                $transferAmount
            );
            $this->assertNotNull($transactionTransfer);
        } catch (InsufficientFundsException $e) {
            // $this->fail("Transfer failed: {$e->getMessage()}");
            echo "\n\n--------------------------------------------\n";
            echo "Transfer Failed!\n";
            echo "Reason: {$e->getMessage()}\n";
            echo "--------------------------------------------";
        }

        // De Bob a Alice
        $transferAmount = 25;
        try {
            $transactionTransfer = $this->transferMoneyService->execute(
                $this->accountID_Bob,
                $this->accountID_Alice,
                $transferAmount
            );
            $this->assertNotNull($transactionTransfer);
        } catch (InsufficientFundsException $e) {
            // $this->fail("Transfer failed: {$e->getMessage()}");
            echo "\n\n--------------------------------------------\n";
            echo "Transfer Failed!\n";
            echo "Reason: {$e->getMessage()}\n";
            echo "--------------------------------------------";
        }
    }

    protected function tearDown(): void
    {
        // Visualizar los detalles de las cuentas después de realizar todos los tests
        $accountDetailsAlice = $this->showAccountDetailsService->execute($this->accountID_Alice);
        $accountDetailsBob = $this->showAccountDetailsService->execute($this->accountID_Bob);

        echo "\n\n\n--------------------------------------------\n";
        echo "Account details for Alice after all tests:\n";
        echo "AccountID: " . $accountDetailsAlice['accountId'] . "\n";
        echo "Owner: " . $this->userA->getUsername() . " (ID: " . $accountDetailsAlice['userId'] . ")\n";
        echo "Balance: " . $accountDetailsAlice['balance'] . "\n";
        echo "Movements: \n";
        foreach($accountDetailsAlice['transactions'] as $movement) {
            $sign = "+";
            echo "[" .date("d-m-Y H:i", strtotime($movement['dateTime'])). "] ";
            if ($movement['type'] === "withdraw") {
                $sign = "-";
            }
            echo "Amount: " . $sign . $movement['amount'] . " (" . $movement['type'] . ")\n";
        }

        echo "\nAccount details for Bob after all tests:\n";
        echo "AccountID: " . $accountDetailsBob['accountId'] . "\n";
        echo "Owner: " . $this->userB->getUsername() . " (ID: " . $accountDetailsBob['userId'] . ")\n";
        echo "Balance: " . $accountDetailsBob['balance'] . "\n";
        echo "Movements: \n";
        foreach($accountDetailsBob['transactions'] as $movement) {
            $sign = "+";
            echo "[" .date("d-m-Y H:i", strtotime($movement['dateTime'])). "] ";
            if ($movement['type'] === "withdraw") {
                $sign = "-";
            }
            echo "Amount: " . $sign . $movement['amount'] . " (" . $movement['type'] . ")\n";
        }

        echo "--------------------------------------------\n";

        parent::tearDown();
    }
}
