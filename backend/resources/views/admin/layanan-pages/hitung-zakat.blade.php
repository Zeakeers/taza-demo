@extends('layouts.admin')

@section('header', 'Hitung Zakat')

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
            <h1 class="text-xl lg:text-3xl font-bold text-dark">Kelola Hitung Zakat</h1>
            <p class="text-gray-400 text-[10px] lg:text-base mt-1">Kelola teks dan pengaturan pada halaman kalkulator zakat.</p>
        </div>
    </div>

    @php
        $data = $hitungZakat ? $hitungZakat->content : [
            'heading' => 'TUNAIKAN ZAKAT, INFAK, DAN SEDEKAH ANDA DENGAN AMAN DAN MUDAH',
            'kalkulator_title' => 'Kalkulator Zakat',
            'kalkulator_description' => 'Kalkulator zakat adalah layanan untuk mempermudah perhitungan jumlah zakat yang harus ditunaikan oleh setiap umat muslim sesuai ketetapan syariah. Oleh karena itu, bagi Anda yang ingin mengetahui berapa jumlah zakat yang harus ditunaikan, silahkan gunakan fasilitas Kalkulator Zakat dibawah ini.',
            'default_harga_emas' => '2.864.143',
            'default_harga_beras' => '50.000',
            'disclaimer_items' => [
                'Fatwa MUI No. 3 Tahun 2003 tentang Zakat Penghasilan',
                'Keputusan Majma Fiqih Islami (OKI) tentang Zakat Kontemporer',
                'Pendapat mayoritas ulama kontemporer (Dr. Yusuf Qardhawi, dll)',
            ],
        ];
    @endphp

    <form action="{{ route('admin.layanan-pages.hitung-zakat.update') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            {{-- Text Content --}}
            <div class="space-y-8">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-zinc-800">Konten Teks Halaman</h2>
                        <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                            Simpan Perubahan
                        </button>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Heading Utama</label>
                        <textarea name="content[heading]" rows="2" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none">{{ $data['heading'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Kalkulator</label>
                        <input type="text" name="content[kalkulator_title]" value="{{ $data['kalkulator_title'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Kalkulator</label>
                        <textarea name="content[kalkulator_description]" rows="4" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none">{{ $data['kalkulator_description'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Default Values & Disclaimer --}}
            <div class="space-y-8">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                    <h2 class="text-lg font-bold text-zinc-800">Default Nilai Kalkulator</h2>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Default Harga Emas (per gram)</label>
                        <div class="flex items-center">
                            <span class="bg-gray-50 px-4 py-3 rounded-l-xl border border-r-0 border-gray-200 text-gray-500 font-medium">Rp</span>
                            <input type="text" name="content[default_harga_emas]" value="{{ $data['default_harga_emas'] ?? '' }}" class="flex-1 px-5 py-3 rounded-r-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1 italic">*Ini adalah harga default yang muncul di form. User bisa mengubahnya sendiri.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Default Harga Beras (per jiwa)</label>
                        <div class="flex items-center">
                            <span class="bg-gray-50 px-4 py-3 rounded-l-xl border border-r-0 border-gray-200 text-gray-500 font-medium">Rp</span>
                            <input type="text" name="content[default_harga_beras]" value="{{ $data['default_harga_beras'] ?? '' }}" class="flex-1 px-5 py-3 rounded-r-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1 italic">*Harga default untuk zakat fitrah (BAZNAS Rp 50.000).</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-zinc-800">Disclaimer</h2>
                        <button type="button" onclick="addDisclaimer()" class="text-primary font-bold text-sm hover:underline">+ Tambah Item</button>
                    </div>

                    <div id="disclaimer-list" class="space-y-3">
                        @foreach($data['disclaimer_items'] ?? [] as $dIndex => $disclaimerItem)
                        <div class="disclaimer-item flex items-center gap-3">
                            <div class="w-2 h-2 bg-primary rounded-full shrink-0"></div>
                            <input type="text" name="content[disclaimer_items][]" value="{{ $disclaimerItem }}" class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-sm">
                            <button type="button" onclick="this.closest('.disclaimer-item').remove()" class="text-red-400 hover:text-red-600 transition-colors p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function addDisclaimer() {
        const div = document.createElement('div');
        div.className = 'disclaimer-item flex items-center gap-3';
        div.innerHTML = `
            <div class="w-2 h-2 bg-primary rounded-full shrink-0"></div>
            <input type="text" name="content[disclaimer_items][]" class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all text-sm" placeholder="Item disclaimer baru...">
            <button type="button" onclick="this.closest('.disclaimer-item').remove()" class="text-red-400 hover:text-red-600 transition-colors p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;
        document.getElementById('disclaimer-list').appendChild(div);
    }
</script>
@endsection
