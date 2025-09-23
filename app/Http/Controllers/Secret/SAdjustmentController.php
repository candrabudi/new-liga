<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SAdjustmentController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->get();
        return view('secret.adjustments.index', compact('members'));
    }

    public function store(Request $request)
    {
        // Validasi manual
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:members,id',
            'trx_type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:1',
            'reason' => 'nullable|string|max:255',
        ], [
            'user_id.required' => 'Member harus dipilih.',
            'user_id.exists' => 'Member tidak ditemukan.',
            'trx_type.required' => 'Tipe transaksi harus dipilih.',
            'trx_type.in' => 'Tipe transaksi tidak valid.',
            'amount.required' => 'Jumlah harus diisi.',
            'amount.numeric' => 'Jumlah harus berupa angka.',
            'amount.min' => 'Jumlah minimal 1.',
            'reason.max' => 'Alasan maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member = Member::where('id', $request->user_id)->first();
        $amount = $request->amount;

        if ($request->trx_type === 'debit') {
            $amount = -abs($amount);
            if ($member->balance + $amount < 0) {
                return back()->with('error', 'Saldo tidak mencukupi.')->withInput();
            }
        }

        try {
            DB::beginTransaction();

            // Update saldo member
            $member->balance += $amount;
            $member->save();

            // Simpan transaksi adjustment
            Transaction::create([
                'user_id' => $member->user_id,
                'type' => 'adjustment',
                'trx_type' => $request->trx_type,
                'amount' => $request->amount,
                'status' => 'approved',
                'reason' => $request->reason ?? null,
                'updated_by' => Auth::id(),
            ]);

            DB::commit();

            return back()->with('success', 'Adjustment berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function list(Request $request)
    {
        $query = Transaction::with('user')->where('type', 'adjustment');

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%');
            })->orWhere('reason', 'like', '%' . $request->search . '%');
        }

        if ($request->trx_type) {
            $query->where('trx_type', $request->trx_type);
        }

        $transactions = $query->orderBy('id', 'desc')->paginate(10);

        return response()->json($transactions);
    }
}
