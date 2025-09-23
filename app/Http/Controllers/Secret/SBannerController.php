<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class SBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('secret.banner.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image|max:2048',
        ]);

        $path = $request->file('image_path')->store('banners', 'public');

        $banner = Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image_path' => asset('/storage/' . $path),
        ]);

        return response()->json(['message' => 'Banner berhasil ditambahkan', 'data' => $banner]);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $banner->image_path));
            }
            $path = $request->file('image_path')->store('banners', 'public');
            $banner->image_path = asset('/storage/' . $path);
        }

        $banner->update($request->only(['title', 'description', 'link']));

        return response()->json(['message' => 'Banner berhasil diupdate', 'data' => $banner]);
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image_path) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $banner->image_path));
        }
        $banner->delete();

        return response()->json(['message' => 'Banner berhasil dihapus']);
    }
}
