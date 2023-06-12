<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use src\Application\Service\CreateAccount;
use src\Application\Service\ShowAccountDetails;
use src\Infrastructure\Repository\InMemoryAccountRepository;
use src\Domain\ValueObject\AccountId;

class AccountController extends Controller
{
    private $createAccount;
    private $accountRepository;
    private $showAccountDetails;

    public function __construct(CreateAccount $createAccount, InMemoryAccountRepository $accountRepository, ShowAccountDetails $showAccountDetails)
    {
        $this->createAccount = $createAccount;
        $this->accountRepository = $accountRepository;
        $this->showAccountDetails = $showAccountDetails;
    }

    public function store(Request $request)
    {
        $userId = $request->input('user_id');

        $account = $this->createAccount->execute($userId);

        return response()->json($account->toArray(), 201);
    }

    public function show(string $accountId)
    {
        try {
            $account = $this->showAccountDetails->execute($accountId);
            return response()->json($account->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
