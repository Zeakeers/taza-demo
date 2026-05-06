@extends('layouts.admin')

@section('header', 'Edit Permohonan Bantuan')

@section('content')
<div class="mb-6 flex items-center gap-4">
    <a href="{{ route('admin.permohonan-bantuan.index') }}" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 hover:text-primary transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">Edit Permohonan</h2>
        <p class="text-gray-500 text-sm mt-1">Ubah data permohonan bantuan secara manual.</p>
    </div>
</div>

<div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm max-w-4xl">
    <form action="{{ route('admin.permohonan-bantuan.update', $permohonanBantuan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon <span class="text-red-500">*</span></label>
                <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon', $permohonanBantuan->nama_pemohon) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('nama_pemohon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">No WhatsApp <span class="text-red-500">*</span></label>
                <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp', $permohonanBantuan->no_whatsapp) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('no_whatsapp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $permohonanBantuan->email) }}" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pemohon</label>
                <input type="text" name="jenis_pemohon" value="{{ old('jenis_pemohon', $permohonanBantuan->jenis_pemohon) }}" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Domisili <span class="text-red-500">*</span></label>
                <input type="text" name="alamat_domisili" value="{{ old('alamat_domisili', $permohonanBantuan->alamat_domisili) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi / Alasan Permohonan</label>
                <textarea name="deskripsi" rows="3" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none">{{ old('deskripsi', $permohonanBantuan->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Diajukan</label>
                <input type="number" name="nominal" value="{{ old('nominal', $permohonanBantuan->nominal) }}" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                    <option value="pending" {{ old('status', $permohonanBantuan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="acc" {{ old('status', $permohonanBantuan->status) == 'acc' ? 'selected' : '' }}>Diterima (Acc)</option>
                    <option value="tolak" {{ old('status', $permohonanBantuan->status) == 'tolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload KTP Baru (Abaikan jika tidak ingin mengubah)</label>
                <input type="file" name="foto_ktp" accept="image/*,.pdf" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
            </div>
            
            <!-- Hidden inputs to preserve other fields not normally edited but required by validation, or we can just make them editble -->
            <div class="hidden">
                <input type="hidden" name="sumber_info" value="{{ $permohonanBantuan->sumber_info }}">
                <input type="hidden" name="referensi" value="{{ $permohonanBantuan->referensi }}">
                <input type="hidden" name="pernah_mengajukan" value="{{ $permohonanBantuan->pernah_mengajukan }}">
                <input type="hidden" name="waktu_terakhir_mengajukan" value="{{ $permohonanBantuan->waktu_terakhir_mengajukan }}">
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-primary hover:bg-green-600 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg shadow-primary/30">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
