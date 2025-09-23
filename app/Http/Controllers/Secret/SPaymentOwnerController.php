<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentOwner;
use App\Models\PaymentChannel;
use Illuminate\Support\Facades\Storage;

class SPaymentOwnerController extends Controller
{
    public function index()
    {
        $owners = PaymentOwner::with('channel')->latest()->get();
        $channels = PaymentChannel::pluck('name', 'id');
        return view('secret.payment_owners.index', compact('owners', 'channels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_channel_id' => 'required|exists:payment_channels,id',
            'account_name'       => 'required|string|max:24',
            'account_number'     => 'required|string|max:100',
            'qris_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
        ]);

        try {
            $data = [
                'payment_channel_id' => $request->payment_channel_id,
                'account_name'       => $request->account_name,
                'account_number'     => $request->account_number,
                'is_active'          => $request->has('is_active'),
            ];

            // handle QRIS upload
            if ($request->hasFile('qris_image')) {
                $path = $request->file('qris_image')->store('qris', 'public');
                $data['qris_image'] = $path;
            }

            PaymentOwner::create($data);

            return redirect()->route('secret.payment_owners.index')
                ->with('success', 'Owner berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan owner: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'payment_channel_id' => 'required|exists:payment_channels,id',
            'account_name'       => 'required|string|max:24',
            'account_number'     => 'required|string|max:100',
            'qris_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $owner = PaymentOwner::findOrFail($id);

            $data = [
                'payment_channel_id' => $request->payment_channel_id,
                'account_name'       => $request->account_name,
                'account_number'     => $request->account_number,
                'is_active'          => $request->has('is_active'),
            ];

            // handle QRIS upload
            if ($request->hasFile('qris_image')) {
                // hapus file lama jika ada
                if ($owner->qris_image && Storage::disk('public')->exists($owner->qris_image)) {
                    Storage::disk('public')->delete($owner->qris_image);
                }
                $path = $request->file('qris_image')->store('qris', 'public');
                $data['qris_image'] = $path;
            }

            $owner->update($data);

            return redirect()->route('secret.payment_owners.index')
                ->with('success', 'Owner berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui owner: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $owner = PaymentOwner::findOrFail($id);

            if ($owner->qris_image && Storage::disk('public')->exists($owner->qris_image)) {
                Storage::disk('public')->delete($owner->qris_image);
            }

            $owner->delete();

            return redirect()->route('secret.payment_owners.index')
                ->with('success', 'Owner berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus owner: ' . $e->getMessage());
        }
    }
}
