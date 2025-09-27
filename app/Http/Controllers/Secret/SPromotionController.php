<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SPromotionController extends Controller
{
    // Halaman utama list promotion
    public function index()
    {
        return view('secret.promotions.index');
    }

    // Load list promotion via AJAX
    public function list(Request $request)
    {
        $query = Promotion::query();

        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $promotions = $query->orderBy('id', 'desc')->paginate(10);

        return response()->json($promotions);
    }

    // Form tambah promotion
    public function create()
    {
        return view('secret.promotions.form');
    }

    // Simpan promotion baru
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'thumb' => 'nullable|image|max:2048',
                'status' => 'required|in:active,inactive',
                'start_date' => 'nullable|date|required_if:is_lifetime,0',
                'end_date' => 'nullable|date|after_or_equal:start_date|required_if:is_lifetime,0',
                'is_lifetime' => 'nullable|boolean',
            ]);

            $thumbPath = null;
            if ($request->hasFile('thumb')) {
                $thumbPath = $request->file('thumb')->store('promotions', 'public');
            }

            Promotion::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'thumb' => $thumbPath,
                'status' => $request->status,
                'start_date' => $request->is_lifetime ? null : $request->start_date,
                'end_date' => $request->is_lifetime ? null : $request->end_date,
                'is_lifetime' => $request->is_lifetime ? true : false,
            ]);

            DB::commit();

            return redirect()->route('secret.promotions.index')->with('success', 'Promotion berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Form edit promotion
    public function edit(Promotion $promotion)
    {
        return view('secret.promotions.form', compact('promotion'));
    }

    // Update promotion
    public function update(Request $request, Promotion $promotion)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'thumb' => 'nullable|image|max:2048',
                'status' => 'required|in:active,inactive',
                'start_date' => 'nullable|date|required_if:is_lifetime,0',
                'end_date' => 'nullable|date|after_or_equal:start_date|required_if:is_lifetime,0',
                'is_lifetime' => 'nullable|boolean',
            ]);

            if ($request->hasFile('thumb')) {
                if ($promotion->thumb) {
                    Storage::disk('public')->delete($promotion->thumb);
                }
                $promotion->thumb = $request->file('thumb')->store('promotions', 'public');
            }

            $promotion->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'status' => $request->status,
                'start_date' => $request->is_lifetime ? null : $request->start_date,
                'end_date' => $request->is_lifetime ? null : $request->end_date,
                'is_lifetime' => $request->is_lifetime ? true : false,
            ]);

            DB::commit();

            return redirect()->route('secret.promotions.index')->with('success', 'Promotion berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    // Hapus promotion
    public function destroy(Promotion $promotion)
    {
        if ($promotion->thumb) {
            Storage::disk('public')->delete($promotion->thumb);
        }
        $promotion->delete();

        return back()->with('success', 'Promotion berhasil dihapus.');
    }
}
