<?php

namespace App\Http\Controllers;

use App\Models\AuditIso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuditIsoController extends Controller
{
    public function index()
    {
        $items = AuditIso::all();
        return view('admin.tata-kelola.audit-iso.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tata-kelola.audit-iso.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'link_text' => 'nullable',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except(['file']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('audit_isos', 'nextjs_public');
            $data['file'] = Storage::disk('nextjs_public')->url($path);
        }

        AuditIso::create($data);

        return redirect()->route('admin.tata-kelola.audit-iso.index')->with('success', 'Audit ISO section created successfully.');
    }

    public function edit(AuditIso $auditIso)
    {
        return view('admin.tata-kelola.audit-iso.edit', compact('auditIso'));
    }

    public function update(Request $request, AuditIso $auditIso)
    {
        $request->validate([
            'description' => 'required',
            'link_text' => 'nullable',
            'file' => 'nullable|mimes:pdf|max:10000',
        ]);

        $data = $request->except(['file']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('audit_isos', 'nextjs_public');
            $data['file'] = Storage::disk('nextjs_public')->url($path);
        } elseif ($request->has('remove_file')) {
            $data['file'] = null;
        }

        $auditIso->update($data);

        return redirect()->route('admin.tata-kelola.audit-iso.index')->with('success', 'Audit ISO section updated successfully.');
    }

    public function destroy(AuditIso $auditIso)
    {
        $auditIso->delete();

        return redirect()->route('admin.tata-kelola.audit-iso.index')->with('success', 'Audit ISO section deleted successfully.');
    }

    public function apiIndex()
    {
        $isos = AuditIso::all()->map(function($iso) {
            $iso->file_url = $iso->file; // already a valid URL from nextjs_public
            return $iso;
        });
        return response()->json($isos);
    }
}
