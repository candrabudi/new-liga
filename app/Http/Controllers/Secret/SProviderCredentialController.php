<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderCredential;
use Illuminate\Support\Facades\Validator;

class SProviderCredentialController extends Controller
{
    public function index()
    {
        $credential = ProviderCredential::first();
        return view('secret.provider_credentials.index', compact('credential'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:255',
            'agent_code' => 'required|string|max:100',
            'agent_token' => 'required|string|max:255',
        ], [
            'url.required' => 'URL wajib diisi.',
            'url.url' => 'URL tidak valid.',
            'agent_code.required' => 'Agent code wajib diisi.',
            'agent_token.required' => 'Agent token wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credential = ProviderCredential::first() ?? new ProviderCredential();

        $credential->url = $request->url;
        $credential->agent_code = $request->agent_code;
        $credential->agent_token = $request->agent_token;

        $credential->save();

        return response()->json(['message' => 'Provider credentials berhasil disimpan!']);
    }
}
