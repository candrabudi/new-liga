<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\PaymentChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SChannelController extends Controller
{
    public function index()
    {
        return view('secret.channel.index');
    }

    public function list(Request $request)
    {
        $query = PaymentChannel::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->status === 'active' || $request->status === '1') {
            $query->where('is_active', true);
        }

        if ($request->status === 'inactive' || $request->status === '0') {
            $query->where('is_active', false);
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:bank,ewallet,pulsa,qris',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:20|unique:payment_channels,code',
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['type', 'name', 'slug', 'code']);
        $data['slug'] = $request->slug ?? Str::slug($request->name);
        $data['code'] = $request->code ?? Str::upper(Str::random(6));
        $data['is_active'] = $request->is_active ?? true;

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('channels', 'public');
        }

        $channel = PaymentChannel::create($data);

        return response()->json([
            'message' => 'Payment channel berhasil dibuat.',
            'channel' => $channel
        ]);
    }

    public function show($id)
    {
        $channel = PaymentChannel::findOrFail($id);
        return response()->json($channel);
    }

    public function update(Request $request, $id)
    {
        $channel = PaymentChannel::findOrFail($id);

        $request->validate([
            'type' => 'required|in:bank,ewallet,pulsa,qris',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:20|unique:payment_channels,code,'.$channel->id,
            'logo' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $channel->type = $request->type;
        $channel->name = $request->name;
        $channel->slug = $request->slug ?? Str::slug($request->name);
        $channel->code = $request->code ?? $channel->code;
        $channel->is_active = $request->is_active ?? true;

        if ($request->hasFile('logo')) {
            $channel->logo = $request->file('logo')->store('channels', 'public');
        }

        $channel->save();

        return response()->json([
            'message' => 'Payment channel berhasil diupdate.',
            'channel' => $channel
        ]);
    }

    public function destroy($id)
    {
        $channel = PaymentChannel::findOrFail($id);
        $channel->delete();

        return response()->json([
            'message' => 'Payment channel berhasil dihapus.'
        ]);
    }
}
