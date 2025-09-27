<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\ProviderCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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
