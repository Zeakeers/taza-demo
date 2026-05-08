@extends('layouts.admin')

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('admin.volunteer.index') }}" class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    Edit Data Volunteer
</div>
@endsection

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-zinc-800">Edit Data Volunteer</h2>
    <p class="text-gray-500 text-sm mt-1">Perbarui informasi volunteer jika diperlukan.</p>
</div>

@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl mb-6 font-medium">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.volunteer.update', $volunteer->id) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    @csrf
    @method('PUT')
    
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Informasi Utama
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $volunteer->nama) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">No WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $volunteer->no_hp) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $volunteer->email) }}" required class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Bidang Kontribusi</label>
                    <input type="text" name="kontribusi" value="{{ old('kontribusi', $volunteer->kontribusi) }}" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Motivasi & Keterangan</label>
                    <textarea name="keterangan" rows="4" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none">{{ old('keterangan', $volunteer->keterangan) }}</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="space-y-6">
        <!-- Status & Submit -->
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Status & Simpan
            </h3>
            
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Status Pendaftaran <span class="text-red-500">*</span></label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors {{ old('status', $volunteer->status) == 'pending' ? 'bg-yellow-50 border-yellow-200' : '' }}">
                            <input type="radio" name="status" value="pending" {{ old('status', $volunteer->status) == 'pending' ? 'checked' : '' }} class="w-4 h-4 text-yellow-500 focus:ring-yellow-500">
                            <span class="text-sm font-medium text-zinc-700">Pending</span>
                        </label>
                        
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors {{ old('status', $volunteer->status) == 'diterima' ? 'bg-green-50 border-green-200' : '' }}">
                            <input type="radio" name="status" value="diterima" {{ old('status', $volunteer->status) == 'diterima' ? 'checked' : '' }} class="w-4 h-4 text-green-500 focus:ring-green-500">
                            <span class="text-sm font-medium text-zinc-700">Diterima</span>
                        </label>
                        
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors {{ old('status', $volunteer->status) == 'ditolak' ? 'bg-red-50 border-red-200' : '' }}">
                            <input type="radio" name="status" value="ditolak" {{ old('status', $volunteer->status) == 'ditolak' ? 'checked' : '' }} class="w-4 h-4 text-red-500 focus:ring-red-500">
                            <span class="text-sm font-medium text-zinc-700">Ditolak</span>
                        </label>
                    </div>
                </div>
                
                <hr class="border-gray-100">
                
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.volunteer.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-zinc-600 px-6 py-3 rounded-xl font-bold transition-all text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-primary/30">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
