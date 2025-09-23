<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SProfileController extends Controller
{
    // Tampilkan halaman profile
    public function index()
    {
        $user = Auth::user();
        return view('secret.profile.index', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|unique:users,phone_number,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}
