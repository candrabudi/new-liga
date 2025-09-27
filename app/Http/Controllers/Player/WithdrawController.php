<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\FinanceSetting;
use App\Models\Member;
use App\Models\ProviderCredential;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WithdrawController extends Controller
{
    public function index()
    {
        return view('mobile.withdraw.index');
    }

    public function store(Request $request)
    {
        $setting = FinanceSetting::first();
        if (!$setting) {
            return response()->json([
                'message' => '⚠️ Finance setting belum dikonfigurasi.',
            ], 500);
        }

        $minWithdraw = (float) $setting->min_withdraw;
        $maxWithdraw = (float) $setting->max_withdraw;

        $request->validate([
            'Amount' => "required|numeric|min:{$minWithdraw}".($maxWithdraw > 0 ? "|max:{$maxWithdraw}" : ''),
            'bank_id' => 'required|exists:members,payment_channel_id',
        ]);

        $amount = $request->Amount;
        $user = Auth::user();

        $bankAccount = Member::where('payment_channel_id', $request->bank_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$bankAccount) {
            return response()->json([
                'message' => '⚠️ Bank tujuan tidak ditemukan.',
            ], 404);
        }

        $pendingTransaction = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingTransaction) {
            return response()->json([
                'message' => '⚠️ Anda masih memiliki transaksi yang pending, silakan tunggu hingga selesai.',
            ], 400);
        }

        if ($user->member->balance < $amount) {
            return response()->json([
                'message' => '⚠️ Saldo tidak mencukupi untuk penarikan.',
            ], 400);
        }

        $credential = ProviderCredential::first();
        if (!$credential) {
            return response()->json([
                'message' => '⚠️ Credential provider belum dikonfigurasi.',
            ], 500);
        }

        $response = Http::post('https://api.telo.is/api/v2/user_withdraw', [
            'agent_code' => $credential->agent_code,
            'agent_token' => $credential->agent_token,
            'user_code' => $user->member->ext_code,
            'amount' => $amount,
        ]);

        $data = $response->json();

        if (!isset($data['status']) || $data['status'] != 1) {
            return response()->json([
                'message' => $data['msg'] ?? 'Gagal melakukan penarikan ke provider.',
            ], 422);
        }

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdraw',
            'trx_type' => 'debit',
            'status' => 'pending',
            'payment_channel_id' => $bankAccount->id,
            'amount' => $amount,
            'reason' => "Withdraw ke bank {$bankAccount->bank_name} ({$bankAccount->account_number})",
        ]);

        $user->member->decrement('balance', $amount);

        return response()->json([
            'message' => '✅ Penarikan berhasil diajukan (menunggu approval) dan saldo telah dipotong di provider.',
            'transaction' => $transaction,
            'provider_balance' => $data['user_balance'] ?? null,
        ], 201);
    }
}
