<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

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
}
