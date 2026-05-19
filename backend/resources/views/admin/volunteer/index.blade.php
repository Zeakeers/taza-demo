@extends('layouts.admin')

@section('header', 'Data Volunteer')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">Daftar Volunteer</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola data volunteer dari website.</p>
    </div>
</div>

@if(session('success'))
<div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left whitespace-nowrap">
            <thead>
                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-50">
                    @foreach($form_fields as $field)
                        @if($field['type'] != 'textarea' && $loop->iteration <= 4) 
                            <th class="pb-4 font-bold">{{ $field['label'] }}</th>
                        @endif
                    @endforeach
                    <th class="pb-4 font-bold text-center">Status</th>
                    <th class="pb-4 font-bold text-center">Tanggal</th>
                    <th class="pb-4 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @php
                    function getFieldValue($item, $fieldName) {
                        $coreFields = ['nama', 'no_hp', 'email', 'kontribusi', 'keterangan'];
                        if (in_array($fieldName, $coreFields)) {
                            return $item->$fieldName ?? '-';
                        }
                        if ($item->additional_data && isset($item->additional_data[$fieldName])) {
                            return $item->additional_data[$fieldName];
                        }
                        return '-';
                    }
                @endphp
                @forelse($volunteers as $item)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
                    @foreach($form_fields as $field)
                        @if($field['type'] != 'textarea' && $loop->iteration <= 4)
                            @php $val = getFieldValue($item, $field['name']); @endphp
                            
                            @if($field['name'] == 'nama')
                                <td class="py-5 font-bold text-zinc-800">{{ $val }}</td>
                            @elseif($field['name'] == 'no_hp' || $field['type'] == 'tel')
                                <td class="py-5 text-gray-500">
                                    @php $wa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $val)); @endphp
                                    @if($wa)
                                        <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-[#25D366] hover:underline hover:text-green-600 font-medium transition-colors">
                                            {{ $val }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            @else
                                <td class="py-5 text-gray-500">{{ Str::limit($val, 30) }}</td>
                            @endif
                        @endif
                    @endforeach
                    <td class="py-5 text-center">
                        @if($item->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Pending</span>
                        @elseif($item->status == 'diterima')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Diterima</span>
                        @else
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Ditolak</span>
                        @endif
                    </td>
                    <td class="py-5 text-gray-400 text-center">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="py-5 text-right space-x-1 flex justify-end gap-1">
                        <a href="{{ route('admin.volunteer.show', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-zinc-500 hover:bg-zinc-100 transition-all" title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                        <a href="{{ route('admin.volunteer.edit', $item->id) }}" class="inline-flex items-center justify-center p-2 rounded-xl text-blue-500 hover:bg-blue-50 transition-all" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button type="button" onclick="openDeleteModal('delete-volunteer-{{ $item->id }}')" class="inline-flex items-center justify-center p-2 rounded-xl text-red-500 hover:bg-red-50 transition-all" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        
                        <x-admin.delete-modal id="delete-volunteer-{{ $item->id }}" action="{{ route('admin.volunteer.destroy', $item->id) }}" title="Hapus Data Volunteer" message="Apakah Anda yakin ingin menghapus data volunteer {{ $item->nama }}? Tindakan ini tidak dapat dibatalkan." />
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-500">Belum ada data volunteer.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
