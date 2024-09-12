<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;

class WalletService
{
    public function getWalletBalance($userId)
    {
        return Wallet::where('user_id', $userId)->first()->balance;
    }

    public function fundWallet($data)
    {
        // Integrate Paystack for payment here
        // Update wallet balance
        return 'Wallet funded';
    }

    public function getUserTransactions($userId)
    {
        return Transaction::where('user_id', $userId)->get();
    }
}
