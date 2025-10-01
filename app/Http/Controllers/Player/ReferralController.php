<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    public function index()
    {
        return view('mobile.referral.guidance');
    }

    public function signupsSummary()
    {
        return view('mobile.referral.signups_summary');
    }
}
