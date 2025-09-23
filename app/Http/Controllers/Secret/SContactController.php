<?php

namespace App\Http\Controllers\Secret;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class SContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('secret.contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:50',
            'name'     => 'nullable|string|max:100',
            'link'     => 'nullable|url',
            'icon'     => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $contact = Contact::create($validated);

        return response()->json([
            'message' => 'Kontak berhasil ditambahkan',
            'data' => $contact
        ]);
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:50',
            'name'     => 'nullable|string|max:100',
            'link'     => 'nullable|url',
            'icon'     => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $contact->update($validated);

        return response()->json([
            'message' => 'Kontak berhasil diperbarui',
            'data' => $contact
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json([
            'message' => 'Kontak berhasil dihapus'
        ]);
    }
}
