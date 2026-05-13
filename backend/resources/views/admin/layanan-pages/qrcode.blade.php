@extends('layouts.admin')

@section('header', 'QR Code Donasi')

@section('content')
<div class="space-y-8 pb-20">

    @if(session('success'))
    <div id="alert-success" class="bg-primary text-white p-4 rounded-2xl shadow-lg shadow-primary/20 flex items-center justify-between gap-3 animate-bounce">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-white hover:text-gray-200 p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>
    @endif

    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-xl lg:text-3xl font-bold text-dark">Kelola QR Code Donasi</h1>
            <p class="text-gray-400 text-[10px] lg:text-base mt-1">Kelola teks dan gambar QR Code pada halaman QR Code Donasi.</p>
        </div>
    </div>

    @php
        $data = $qrcode ? $qrcode->content : [
            'title' => 'Satu Scan, Banyak Kebaikan',
            'description' => 'Berbagi kini semakin mudah. Dukung berbagai program kebaikan melalui satu QR code sederhana.',
            'qr_image' => '/images/gambardetaile/qr 1.svg',
        ];
    @endphp

    <form action="{{ route('admin.layanan-pages.qrcode.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            {{-- Form Fields --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h2 class="text-lg font-bold text-zinc-800 mb-2">Konten Teks</h2>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Halaman</label>
                    <input type="text" name="content[title]" value="{{ $data['title'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Satu Scan, Banyak Kebaikan">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="content[description]" rows="3" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none" placeholder="Deskripsi halaman QR Code">{{ $data['description'] ?? '' }}</textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            {{-- QR Image Upload --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                <h2 class="text-lg font-bold text-zinc-800 mb-2">Gambar QR Code</h2>

                <div class="relative group aspect-[3/4] max-w-sm mx-auto rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex items-center justify-center">
                    @if(isset($data['qr_image']) && $data['qr_image'])
                        <img src="{{ $data['qr_image'] }}" class="w-full h-full object-contain p-4" id="qr-preview">
                        <input type="hidden" name="existing_qr_image" value="{{ $data['qr_image'] }}">
                    @else
                        <div class="text-center p-6" id="qr-placeholder">
                            <svg class="mx-auto h-16 w-16 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Belum ada gambar QR</p>
                        </div>
                        <img src="" class="w-full h-full object-contain p-4 hidden" id="qr-preview">
                    @endif
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-10">
                        <label class="cursor-pointer bg-white text-zinc-800 px-4 py-2 rounded-xl font-bold text-sm shadow-xl hover:bg-gray-100 transition-colors">
                            Ganti QR Code
                            <input type="file" name="qr_image" class="hidden" accept="image/*" onchange="previewQrImage(this)">
                        </label>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-2xl">
                    <h4 class="text-sm font-bold text-blue-800 mb-1 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tips Gambar QR
                    </h4>
                    <p class="text-xs text-blue-700 leading-relaxed">
                        Gunakan gambar QR Code dengan format <strong>SVG atau PNG</strong> dengan latar transparan untuk hasil terbaik. Rasio yang direkomendasikan adalah <strong>3:4</strong>.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewQrImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('qr-preview');
                const placeholder = document.getElementById('qr-placeholder');
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
