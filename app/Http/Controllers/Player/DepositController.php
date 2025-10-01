<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\FinanceSetting;
use App\Models\KycDocument;
use App\Models\PaymentOwner;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function bank()
    {
        $paymentOwners = DB::table('payment_owners')
            ->join('payment_channels', 'payment_owners.payment_channel_id', '=', 'payment_channels.id')
            ->where('payment_channels.type', 'bank')
            ->where('payment_owners.is_active', true)
            ->select('payment_owners.*', 'payment_channels.name as channel_name', 'payment_channels.logo as channel_logo')
            ->get();

        $financeSetting = FinanceSetting::first();

        return view('mobile.deposit.bank', compact('paymentOwners', 'financeSetting'));
    }

    public function emoney()
    {
        $paymentOwners = DB::table('payment_owners')
            ->join('payment_channels', 'payment_owners.payment_channel_id', '=', 'payment_channels.id')
            ->where('payment_channels.type', 'ewallet')
            ->where('payment_owners.is_active', true)
            ->select('payment_owners.*', 'payment_channels.name as channel_name', 'payment_channels.logo as channel_logo')
            ->get();

        $financeSetting = FinanceSetting::first();

        return view('mobile.deposit.emoney', compact('paymentOwners', 'financeSetting'));
    }

    public function qris()
    {
        $paymentOwners = DB::table('payment_owners')
            ->join('payment_channels', 'payment_owners.payment_channel_id', '=', 'payment_channels.id')
            ->where('payment_channels.type', 'qris')
            ->where('payment_owners.is_active', true)
            ->select('payment_owners.*', 'payment_channels.name as channel_name')
            ->get()
            ->take(1);

        $financeSetting = FinanceSetting::first();

        return view('mobile.deposit.qris', compact('paymentOwners', 'financeSetting'));
    }

    public function storeBank(Request $request)
    {
        $setting = FinanceSetting::first();
        if (!$setting) {
            return response()->json([
                'message' => '⚠️ Finance setting belum dikonfigurasi.',
            ], 500);
        }

        $minDeposit = (float) $setting->min_deposit;
        $maxDeposit = (float) $setting->max_deposit;

        $request->validate([
            'Amount' => "required|numeric|min:{$minDeposit}".($maxDeposit > 0 ? "|max:{$maxDeposit}" : ''),
            'FromAccountNumber' => 'required|string',
            'ToAccountNumber' => 'required|string',
            'TransactionReceipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();

        $pendingTransaction = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingTransaction) {
            return response()->json([
                'message' => '⚠️ Anda masih memiliki transaksi yang pending, silakan tunggu hingga selesai.',
            ], 400);
        }

        $proofPath = $request->file('TransactionReceipt')->store('proofs', 'public');

        $paymentOwner = PaymentOwner::where('account_number', $request->ToAccountNumber)->first();

        $kyc = KycDocument::where('referral_code', $user->member->referrer_code)
            ->where('status', 'approved')
            ->first();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'trx_type' => 'credit',
            'status' => 'pending',
            'payment_channel_id' => $paymentOwner->id,
            'proof' => $proofPath,
            'amount' => $request->Amount,
            'reason' => "Deposit dari {$request->FromAccountNumber} ke {$request->ToAccountNumber}",
            'referrer_id' => $kyc->user_id ?? null,
        ]);

        return response()->json([
            'message' => '✅ Deposit berhasil diajukan (menunggu approval).',
            'transaction' => $transaction,
        ], 201);
    }

    public function storeQris(Request $request)
    {
        $setting = FinanceSetting::first();
        if (!$setting) {
            return response()->json([
                'message' => '⚠️ Finance setting belum dikonfigurasi.',
            ], 500);
        }

        $minDeposit = (float) $setting->min_deposit;
        $maxDeposit = (float) $setting->max_deposit;

        $request->validate([
            'Amount' => "required|numeric|min:{$minDeposit}".($maxDeposit > 0 ? "|max:{$maxDeposit}" : ''),
            'ToQrisAccount' => 'required|exists:payment_owners,id',
            'TransactionReceipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();

        $pendingTransaction = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingTransaction) {
            return response()->json([
                'message' => '⚠️ Anda masih memiliki transaksi yang pending, silakan tunggu hingga selesai.',
            ], 400);
        }

        $proofPath = $request->file('TransactionReceipt')->store('proofs', 'public');

        $paymentOwner = PaymentOwner::findOrFail($request->ToQrisAccount);

        $kyc = KycDocument::where('referral_code', $user->member->referrer_code)
            ->where('status', 'approved')
            ->first();
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'trx_type' => 'credit',
            'status' => 'pending',
            'payment_channel_id' => $paymentOwner->id,
            'proof' => $proofPath,
            'amount' => $request->Amount,
            'reason' => "Deposit via QRIS ke {$paymentOwner->account_name}",
            'referrer_id' => $kyc->user_id ?? null,
        ]);

        return response()->json([
            'message' => '✅ Deposit via QRIS berhasil diajukan (menunggu approval).',
            'transaction' => $transaction,
        ], 201);
    }
}
