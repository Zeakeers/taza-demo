@extends('layouts.admin')

@section('header', 'Data Konfirmasi Donasi')

@section('content')
<div class="mb-6 flex justify-between items-end">
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">Daftar Konfirmasi Donasi</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola data konfirmasi donasi dari pelanggan.</p>
    </div>
</div>

@if(session('success'))
<div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden p-8">
    <x-admin.table-filter route="{{ route('admin.konfirmasi-donasi.index') }}" />
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="border-b border-gray-100 bg-gray-50/50">
                    <th class="py-4 px-6 font-bold text-gray-500 text-xs uppercase tracking-wider">Nama Lengkap</th>
                    <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">No WhatsApp</th>
                    <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Program</th>
                    <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Nominal</th>
                    <th class="py-4 text-center font-bold text-gray-500 text-xs uppercase tracking-wider">Status</th>
                    <th class="py-4 px-6 text-right font-bold text-gray-500 text-xs uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($donasis as $item)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
                    <td class="py-5 px-6 font-bold text-zinc-800">{{ $item->nama_lengkap }}</td>
                    <td class="py-5 text-gray-500">
                        @php $wa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $item->no_whatsapp)); @endphp
                        <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-[#25D366] hover:underline hover:text-green-600 font-medium transition-colors inline-flex items-center gap-1">
                            {{ $item->no_whatsapp }}
                        </a>
                    </td>
                    <td class="py-5 text-gray-500">{{ $item->program }}</td>
                    <td class="py-5 text-gray-500 font-semibold">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                    <td class="py-5 text-center">
                        @if($item->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Pending</span>
                        @elseif($item->status == 'acc')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Diterima</span>
                        @else
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Ditolak</span>
                        @endif
                    </td>
                    <td class="py-5 text-right space-x-1 flex justify-end gap-1">
                        <a href="{{ route('admin.konfirmasi-donasi.show', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-zinc-500 hover:bg-zinc-100 transition-all" title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <a href="{{ route('admin.konfirmasi-donasi.edit', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-blue-500 hover:bg-blue-50 transition-all" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button type="button" onclick="openDeleteModal('delete-donasi-{{ $item->id }}')" class="inline-flex items-center justify-center p-2 rounded-xl text-red-500 hover:bg-red-50 transition-all" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        
                        <x-admin.delete-modal id="delete-donasi-{{ $item->id }}" action="{{ route('admin.konfirmasi-donasi.destroy', $item->id) }}" title="Hapus Data Donasi" message="Apakah Anda yakin ingin menghapus data konfirmasi donasi dari {{ $item->nama_lengkap }}? Tindakan ini tidak dapat dibatalkan." />
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-400">Belum ada data konfirmasi donasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $donasis->links() }}
</div>
@endsection
