<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {

        $website = Website::first();
        $banners = Banner::all();
        return view('mobile.home.index', compact('banners', 'website'));
    }
}
