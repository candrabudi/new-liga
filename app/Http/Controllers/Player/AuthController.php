<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PaymentChannel;
use App\Models\ProviderCredential;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return redirect()->guest('/?login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'Username' => 'required|string|min:3|max:50',
            'Password' => 'required|string|min:6|max:50',
        ], [
            'Username.required' => 'Nama pengguna wajib diisi.',
            'Password.required' => 'Kata sandi wajib diisi.',
        ]);

        $user = User::where('username', strtolower($credentials['Username']))->first();

        if (!$user || !Hash::check($credentials['Password'], $user->password)) {
            return response()->json([
                'status' => false,
                'code' => 401,
                'message' => 'Nama pengguna atau kata sandi salah.',
            ], 401);
        }

        Auth::login($user);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Login berhasil.',
            'redirect' => route('mobile.register.done'), // bisa custom redirect tujuan
        ], 200);
    }

    public function register()
    {
        $paymentChannels = PaymentChannel::all();

        return view('mobile.auth.register', compact('paymentChannels'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function registerProcess(Request $request)
    {
        try {
            $validated = $request->validate([
                'UserName' => 'required|string|min:3|max:12|unique:users,username|regex:/^[0-9a-zA-Z]+$/',
                'Password' => 'required|string|min:8|max:20',
                'FullName' => 'required|string|max:100',
                'Email' => 'nullable|email|max:100|unique:users,email',
                'WhatsApp' => 'nullable|string|max:16|regex:/^[0-9\-]+$/',
                'ReferrerCode' => 'nullable|string|max:50',
                'SelectedBank' => 'nullable|exists:payment_channels,id',
                'BankAccountNumber' => 'nullable|string|max:24|regex:/^[0-9\-]+$/',
                'BankAccountName' => 'nullable|string|max:100',
            ], [
                'UserName.regex' => 'Nama pengguna hanya boleh berisi huruf dan angka tanpa spasi.',
                'WhatsApp.regex' => 'Nomor WhatsApp hanya boleh angka.',
                'BankAccountNumber.regex' => 'Nomor rekening hanya boleh angka.',
            ]);

            // Simpan user
            $user = new User();
            $user->username = strtolower($validated['UserName']);
            $user->password = Hash::make($validated['Password']);
            $user->email = $validated['Email'] ?? null;
            $user->role = 'player';
            $user->full_name = $validated['FullName'];
            $user->phone_number = $validated['WhatsApp'] ?? null;
            $user->save();

            // Simpan member
            $member = new Member();
            $member->user_id = $user->id;
            $member->ext_code = 'jktbet'.$user->username;
            $member->referrer_code = $validated['ReferrerCode'] ?? null;
            $member->payment_channel_id = $validated['SelectedBank'] ?? null;
            $member->account_number = $validated['BankAccountNumber'] ?? null;
            $member->account_name = $validated['BankAccountName'] ?? null;
            $member->save();

            // === Tambahkan proses create user di provider (Telo API) ===
            $credential = ProviderCredential::first(); // ambil dari DB

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->post('https://api.telo.is/api/v2/user_create', [
                'agent_code' => $credential->agent_code,
                'agent_token' => $credential->agent_token,
                'user_code' => $member->ext_code,
                'deposit_amount' => 0,
            ]);

            $apiData = $response->json();

            if (!$response->successful() || $apiData['status'] != 1) {
                // kalau gagal create user di provider, rollback lokal
                $user->delete();
                $member->delete();

                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => 'Gagal membuat user di provider: '.($apiData['msg'] ?? 'Unknown error'),
                ], 500);
            }

            // kalau sukses login otomatis
            Auth::login($user);

            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => 'Registrasi berhasil & user berhasil dibuat di provider',
                'data' => [
                    'user' => $user,
                    'member' => $member,
                    'provider' => $apiData,
                ],
            ], 201);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('status', false)
                ->with('message', 'Validasi gagal, silakan periksa kembali data Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('status', false)
                ->with('message', 'Terjadi kesalahan pada server: '.$e->getMessage());
        }
    }

    public function registerDone()
    {
        $website = Website::first();

        return view('mobile.auth.register-done', compact('website'));
    }
}
