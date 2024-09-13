<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\WalletService;

class WalletController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function balance($userId)
    {
        return response()->json($this->walletService->getWalletBalance($userId));
    }

    public function fund(Request $request)
    {
        $data = $request->all();
        return response()->json($this->walletService->fundWallet($data));
    }

    public function transactions($userId)
    {
        return response()->json($this->walletService->getUserTransactions($userId));
    }
}
