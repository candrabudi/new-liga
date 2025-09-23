<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinanceSetting;

class SFinanceController extends Controller
{
    public function index()
    {
        $setting = FinanceSetting::first(); // hanya satu row
        return view('secret.finance.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_deposit'   => 'required|numeric|min:0',
            'max_deposit'   => 'nullable|numeric|min:0',
            'min_withdraw'  => 'required|numeric|min:0',
            'max_withdraw'  => 'nullable|numeric|min:0',
        ]);

        $setting = FinanceSetting::first() ?? new FinanceSetting();
        $setting->min_deposit   = $request->min_deposit;
        $setting->max_deposit   = $request->max_deposit ?? 0;
        $setting->min_withdraw  = $request->min_withdraw;
        $setting->max_withdraw  = $request->max_withdraw ?? 0;
        $setting->save();

        return redirect()->route('secret.finance.index')->with('success', 'Pengaturan keuangan berhasil diperbarui.');
    }
}
