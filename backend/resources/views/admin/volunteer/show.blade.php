@extends('layouts.admin')

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('admin.volunteer.index') }}" class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    Detail Volunteer
</div>
@endsection

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-zinc-800">{{ $volunteer->nama }}</h2>
        <p class="text-gray-500 text-sm mt-1">Dikirim pada {{ $volunteer->created_at->format('d F Y - H:i') }}</p>
    </div>
    
    <div class="flex flex-wrap gap-2">
        @if($volunteer->status == 'pending')
            <span class="bg-yellow-100 text-yellow-600 px-4 py-2 rounded-xl text-sm font-bold uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pending
            </span>
        @elseif($volunteer->status == 'diterima')
            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-xl text-sm font-bold uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Diterima
            </span>
        @else
            <span class="bg-red-100 text-red-600 px-4 py-2 rounded-xl text-sm font-bold uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Ditolak
            </span>
        @endif
        
        <form action="{{ route('admin.volunteer.update-status', $volunteer->id) }}" method="POST" class="flex gap-2">
            @csrf
            @if($volunteer->status != 'diterima')
                <input type="hidden" name="status" value="diterima">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm shadow-green-500/20">
                    Terima
                </button>
            @endif
        </form>
        
        <form action="{{ route('admin.volunteer.update-status', $volunteer->id) }}" method="POST" class="flex gap-2">
            @csrf
            @if($volunteer->status != 'ditolak')
                <input type="hidden" name="status" value="ditolak">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-colors shadow-sm shadow-red-500/20">
                    Tolak
                </button>
            @endif
        </form>
    </div>
</div>

@if(session('success'))
<div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Informasi Volunteer -->
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Informasi Volunteer
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <label class="block text-xs uppercase tracking-wider text-gray-400 font-bold mb-1">Nama Lengkap</label>
                    <p class="text-zinc-800 font-medium text-lg">{{ $volunteer->nama }}</p>
                </div>
                
                <div>
                    <label class="block text-xs uppercase tracking-wider text-gray-400 font-bold mb-1">No WhatsApp</label>
                    @php $wa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $volunteer->no_hp)); @endphp
                    <a href="https://wa.me/{{ $wa }}" target="_blank" class="inline-flex items-center gap-2 text-[#25D366] hover:text-green-600 font-medium bg-green-50 px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        {{ $volunteer->no_hp }}
                    </a>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs uppercase tracking-wider text-gray-400 font-bold mb-1">Email</label>
                    <p class="text-zinc-800">{{ $volunteer->email }}</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs uppercase tracking-wider text-gray-400 font-bold mb-1">Bidang Kontribusi</label>
                    <p class="text-zinc-800">{{ $volunteer->kontribusi ?? '-' }}</p>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-xs uppercase tracking-wider text-gray-400 font-bold mb-1">Motivasi & Keterangan</label>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-zinc-700 whitespace-pre-wrap">
                        {{ $volunteer->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="space-y-6">
        <!-- Actions -->
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Aksi Tambahan
            </h3>
            
            <div class="space-y-3">
                <a href="{{ route('admin.volunteer.edit', $volunteer->id) }}" class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-xl font-medium transition-colors border border-blue-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit Data Volunteer
                </a>
                
                <button type="button" onclick="openDeleteModal('delete-volunteer-{{ $volunteer->id }}')" class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-red-50 text-red-600 hover:bg-red-100 rounded-xl font-medium transition-colors border border-red-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus Data
                </button>
            </div>
            
            <x-admin.delete-modal id="delete-volunteer-{{ $volunteer->id }}" action="{{ route('admin.volunteer.destroy', $volunteer->id) }}" title="Hapus Data Volunteer" message="Apakah Anda yakin ingin menghapus data volunteer {{ $volunteer->nama }}? Tindakan ini tidak dapat dibatalkan." />
        </div>
    </div>
</div>
@endsection
