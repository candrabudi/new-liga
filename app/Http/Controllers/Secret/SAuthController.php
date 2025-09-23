<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SAuthController extends Controller
{
    public function login()
    {
        return view('secret.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('username', $credentials['username'])
            ->where('role', 'admin')
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.',
            ], 401);
        }

        if (! $user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Anda tidak aktif.',
            ], 403);
        }

        Auth::login($user, $request->boolean('remember'));

        return response()->json([
            'success'  => true,
            'message'  => 'Selamat datang, Admin!',
            'redirect' => route('secret.dashboard'),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('secret.login')->with('success', 'Anda telah keluar.');
    }
}
