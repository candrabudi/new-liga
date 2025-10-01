<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\KycDocument;
use Illuminate\Http\Request;

class SKycController extends Controller
{
    /**
     * Tampilkan halaman blade daftar KYC.
     */
    public function view()
    {
        return view('secret.kyc.index');
    }

    /**
     * Ambil data KYC (JSON untuk datatable/axios).
     */
    public function index(Request $request)
    {
        $query = KycDocument::with('profile');

        if ($request->search) {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('full_name', 'like', "%{$request->search}%")
                  ->orWhere('contact_no', 'like', "%{$request->search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $kyc = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($kyc);
    }

    /**
     * Approve / Reject request KYC.
     */
    public function review(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'nullable|string',
        ]);

        $kyc = KycDocument::findOrFail($id);

        $kyc->status = $request->status;
        $kyc->rejection_reason = $request->status === 'rejected'
            ? $request->rejection_reason
            : null;

        $kyc->save();

        return response()->json([
            'success' => true,
            'message' => 'KYC berhasil diperbarui',
            'data' => $kyc,
        ]);
    }
}
