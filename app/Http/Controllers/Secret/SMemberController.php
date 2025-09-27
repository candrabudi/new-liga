<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SMemberController extends Controller
{
    public function index()
    {
        return view('secret.members.index');
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Member::with(['user', 'paymentChannel']);

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%");
            });
        }

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $members = $query->latest()->paginate(10);

        return response()->json($members);
    }

    public function show($id)
    {
        $member = Member::with('user', 'paymentChannel')->findOrFail($id);

        return response()->json($member);
    }

    public function update(Request $request, $id)
    {
        $member = Member::with('user')->findOrFail($id);

        $request->validate([
            'full_name' => 'required|string',
            'username' => 'required|string|unique:users,username,'.$member->user->id,
            'email' => 'required|email|unique:users,email,'.$member->user->id,
            'phone_number' => 'required|unique:users,phone_number,'.$member->user->id,
            'role' => 'required|in:admin,player',
            'is_active' => 'required|boolean',
            'password' => 'nullable|string|min:6',
        ]);

        $member->user->update([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $member->user->password,
            'is_active' => $request->is_active,
        ]);

        $member->update([
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
        ]);

        return response()->json(['message' => 'Member berhasil diupdate']);
    }
}
