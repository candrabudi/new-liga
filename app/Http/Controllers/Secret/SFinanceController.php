<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use App\Models\FinanceSetting;
use App\Models\ReferralCommissionSetting;
use Illuminate\Http\Request;

class SFinanceController extends Controller
{
    public function index()
    {
        $setting = FinanceSetting::first(); // hanya satu row
        $referralSetting = ReferralCommissionSetting::first(); // hanya satu row juga

        return view('secret.finance.index', compact('setting', 'referralSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_deposit' => 'required|numeric|min:0',
            'max_deposit' => 'nullable|numeric|min:0',
            'min_withdraw' => 'required|numeric|min:0',
            'max_withdraw' => 'nullable|numeric|min:0',
        ]);

        $setting = FinanceSetting::first() ?? new FinanceSetting();
        $setting->min_deposit = $request->min_deposit;
        $setting->max_deposit = $request->max_deposit ?? 0;
        $setting->min_withdraw = $request->min_withdraw;
        $setting->max_withdraw = $request->max_withdraw ?? 0;
        $setting->save();

        return redirect()->route('secret.finance.index')->with('success', 'Pengaturan keuangan berhasil diperbarui.');
    }

    public function updateReferralSetting(Request $request)
    {
        $request->validate([
            'percentage' => 'required|numeric|min:0',
            'min_deposit' => 'required|numeric|min:0',
            'max_commission' => 'nullable|numeric|min:0',
        ]);

        ReferralCommissionSetting::updateOrCreate(
            ['id' => 1], // hanya 1 setting global
            [
                'percentage' => $request->percentage,
                'min_deposit' => $request->min_deposit,
                'max_commission' => $request->max_commission ?? 0,
                'is_active' => $request->has('is_active'),
            ]
        );

        return back()->with('success_referral', 'Pengaturan komisi referral berhasil diperbarui!');
    }
}
