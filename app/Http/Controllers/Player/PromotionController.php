<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Promotion; // pastikan model Promotion sudah dibuat

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::where('status', 'active')
            ->orderByDesc('start_date')
            ->get();

        return view('mobile.promotions.index', compact('promotions'));
    }

    public function show($slug)
    {
        $promotion = Promotion::where('slug', $slug)->firstOrFail();

        return view('mobile.promotions.show', compact('promotion'));
    }
}
