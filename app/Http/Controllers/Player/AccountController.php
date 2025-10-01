<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\ProviderCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    public function accountSummary()
    {
        return view('mobile.account.account_summary');
    }

    public function password()
    {
        return view('mobile.account.password');
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('mobile.account.profile', compact('user', 'profile'));
    }

    public function storeOrUpdate(Request $request)
    {
        $user = Auth::user();

        // Validasi dengan JSON response
        $validator = Validator::make($request->all(), [
            'FullName' => 'required|string|max:150',
            'Gender' => 'nullable|in:M,F',
            'Address' => 'nullable|string',
            'Postcode' => 'nullable|string|max:10',
            'State' => 'nullable|string|max:100',
            'ContactNo' => 'nullable|string|max:16',
            'Email' => 'required|email|max:100',
            'Telegram' => 'nullable|string|max:16',
            'WhatsApp' => 'nullable|string|max:16',
            'WeChat' => 'nullable|string|max:50',
            'Line' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $profile = DB::transaction(function () use ($validator, $user) {
                return Profile::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'full_name' => $validator->validated()['FullName'],
                        'gender' => $validator->validated()['Gender'] ?? null,
                        'address' => $validator->validated()['Address'] ?? null,
                        'postcode' => $validator->validated()['Postcode'] ?? null,
                        'state' => $validator->validated()['State'] ?? null,
                        'contact_no' => $validator->validated()['ContactNo'] ?? null,
                        'email' => $validator->validated()['Email'],
                        'telegram' => $validator->validated()['Telegram'] ?? null,
                        'whatsapp' => $validator->validated()['WhatsApp'] ?? null,
                        'wechat' => $validator->validated()['WeChat'] ?? null,
                        'line' => $validator->validated()['Line'] ?? null,
                    ]
                );
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Profil berhasil disimpan',
                'data' => $profile,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'NewPassword' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^*()_+=\[\]{}|:;"\',.?\/~`\-]+$/',
                'different:OldPassword',
            ],
            'OldPassword' => 'required|string',
            'ConfirmPassword' => 'required|string|same:NewPassword',
        ]);

        if (!Hash::check($request->OldPassword, $user->password)) {
            throw ValidationException::withMessages(['OldPassword' => ['Kata sandi lama tidak sesuai.']]);
        }

        $user->password = Hash::make($request->NewPassword);
        $user->save();

        return response()->json([
            'message' => '✅ Kata sandi berhasil diubah.',
        ]);
    }

    public function updateBalance()
    {
        $user = Auth::user();
        $member = $user->member;
        $userCode = $member->ext_code;

        $credential = ProviderCredential::first();

        if (!$credential) {
            return response()->json([
                'status' => 0,
                'message' => '⚠️ Credential provider belum dikonfigurasi.',
            ], 500);
        }

        $response = Http::post('https://api.telo.is/api/v2/info', [
            'agent_code' => $credential->agent_code,
            'agent_token' => $credential->agent_token,
            'user_code' => $userCode,
        ]);

        if ($response->failed()) {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal memanggil API provider.',
            ], 500);
        }

        $data = $response->json();

        if (isset($data['status']) && $data['status'] == 1) {
            $userList = $data['user_list'] ?? [];
            foreach ($userList as $userData) {
                if ($userData['user_code'] === $userCode) {
                    $member->balance = $userData['user_balance'];
                    $member->save();

                    return response()->json([
                        'status' => 1,
                        'balance' => $userData['user_balance'],
                        'message' => 'Balance berhasil diupdate dari provider.',
                    ]);
                }
            }

            return response()->json([
                'status' => 0,
                'message' => 'User code tidak ditemukan di API provider.',
            ], 404);
        }

        return response()->json([
            'status' => 0,
            'message' => $data['msg'] ?? 'Gagal update balance dari provider.',
        ], 400);
    }
}
