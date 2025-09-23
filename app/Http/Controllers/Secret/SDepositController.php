<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\ProviderCredential;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SDepositController extends Controller
{
    public function pending()
    {
        return view('secret.transaction.deposit.pending');
    }

    public function pendingDeposits(Request $request)
    {
        $search = $request->input('search');

        $query = Transaction::with(['user', 'paymentChannel'])
            ->where('type', 'deposit')
            ->where('status', 'pending');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%");
            });
        }

        $transactions = $query->latest()->paginate(10);

        return response()->json($transactions);
    }

    public function history()
    {
        return view('secret.transaction.deposit.history');
    }

    public function historyList(Request $request)
    {
        $search     = $request->input('search');
        $status     = $request->input('status');
        $start_date = $request->input('start_date');
        $end_date   = $request->input('end_date');

        $query = Transaction::with(['user', 'paymentChannel'])
            ->where('type', 'deposit')
            ->where('status', '!=', 'pending');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($start_date) {
            $query->whereDate('created_at', '>=', $start_date);
        }
        if ($end_date) {
            $query->whereDate('created_at', '<=', $end_date);
        }

        $transactions = $query->latest()->paginate(10);

        return response()->json($transactions);
    }

    public function approve($id)
    {
        return DB::transaction(function () use ($id) {
            $trx = Transaction::where('id', $id)->where('status', 'pending')->firstOrFail();

            $member     = Member::where('user_id', $trx->user_id)->firstOrFail();
            $credential = ProviderCredential::first(); // agent_code & agent_token

            // Panggil API user_deposit
            $response = Http::post('https://api.telo.is/api/v2/user_deposit', [
                'agent_code'  => $credential->agent_code,
                'agent_token' => $credential->agent_token,
                'user_code'   => $member->ext_code,
                'amount'      => $trx->amount,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['status']) && $data['status'] == 1) {
                // update transaksi
                $trx->status     = 'approved';
                $trx->updated_by = Auth::id();
                $trx->save();

                // update saldo member
                $member->balance += $trx->amount;
                $member->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Deposit disetujui, saldo bertambah dan deposit ke provider berhasil.',
                    'data'    => $data
                ]);
            }

            // Gagal deposit ke provider
            return response()->json([
                'success' => false,
                'message' => $data['msg'] ?? 'Gagal melakukan deposit ke provider.'
            ], 422);
        });
    }

    // Reject deposit
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255'
        ]);

        $trx = Transaction::where('id', $id)->where('status', 'pending')->firstOrFail();

        $trx->status = 'rejected';
        $trx->reason = $request->reason;
        $trx->updated_by = Auth::id();
        $trx->save();

        return response()->json([
            'success' => true,
            'message' => 'Deposit ditolak.'
        ]);
    }
}
