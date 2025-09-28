<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\ProviderCredential;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        try {
            $credential = ProviderCredential::first();

            if ($credential) {
                $response = Http::post('https://api.telo.is/api/v2/info', [
                    'agent_code' => $credential->agent_code,
                    'agent_token' => $credential->agent_token,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['status']) && $data['status'] == 1) {
                        $saldoAgent = $data['agent_balance'] ?? 0;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Gagal ambil saldo agent: '.$e->getMessage());
        }

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
