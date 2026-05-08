<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    // API Route untuk Next.js
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'kontribusi' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $volunteer = Volunteer::create($validated);

        return response()->json([
            'message' => 'Pendaftaran volunteer berhasil dikirim',
            'data' => $volunteer
        ], 201);
    }

    // Admin Routes
    public function index()
    {
        $volunteers = Volunteer::latest()->get();
        return view('admin.volunteer.index', compact('volunteers'));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteer.show', compact('volunteer'));
    }

    public function edit(Volunteer $volunteer)
    {
        return view('admin.volunteer.edit', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'kontribusi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $volunteer->update($validated);

        return redirect()->route('admin.volunteer.index')->with('success', 'Data volunteer berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Volunteer $volunteer)
    {
        $request->validate(['status' => 'required|in:pending,diterima,ditolak']);
        $volunteer->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin.volunteer.index')->with('success', 'Data volunteer berhasil dihapus.');
    }
}
