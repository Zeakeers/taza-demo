@extends('layouts.admin')

@section('header', 'Detail Konfirmasi Donasi')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.konfirmasi-donasi.index') }}" class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 hover:text-primary transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-zinc-800">Detail Donasi</h2>
            <p class="text-gray-500 text-sm mt-1">Informasi lengkap konfirmasi donasi.</p>
        </div>
    </div>
    <div class="flex gap-2" x-data="{ showAccModal: false, showTolakModal: false }">
        <button type="button" @click="showAccModal = true" class="bg-primary hover:bg-green-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/30 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Terima (Acc)
        </button>
        
        <button type="button" @click="showTolakModal = true" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-red-500/30 transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            Tolak
        </button>

        <!-- ACC Modal -->
        <div x-show="showAccModal" class="fixed inset-0 z-[100]" style="display: none;">
            <div x-show="showAccModal" x-transition.opacity class="absolute inset-0 bg-dark/60 backdrop-blur-sm" @click="showAccModal = false"></div>
            <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
                <div x-show="showAccModal" x-transition.scale.origin.bottom class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md relative overflow-hidden pointer-events-auto">
                    <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                    <div class="p-8 text-center sm:p-10">
                        <div class="w-20 h-20 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-3">Terima Konfirmasi</h3>
                        <p class="text-gray-500 mb-8">Anda yakin ingin menyetujui konfirmasi donasi ini? Status akan diubah menjadi "Diterima".</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button type="button" @click="showAccModal = false" class="px-6 py-3 rounded-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors w-full sm:w-auto">Batal</button>
                            <form action="{{ route('admin.konfirmasi-donasi.update-status', $konfirmasiDonasi->id) }}" method="POST" class="w-full sm:w-auto m-0">
                                @csrf
                                <input type="hidden" name="status" value="acc">
                                <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-primary hover:bg-green-600 shadow-lg shadow-primary/30 transition-all w-full flex items-center justify-center gap-2">Ya, Terima</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOLAK Modal -->
        <div x-show="showTolakModal" class="fixed inset-0 z-[100]" style="display: none;">
            <div x-show="showTolakModal" x-transition.opacity class="absolute inset-0 bg-dark/60 backdrop-blur-sm" @click="showTolakModal = false"></div>
            <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
                <div x-show="showTolakModal" x-transition.scale.origin.bottom class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md relative overflow-hidden pointer-events-auto">
                    <div class="absolute top-0 left-0 w-full h-2 bg-red-500"></div>
                    <div class="p-8 text-center sm:p-10">
                        <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-3">Tolak Konfirmasi</h3>
                        <p class="text-gray-500 mb-8">Anda yakin ingin menolak konfirmasi donasi ini? Status akan diubah menjadi "Ditolak".</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button type="button" @click="showTolakModal = false" class="px-6 py-3 rounded-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors w-full sm:w-auto">Batal</button>
                            <form action="{{ route('admin.konfirmasi-donasi.update-status', $konfirmasiDonasi->id) }}" method="POST" class="w-full sm:w-auto m-0">
                                @csrf
                                <input type="hidden" name="status" value="tolak">
                                <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-red-500 hover:bg-red-600 shadow-lg shadow-red-500/30 transition-all w-full flex items-center justify-center gap-2">Ya, Tolak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="bg-primary/10 border border-primary/20 text-primary px-6 py-4 rounded-2xl mb-6 font-medium flex items-center gap-3">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 pb-4 border-b border-gray-100">Informasi Donatur</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Nama Lengkap</p>
                    <p class="font-semibold text-zinc-800 text-lg">{{ $konfirmasiDonasi->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">No WhatsApp</p>
                    @php $wa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $konfirmasiDonasi->no_whatsapp)); @endphp
                    <a href="https://wa.me/{{ $wa }}" target="_blank" class="inline-flex items-center gap-2 text-[#25D366] hover:text-green-600 font-semibold text-lg hover:underline transition-all group">
                        <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 .004 5.381.004 12.028c0 2.128.552 4.192 1.6 6.012L.03 24l6.115-1.602a11.972 11.972 0 005.886 1.545c6.643 0 12.025-5.38 12.025-12.027C24.056 5.382 18.675 0 12.031 0zm0 21.968c-1.802 0-3.567-.484-5.112-1.401l-.367-.217-3.799.996.998-3.704-.238-.378a9.982 9.982 0 01-1.536-5.342c0-5.541 4.51-10.05 10.054-10.05 5.544 0 10.053 4.509 10.053 10.05S17.575 21.968 12.031 21.968zM17.55 14.41c-.302-.15-1.792-.885-2.071-.986-.279-.101-.482-.15-.684.151-.202.302-.782.986-.958 1.188-.176.202-.352.227-.655.076-.302-.15-1.28-.471-2.438-1.503-.902-.803-1.51-1.793-1.686-2.095-.176-.302-.019-.465.132-.616.135-.135.302-.353.453-.529.151-.176.202-.302.302-.504.101-.202.05-.378-.025-.529-.076-.151-.684-1.65-.937-2.257-.247-.591-.497-.512-.684-.521-.176-.01-.378-.01-.58-.01-.202 0-.529.076-.806.378-.277.302-1.058 1.033-1.058 2.518 0 1.485 1.083 2.92 1.234 3.121.151.202 2.128 3.25 5.155 4.553.72.31 1.28.496 1.718.634.721.229 1.378.196 1.895.118.577-.087 1.792-.733 2.044-1.442.252-.71.252-1.317.176-1.442-.075-.126-.277-.202-.579-.353z"/></svg>
                        {{ $konfirmasiDonasi->no_whatsapp }}
                        <span class="opacity-0 group-hover:opacity-100 transition-opacity text-xs bg-[#25D366]/10 px-2 py-1 rounded-md ml-1">Hubungi</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 pb-4 border-b border-gray-100">Detail Transfer Donasi</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Tanggal Transfer</p>
                    <p class="font-semibold text-zinc-800">{{ \Carbon\Carbon::parse($konfirmasiDonasi->tanggal_transfer)->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Program Tujuan</p>
                    <p class="font-semibold text-zinc-800">{{ $konfirmasiDonasi->program }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-1">Nominal Donasi</p>
                    <p class="font-bold text-primary text-3xl mt-1">Rp {{ number_format($konfirmasiDonasi->nominal, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 pb-4 border-b border-gray-100">Status Konfirmasi</h3>
            
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Status Saat Ini</span>
                    @if($konfirmasiDonasi->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Pending</span>
                    @elseif($konfirmasiDonasi->status == 'acc')
                        <span class="bg-green-100 text-green-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Diterima</span>
                    @else
                        <span class="bg-red-100 text-red-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Ditolak</span>
                    @endif
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <span class="text-sm text-gray-500">Dibuat Pada</span>
                    <span class="font-semibold text-zinc-800">{{ $konfirmasiDonasi->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 pb-4 border-b border-gray-100">Bukti Transfer</h3>
            
            @if($konfirmasiDonasi->bukti_pembayaran)
                <div class="rounded-2xl overflow-hidden border border-gray-200">
                    <img src="{{ asset('storage/' . $konfirmasiDonasi->bukti_pembayaran) }}" alt="Bukti Transfer" class="w-full h-auto object-cover">
                </div>
                <a href="{{ asset('storage/' . $konfirmasiDonasi->bukti_pembayaran) }}" target="_blank" class="mt-4 w-full flex justify-center items-center gap-2 py-3 bg-gray-50 hover:bg-gray-100 text-zinc-700 font-semibold rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Buka Gambar Penuh
                </a>
            @else
                <div class="py-10 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-sm font-medium">Tidak ada bukti pembayaran</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
