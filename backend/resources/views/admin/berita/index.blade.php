@extends('layouts.admin')

@section('header', 'Kelola Berita')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">Daftar Berita</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola artikel dan berita yang tampil di website.</p>
    </div>
    <a href="{{ route('admin.berita.create') }}" class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-primary/30 flex items-center gap-2 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Berita
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-600 px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-50">
                    <th class="pb-4 font-bold">Judul Berita</th>
                    <th class="pb-4 font-bold text-center">Kategori</th>
                    <th class="pb-4 font-bold text-center">Status Publish</th>
                    <th class="pb-4 font-bold text-center">Tampil di Home</th>
                    <th class="pb-4 font-bold text-center">Tanggal</th>
                    <th class="pb-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($beritas as $item)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
                    <td class="py-5">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Thumbnail" class="w-16 h-12 object-cover rounded-lg border border-gray-100 shadow-sm">
                            <span class="font-bold text-zinc-800 line-clamp-2 max-w-xs">{{ $item->judul }}</span>
                        </div>
                    </td>

                    <td class="py-5 text-center">
                        <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-600">
                            {{ $item->kategori ?? '-' }}
                        </span>
                    </td>
                    
                    <td class="py-5 text-center">
                        <form action="{{ route('admin.berita.toggle-publish', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider transition-all {{ $item->is_published ? 'bg-green-100 text-green-600 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                {{ $item->is_published ? 'Published' : 'Draft' }}
                            </button>
                        </form>
                    </td>

                    <td class="py-5 text-center">
                        <form action="{{ route('admin.berita.toggle-home', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider transition-all {{ $item->show_on_home ? 'bg-primary/10 text-primary hover:bg-primary/20' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                {{ $item->show_on_home ? 'Di Home' : 'Sembunyikan' }}
                            </button>
                        </form>
                    </td>

                    <td class="py-5 text-gray-400 text-center font-medium">{{ $item->created_at->format('d M Y') }}</td>
                    
                    <td class="py-5 text-right space-x-1 flex justify-end gap-1 items-center">
                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-blue-500 hover:bg-blue-50 transition-all" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button type="button" onclick="openDeleteModal('delete-berita-{{ $item->id }}')" class="inline-flex items-center justify-center p-2 rounded-xl text-red-500 hover:bg-red-50 transition-all" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        
                        <x-admin.delete-modal id="delete-berita-{{ $item->id }}" action="{{ route('admin.berita.destroy', $item->id) }}" title="Hapus Berita" message="Apakah Anda yakin ingin menghapus berita '{{ $item->judul }}'? Tindakan ini tidak dapat dibatalkan." />
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center gap-3">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            Belum ada data berita.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
