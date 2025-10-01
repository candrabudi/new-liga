<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\ProviderCredential;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $search = $request->input('search');
        $status = $request->input('status');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

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
            $trx = Transaction::where('id', $id)
                ->where('status', 'pending')
                ->firstOrFail();

            $member = Member::where('user_id', $trx->user_id)->firstOrFail();
            $credential = ProviderCredential::first();

            $response = Http::post('https://api.telo.is/api/v2/user_deposit', [
                'agent_code' => $credential->agent_code,
                'agent_token' => $credential->agent_token,
                'user_code' => $member->ext_code,
                'amount' => $trx->amount,
            ]);

            $data = $response->json();

            if ($response->successful() && isset($data['status']) && $data['status'] == 1) {
                $trx->status = 'approved';
                $trx->updated_by = Auth::id();
                $trx->save();

                $member->balance += $trx->amount;
                $member->save();

                if (!empty($member->referrer_code)) {
                    $referrerUser = DB::table('kyc_documents')
                        ->where('referral_code', $member->referrer_code)
                        ->where('status', 'approved')
                        ->first();

                    if ($referrerUser) {
                        $commissionSetting = \App\Models\ReferralCommissionSetting::first();
                        $percentage = $commissionSetting->percentage ?? 0;

                        if ($percentage > 0) {
                            $commissionAmount = ($trx->amount * $percentage) / 100;

                            $commissionTrx = new Transaction();
                            $commissionTrx->user_id = $referrerUser->user_id;
                            $commissionTrx->referred_user_id = $trx->user_id;
                            $commissionTrx->type = 'commission';
                            $commissionTrx->trx_type = 'credit';
                            $commissionTrx->status = 'approved';
                            $commissionTrx->amount = $commissionAmount;
                            $commissionTrx->reason = "Komisi referral dari deposit user ID {$trx->user_id}";
                            $commissionTrx->updated_by = Auth::id();
                            $commissionTrx->save();

                            $referrerMember = Member::where('user_id', $referrerUser->user_id)->first();
                            if ($referrerMember) {
                                $referrerMember->balance += $commissionAmount;
                                $referrerMember->save();

                                $commissionResponse = Http::post('https://api.telo.is/api/v2/user_deposit', [
                                    'agent_code' => $credential->agent_code,
                                    'agent_token' => $credential->agent_token,
                                    'user_code' => $referrerMember->ext_code,
                                    'amount' => $commissionAmount,
                                ]);

                                if (!$commissionResponse->successful()) {
                                    Log::warning('Gagal deposit komisi referral ke provider', [
                                        'referrer_user_id' => $referrerUser->user_id,
                                        'source_user_id' => $trx->user_id,
                                        'commissionAmount' => $commissionAmount,
                                        'response' => $commissionResponse->body(),
                                    ]);
                                }
                            }
                        }
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Deposit disetujui, saldo bertambah, deposit ke provider berhasil & komisi referral diberikan.',
                    'data' => $data,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $data['msg'] ?? 'Gagal melakukan deposit ke provider.',
            ], 422);
        });
    }

    // Reject deposit
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $trx = Transaction::where('id', $id)->where('status', 'pending')->firstOrFail();

        $trx->status = 'rejected';
        $trx->reason = $request->reason;
        $trx->updated_by = Auth::id();
        $trx->save();

        return response()->json([
            'success' => true,
            'message' => 'Deposit ditolak.',
        ]);
    }
}
