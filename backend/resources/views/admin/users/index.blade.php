@extends('layouts.admin')

@section('header', 'Manajemen Akun Admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">Daftar Admin</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola akses pengguna untuk panel kontrol ini.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="bg-primary hover:bg-green-600 text-white font-bold py-2.5 px-6 rounded-xl transition-all shadow-lg shadow-primary/30 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Admin
    </a>
</div>

@if(session('success'))
<div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-500/10 border border-red-500/20 text-red-600 px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-50">
                    <th class="pb-4 font-bold">Pengguna</th>
                    <th class="pb-4 font-bold">Email</th>
                    <th class="pb-4 font-bold">Role</th>
                    <th class="pb-4 font-bold text-center">Tanggal Dibuat</th>
                    <th class="pb-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($users as $user)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
                    <td class="py-5 font-bold text-zinc-800 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=5DA630&color=fff" class="w-10 h-10 rounded-xl shadow-sm">
                        {{ $user->name }}
                    </td>
                    <td class="py-5 text-gray-500">{{ $user->email }}</td>
                    <td class="py-5">
                        @if($user->role == 'dev')
                            <span class="bg-black text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Dev</span>
                        @elseif($user->role == 'markom')
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Markom</span>
                        @elseif($user->role == 'program')
                            <span class="bg-secondary/20 text-secondary px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Program</span>
                        @endif
                    </td>
                    <td class="py-5 text-gray-400 text-center">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="py-5 text-right space-x-2 flex justify-end gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-blue-500 hover:bg-blue-50 transition-all" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        @if(auth()->id() !== $user->id)
                        <button type="button" onclick="openDeleteModal('delete-user-{{ $user->id }}')" class="inline-flex items-center justify-center p-2 rounded-xl text-red-500 hover:bg-red-50 transition-all" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        
                        <x-admin.delete-modal id="delete-user-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" title="Hapus Pengguna" message="Apakah Anda yakin ingin menghapus akun {{ $user->name }}? Tindakan ini tidak dapat dibatalkan." />
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
