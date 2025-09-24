<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('mobile.contact.index');
    }
}
