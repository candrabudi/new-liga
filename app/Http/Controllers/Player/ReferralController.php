<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\KycDocument;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kyc = $user->kycDocuments()->latest()->first();

        return view('mobile.referral.guidance', compact('kyc'));
    }

    public function signupsSummary(Request $request)
    {
        $user = Auth::user();

        $startDate = $request->input('StartingDate', now()->startOfMonth()->toDateString());
        $endDate = $request->input('EndingDate', now()->endOfMonth()->toDateString());

        $members = DB::table('members')
            ->join('users', 'members.user_id', '=', 'users.id')
            ->where('members.referrer_code', function ($query) use ($user) {
                $query->select('referral_code')
                    ->from('kyc_documents')
                    ->where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->limit(1);
            })
            ->whereBetween('members.created_at', [$startDate, $endDate])
            ->select(
                'members.user_id', // ambil user_id untuk cek transaksi
                'users.full_name as name',
                'users.phone_number as phone',
                'members.created_at as joined_at'
            )
            ->get();

        $data = $members->map(function ($member) {
            $depositCount = DB::table('transactions')
                ->where('user_id', $member->user_id)
                ->where('type', 'deposit')
                ->where('status', 'approved')
                ->count();

            return [
                'name' => $member->name ?? '-',
                'phone' => $member->phone ?? '-',
                'joined_at' => \Carbon\Carbon::parse($member->joined_at)->format('d-m-Y H:i'),
                'deposits' => $depositCount,
            ];
        });

        return view('mobile.referral.signups_summary', [
            'members' => $data,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function verification()
    {
        return view('mobile.referral.verification');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|in:KTP,SIM,PASSPORT',
            'document_number' => 'nullable|string|max:100',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'full_name' => 'required|string|min:2|max:150',
        ]);

        $file = $request->file('file');

        $imageInfo = @getimagesize($file->getPathname());
        if ($imageInfo === false) {
            return response()->json(['message' => 'File bukan gambar yang valid'], 422);
        }

        $userId = Auth::id();
        $fullName = trim(strip_tags($validated['full_name']));
        $documentNumber = isset($validated['document_number']) ? trim(strip_tags($validated['document_number'])) : null;
        $documentType = $validated['document_type'];

        $result = DB::transaction(function () use ($userId, $file, $documentType, $documentNumber, $fullName) {
            $exists = KycDocument::where('user_id', $userId)
                ->whereIn('status', ['pending', 'approved'])
                ->lockForUpdate()
                ->exists();

            if ($exists) {
                return ['status' => 'exists'];
            }

            $storageDisk = 'public';
            $storageFolder = 'kyc/'.date('Y').'/'.date('m');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = 'kyc_'.$userId.'_'.Str::random(24).'.'.$extension;
            $path = $file->storeAs($storageFolder, $filename, $storageDisk);

            if (!$path) {
                return ['status' => 'store_failed'];
            }

            $referralCode = $this->generateUniqueReferralCode();

            $kyc = KycDocument::create([
                'user_id' => $userId,
                'profile_id' => Auth::user()->profile->id ?? null,
                'referral_code' => $referralCode,
                'document_type' => $documentType,
                'document_number' => $documentNumber,
                'file_path' => $path,
                'status' => 'pending',
            ]);

            if ($kyc) {
                $profile = Auth::user()->profile;
                if ($profile) {
                    $updated = false;
                    if (empty($profile->full_name) && $fullName !== '') {
                        $profile->full_name = $fullName;
                        $updated = true;
                    }
                    if ($updated) {
                        $profile->save();
                    }
                }

                return ['status' => 'ok', 'kyc' => $kyc];
            }

            Storage::disk($storageDisk)->delete($path);

            return ['status' => 'db_failed'];
        });

        if ($result['status'] === 'exists') {
            return response()->json(['message' => 'Anda sudah memiliki dokumen aktif atau sedang diproses'], 422);
        }
        if ($result['status'] === 'store_failed') {
            return response()->json(['message' => 'Gagal menyimpan file'], 500);
        }
        if ($result['status'] === 'db_failed') {
            return response()->json(['message' => 'Gagal menyimpan data'], 500);
        }
        if ($result['status'] === 'ok') {
            return response()->json(['message' => 'Dokumen berhasil diupload', 'data' => $result['kyc']], 201);
        }

        return response()->json(['message' => 'Terjadi kesalahan'], 500);
    }

    protected function generateUniqueReferralCode()
    {
        do {
            $code = 'REF-'.strtoupper(Str::random(8));
            $exists = KycDocument::where('referral_code', $code)->exists();
        } while ($exists);

        return $code;
    }

    public function referralCommissions(Request $request)
    {
        $user = Auth::user();

        $startDate = $request->input('StartingDate', now()->startOfMonth()->toDateString());
        $endDate = $request->input('EndingDate', now()->endOfMonth()->toDateString());

        $commissions = Transaction::where('type', 'commission')
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('sourceUser.profile')
            ->get()
            ->map(function ($trx) {
                $sourceUser = $trx->sourceUser;
                $totalDeposit = $sourceUser
                    ? $sourceUser->transactions()->where('type', 'deposit')->where('status', 'approved')->sum('amount')
                    : 0;

                return [
                    'name' => $sourceUser->profile->full_name ?? $sourceUser->full_name ?? '-',
                    'phone' => $sourceUser->profile->contact_no ?? $sourceUser->phone_number ?? '-',
                    'total_deposit' => $totalDeposit,
                    'commission_amount' => $trx->amount,
                    'created_at' => $trx->created_at->format('d-m-Y H:i'),
                ];
            });

        return view('mobile.referral.commissions', [
            'commissions' => $commissions,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
