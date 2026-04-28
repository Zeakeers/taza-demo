@extends('layouts.admin')

@section('header', 'Tambah Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 font-medium transition-colors mb-4">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Admin
    </a>
    <h2 class="text-2xl font-bold text-zinc-800">Tambah Akun Admin Baru</h2>
</div>

<div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm max-w-3xl">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 text-sm rounded-xl focus:ring-primary focus:border-primary block p-3.5 transition-all @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: budi@tamanzakat.org" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 text-sm rounded-xl focus:ring-primary focus:border-primary block p-3.5 transition-all @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 text-sm rounded-xl focus:ring-primary focus:border-primary block p-3.5 transition-all @error('password') border-red-500 @enderror" required minlength="8">
                @error('password')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Role Admin</label>
                <select name="role" class="w-full bg-gray-50 border border-gray-200 text-zinc-800 text-sm rounded-xl focus:ring-primary focus:border-primary block p-3.5 transition-all @error('role') border-red-500 @enderror" required>
                    <option value="" disabled selected>Pilih Role...</option>
                    <option value="markom" {{ old('role') == 'markom' ? 'selected' : '' }}>Markom Admin</option>
                    <option value="program" {{ old('role') == 'program' ? 'selected' : '' }}>Program Admin</option>
                    <option value="dev" {{ old('role') == 'dev' ? 'selected' : '' }}>Dev Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
                <p class="text-gray-400 text-xs mt-2 leading-relaxed">
                    <b>Markom Admin:</b> Untuk mengelola konten (beranda, dll). <br>
                    <b>Program Admin:</b> Untuk meninjau data permohonan, donasi, relawan. <br>
                    <b>Dev Admin:</b> Memiliki akses ke sistem admin ini.
                </p>
            </div>
            
            <div class="pt-4">
                <button type="submit" class="w-full bg-primary hover:bg-green-600 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-primary/30 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Simpan Admin Baru
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
