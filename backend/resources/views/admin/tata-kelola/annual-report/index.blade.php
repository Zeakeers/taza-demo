@extends('layouts.admin')
@section('header', 'Kelola Laporan Publikasi')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Daftar Laporan Publikasi</h2>
    </div>
    <a href="{{ route('admin.tata-kelola.annual-report.create') }}" class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
        + Tambah Baru
    </a>
</div>

@if(session('success'))
<div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-3 text-green-700">
    <div class="p-2 bg-green-100 rounded-xl">
        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <div>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50/50 text-xs text-gray-400 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-medium">Data</th>
                    <th class="px-6 py-4 font-medium w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($reports ?? $items as $item)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $item->title ?? $item->description }}</div>
                        <div class="text-xs text-gray-400 mt-1">{{ $item->year ?? '' }}</div>
                        @if($item->file)
                        <div class="text-xs text-blue-500 mt-1"><a href="{{ Str::startsWith($item->file, 'http') || Str::startsWith($item->file, '/') ? $item->file : Storage::url($item->file) }}" target="_blank">Lihat File</a></div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.tata-kelola.annual-report.edit', $item->id) }}" class="p-2 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg transition-colors">Edit</a>
                            <form action="{{ route('admin.tata-kelola.annual-report.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection