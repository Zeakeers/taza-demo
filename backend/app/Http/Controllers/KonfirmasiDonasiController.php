<?php

namespace App\Http\Controllers;

use App\Models\KonfirmasiDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KonfirmasiDonasiController extends Controller
{
    // API: Store new donation confirmation from frontend
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'tanggal_transfer' => 'required|date',
            'program' => 'required|string|max:255',
            'nominal' => 'required|numeric|max:9999999999999',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // max 5MB
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('konfirmasi_donasi', 'public');
            $validated['bukti_pembayaran'] = $path;
        }

        $donasi = KonfirmasiDonasi::create($validated);

        return response()->json([
            'message' => 'Konfirmasi donasi berhasil dikirim',
            'data' => $donasi
        ], 201);
    }

    // Admin: List all donasi
    public function index()
    {
        $donasis = KonfirmasiDonasi::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.konfirmasi_donasi.index', compact('donasis'));
    }

    // Admin: Show details
    public function show(KonfirmasiDonasi $konfirmasiDonasi)
    {
        return view('admin.konfirmasi_donasi.show', compact('konfirmasiDonasi'));
    }

    // Admin: Edit view
    public function edit(KonfirmasiDonasi $konfirmasiDonasi)
    {
        return view('admin.konfirmasi_donasi.edit', compact('konfirmasiDonasi'));
    }

    // Admin: Update data
    public function update(Request $request, KonfirmasiDonasi $konfirmasiDonasi)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'tanggal_transfer' => 'required|date',
            'program' => 'required|string|max:255',
            'nominal' => 'required|numeric|max:9999999999999',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'status' => 'required|in:pending,acc,tolak',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            // Delete old file if exists
            if ($konfirmasiDonasi->bukti_pembayaran) {
                Storage::disk('public')->delete($konfirmasiDonasi->bukti_pembayaran);
            }
            $path = $request->file('bukti_pembayaran')->store('konfirmasi_donasi', 'public');
            $validated['bukti_pembayaran'] = $path;
        }

        $konfirmasiDonasi->update($validated);

        return redirect()->route('admin.konfirmasi-donasi.index')->with('success', 'Data konfirmasi donasi berhasil diperbarui.');
    }

    // Admin: Delete data
    public function destroy(KonfirmasiDonasi $konfirmasiDonasi)
    {
        if ($konfirmasiDonasi->bukti_pembayaran) {
            Storage::disk('public')->delete($konfirmasiDonasi->bukti_pembayaran);
        }
        
        $konfirmasiDonasi->delete();
        
        return redirect()->route('admin.konfirmasi-donasi.index')->with('success', 'Data konfirmasi donasi berhasil dihapus.');
    }

    // Admin: Update status quickly (Acc/Tolak)
    public function updateStatus(Request $request, KonfirmasiDonasi $konfirmasiDonasi)
    {
        $request->validate([
            'status' => 'required|in:acc,tolak'
        ]);

        $konfirmasiDonasi->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status permohonan berhasil diubah menjadi ' . ($request->status == 'acc' ? 'Diterima' : 'Ditolak') . '.');
    }
}
