@extends('layouts.admin')

@section('header', 'Edit Konfirmasi Donasi')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('admin.konfirmasi-donasi.index') }}" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 hover:text-primary transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">Edit Konfirmasi Donasi</h2>
        <p class="text-gray-500 text-sm mt-1">Ubah data konfirmasi donasi.</p>
    </div>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 max-w-4xl">
    <form action="{{ route('admin.konfirmasi-donasi.update', $konfirmasiDonasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $konfirmasiDonasi->nama_lengkap) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('nama_lengkap') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">No WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp', $konfirmasiDonasi->no_whatsapp) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('no_whatsapp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Transfer <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_transfer" value="{{ old('tanggal_transfer', $konfirmasiDonasi->tanggal_transfer) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('tanggal_transfer') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Program <span class="text-red-500">*</span></label>
                <input type="text" name="program" value="{{ old('program', $konfirmasiDonasi->program) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('program') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Donasi <span class="text-red-500">*</span></label>
                <input type="number" name="nominal" value="{{ old('nominal', $konfirmasiDonasi->nominal) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('nominal') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                    <option value="pending" {{ old('status', $konfirmasiDonasi->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="acc" {{ old('status', $konfirmasiDonasi->status) == 'acc' ? 'selected' : '' }}>Terima (Acc)</option>
                    <option value="tolak" {{ old('status', $konfirmasiDonasi->status) == 'tolak' ? 'selected' : '' }}>Tolak</option>
                </select>
                @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Ganti Bukti Transfer (Opsional)</label>
                <input type="file" name="bukti_pembayaran" accept="image/*,.pdf" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah bukti transfer. Format: JPG, JPEG, PNG, PDF. Maks 5MB.</p>
                @error('bukti_pembayaran') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                
                @if($konfirmasiDonasi->bukti_pembayaran)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 mb-2">Bukti Saat Ini:</p>
                    <div class="w-32 h-32 rounded-xl overflow-hidden border border-gray-200">
                        <img src="{{ asset('storage/' . $konfirmasiDonasi->bukti_pembayaran) }}" class="w-full h-full object-cover">
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.konfirmasi-donasi.index') }}" class="px-6 py-3 rounded-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-primary hover:bg-green-600 shadow-lg shadow-primary/30 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
