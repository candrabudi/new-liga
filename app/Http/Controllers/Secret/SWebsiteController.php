<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SWebsiteController extends Controller
{
    public function index()
    {
        $website = Website::first();

        return view('secret.website.index', compact('website'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|string|max:255',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'website_description' => 'nullable|string|max:5000',
            'website_maintenance' => 'nullable|boolean',
            'link_livechat' => 'nullable|string',
            'link_telegram' => 'nullable|string|max:255',
        ], [
            'website_name.required' => 'Nama website wajib diisi.',
            'website_name.string' => 'Nama website harus berupa teks.',
            'website_name.max' => 'Nama website maksimal 255 karakter.',
            'website_logo.image' => 'Logo harus berupa gambar.',
            'website_logo.mimes' => 'Logo hanya boleh berupa: jpeg, png, jpg, gif, svg.',
            'website_logo.max' => 'Ukuran logo maksimal 2MB.',
            'website_favicon.image' => 'Favicon harus berupa gambar.',
            'website_favicon.mimes' => 'Favicon hanya boleh berupa: ico, png.',
            'website_favicon.max' => 'Ukuran favicon maksimal 1MB.',
            'website_description.string' => 'Deskripsi website harus berupa teks.',
            'website_description.max' => 'Deskripsi maksimal 5000 karakter.',
            'website_maintenance.boolean' => 'Mode maintenance harus berupa true/false.',
            'link_livechat.string' => 'Live chat script harus berupa teks.',
            'link_telegram.string' => 'Link Telegram harus berupa teks.',
            'link_telegram.max' => 'Link Telegram maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $website = Website::first() ?? new Website();

        if ($request->hasFile('website_logo')) {
            $path = $request->file('website_logo')->store('logos', 'public');
            $website->website_logo = Storage::url($path);
        }

        if ($request->hasFile('website_favicon')) {
            $path = $request->file('website_favicon')->store('favicon', 'public');
            $website->website_favicon = Storage::url($path);
        }

        $website->website_name = $request->website_name;
        $website->website_description = $request->website_description;
        $website->website_maintenance = $request->website_maintenance ?? 0;
        $website->link_livechat = $request->link_livechat;
        $website->link_telegram = $request->link_telegram;
        $website->save();

        return response()->json([
            'message' => 'Pengaturan website berhasil disimpan!',
            'logo_url' => $website->website_logo ?? null,
            'favicon_url' => $website->website_favicon ?? null,
        ]);
    }
}
