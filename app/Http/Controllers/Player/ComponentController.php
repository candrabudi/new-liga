<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function providers()
    {
        return view('mobile.components.providers');
    }
}
