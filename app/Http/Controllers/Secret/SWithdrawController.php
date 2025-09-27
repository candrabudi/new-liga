<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\ProviderCredential;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SWithdrawController extends Controller
{
    /**
     * Halaman withdraw pending.
     */
    public function pending()
    {
        return view('secret.transaction.withdraw.pending');
    }

    /**
     * Data withdraw pending (JSON).
     */
    public function pendingWithdraws(Request $request)
    {
        $search = $request->input('search');

        $query = Transaction::with(['user', 'paymentChannel'])
            ->where('type', 'withdraw')
            ->where('status', 'pending');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        $transactions = $query->latest()->paginate(10);

        return response()->json($transactions);
    }

    /**
     * Approve withdraw.
     */
    public function approve($id)
    {
        $trx = Transaction::where('type', 'withdraw')->findOrFail($id);
        $trx->status = 'approved';
        $trx->updated_by = auth()->id();
        $trx->save();

        return response()->json(['message' => 'Withdraw disetujui']);
    }

    /**
     * Reject withdraw.
     */
    public function reject($id, Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $trx = Transaction::where('type', 'withdraw')->findOrFail($id);

        if ($trx->status !== 'pending') {
            return response()->json([
                'message' => 'Transaksi tidak bisa ditolak karena bukan status pending.',
            ], 400);
        }

        $member = Member::where('user_id', $trx->user_id)->firstOrFail();
        $credential = ProviderCredential::first();

        if (!$credential) {
            return response()->json([
                'message' => '⚠️ Credential provider belum dikonfigurasi.',
            ], 500);
        }

        $response = Http::post('https://api.telo.is/api/v2/user_deposit', [
            'agent_code' => $credential->agent_code,
            'agent_token' => $credential->agent_token,
            'user_code' => $member->ext_code,
            'amount' => $trx->amount,
        ]);

        $data = $response->json();

        if (!isset($data['status']) || $data['status'] != 1) {
            return response()->json([
                'message' => $data['msg'] ?? 'Gagal mengembalikan saldo ke provider.',
            ], 422);
        }

        $trx->status = 'rejected';
        $trx->reason = $request->reason;
        $trx->updated_by = auth()->id();
        $trx->save();

        $member->increment('balance', $trx->amount);

        return response()->json([
            'message' => 'Withdraw ditolak dan saldo berhasil dikembalikan ke user.',
            'provider_balance' => $data['user_balance'] ?? null,
        ]);
    }

    /**
     * Halaman history withdraw.
     */
    public function history()
    {
        return view('secret.transaction.withdraw.history');
    }

    /**
     * Data history withdraw (JSON).
     */
    public function historyList(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Transaction::with(['user', 'paymentChannel'])
            ->where('type', 'withdraw')
            ->where('status', '!=', 'pending'); // exclude pending

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($start && $end) {
            $query->whereBetween('created_at', [$start.' 00:00:00', $end.' 23:59:59']);
        }

        $transactions = $query->latest()->paginate(10);

        return response()->json($transactions);
    }
}
