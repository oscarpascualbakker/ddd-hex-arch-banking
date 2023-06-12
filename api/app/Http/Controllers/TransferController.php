<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use src\Application\Service\TransferMoneyService;

class TransferController extends Controller
{
    private $transferMoneyService;

    public function __construct(TransferMoneyService $transferMoneyService)
    {
        $this->transferMoneyService = $transferMoneyService;
    }

    public function transfer(Request $request)
    {
        $fromAccountId = $request->input('from_account_id');
        $toAccountId = $request->input('to_account_id');
        $amount = $request->input('amount');

        try {
            $transaction = $this->transferMoneyService->execute($fromAccountId, $toAccountId, $amount);
            return response()->json($transaction->toArray(), 201); // 201: Created
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400); // 400: Bad Request
        }
    }
}
