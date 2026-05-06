<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PermohonanBantuan;
use Illuminate\Support\Facades\Storage;

class PermohonanBantuanController extends Controller
{
    // API Route untuk Next.js
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'alamat_domisili' => 'required|string',
            'no_whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'jenis_pemohon' => 'nullable|string',
            'sumber_info' => 'nullable|string',
            'referensi' => 'nullable|string',
            'pernah_mengajukan' => 'nullable|string',
            'waktu_terakhir_mengajukan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'nominal' => 'nullable|numeric|max:9999999999999',
            'foto_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // max 5MB
        ]);

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('permohonan_bantuan', 'public');
            $validated['foto_ktp'] = $path;
        }

        $permohonan = PermohonanBantuan::create($validated);

        return response()->json([
            'message' => 'Permohonan bantuan berhasil dikirim',
            'data' => $permohonan
        ], 201);
    }

    // Admin Routes
    public function index()
    {
        $permohonans = PermohonanBantuan::latest()->get();
        return view('admin.permohonan_bantuan.index', compact('permohonans'));
    }

    public function show(PermohonanBantuan $permohonanBantuan)
    {
        return view('admin.permohonan_bantuan.show', compact('permohonanBantuan'));
    }

    public function edit(PermohonanBantuan $permohonanBantuan)
    {
        return view('admin.permohonan_bantuan.edit', compact('permohonanBantuan'));
    }

    public function update(Request $request, PermohonanBantuan $permohonanBantuan)
    {
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'alamat_domisili' => 'required|string',
            'no_whatsapp' => 'required|string|max:20',
            'email' => 'nullable|email',
            'jenis_pemohon' => 'nullable|string',
            'sumber_info' => 'nullable|string',
            'referensi' => 'nullable|string',
            'pernah_mengajukan' => 'nullable|string',
            'waktu_terakhir_mengajukan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'nominal' => 'nullable|numeric|max:9999999999999',
            'foto_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'status' => 'required|in:pending,acc,tolak',
        ]);

        if ($request->hasFile('foto_ktp')) {
            if ($permohonanBantuan->foto_ktp) {
                Storage::disk('public')->delete($permohonanBantuan->foto_ktp);
            }
            $path = $request->file('foto_ktp')->store('permohonan_bantuan', 'public');
            $validated['foto_ktp'] = $path;
        }

        $permohonanBantuan->update($validated);

        return redirect()->route('admin.permohonan-bantuan.index')->with('success', 'Data permohonan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, PermohonanBantuan $permohonanBantuan)
    {
        $request->validate(['status' => 'required|in:pending,acc,tolak']);
        $permohonanBantuan->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

    public function destroy(PermohonanBantuan $permohonanBantuan)
    {
        if ($permohonanBantuan->foto_ktp) {
            Storage::disk('public')->delete($permohonanBantuan->foto_ktp);
        }
        $permohonanBantuan->delete();

        return redirect()->route('admin.permohonan-bantuan.index')->with('success', 'Data permohonan berhasil dihapus.');
    }
}
