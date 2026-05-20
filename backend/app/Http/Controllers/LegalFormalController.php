<?php

namespace App\Http\Controllers;

use App\Models\LegalFormal;
use Illuminate\Http\Request;

class LegalFormalController extends Controller
{
    public function index()
    {
        $items = LegalFormal::all();
        return view('admin.tata-kelola.legal-formal.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tata-kelola.legal-formal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'elements' => 'nullable|json',
        ]);

        $data = $request->all();
        if (isset($data['elements'])) {
            $data['elements'] = json_decode($data['elements'], true);
        }

        LegalFormal::create($data);

        return redirect()->route('admin.tata-kelola.legal-formal.index')->with('success', 'Legal Formal item created successfully.');
    }

    public function edit(LegalFormal $legalFormal)
    {
        return view('admin.tata-kelola.legal-formal.edit', compact('legalFormal'));
    }

    public function update(Request $request, LegalFormal $legalFormal)
    {
        $request->validate([
            'title' => 'nullable',
            'elements' => 'nullable|json',
        ]);

        $data = $request->all();
        if (isset($data['elements'])) {
            $data['elements'] = json_decode($data['elements'], true);
        }

        $legalFormal->update($data);

        return redirect()->route('admin.tata-kelola.legal-formal.index')->with('success', 'Legal Formal item updated successfully.');
    }

    public function destroy(LegalFormal $legalFormal)
    {
        $legalFormal->delete();

        return redirect()->route('admin.tata-kelola.legal-formal.index')->with('success', 'Legal Formal item deleted successfully.');
    }

    public function apiIndex()
    {
        return response()->json(LegalFormal::all());
    }
}
