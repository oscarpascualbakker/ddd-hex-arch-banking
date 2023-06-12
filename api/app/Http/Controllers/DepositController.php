<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use src\Application\Service\DepositMoney;

class DepositController extends Controller
{
    private $depositMoney;

    public function __construct(DepositMoney $depositMoney)
    {
        $this->depositMoney = $depositMoney;
    }

    public function deposit(Request $request, string $accountId)
    {
        $amount = $request->input('amount');

        try {
            $this->depositMoney->execute($accountId, $amount);
            return response()->json(['message' => 'Money deposited successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

