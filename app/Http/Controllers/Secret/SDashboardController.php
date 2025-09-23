<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class SDashboardController extends Controller
{
    public function index()
    {
        $totalDeposit = Transaction::where('type', 'deposit')
            ->where('status', 'approved')
            ->sum('amount');

        $totalWithdraw = Transaction::where('type', 'withdraw')
            ->where('status', 'approved')
            ->sum('amount');

        $totalMember = User::where('role', 'player')->count();
        $saldoAgent = 0;

        $totalDepositPending = Transaction::where('type', 'deposit')
            ->where('status', 'pending')
            ->sum('amount');

        $totalWithdrawPending = Transaction::where('type', 'withdraw')
            ->where('status', 'pending')
            ->sum('amount');

        $estimasiKeuntungan = $totalDeposit - $totalWithdraw;

        return view('secret.dashboard.index', compact(
            'totalDeposit',
            'totalWithdraw',
            'totalMember',
            'saldoAgent',
            'totalDepositPending',
            'totalWithdrawPending',
            'estimasiKeuntungan'
        ));
    }
}
