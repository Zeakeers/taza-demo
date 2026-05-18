@extends('layouts.admin')

@section('header', 'Pengaturan Halaman Volunteer')

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
            <h1 class="text-xl lg:text-3xl font-bold text-dark">Kelola Tampilan Volunteer</h1>
            <p class="text-gray-400 text-[10px] lg:text-base mt-1">Atur gambar banner, data angka (statistik), dan formulir pendaftaran.</p>
        </div>
    </div>

    @php
        $data = $page ? $page->content : [
            'hero_title' => 'Jadilah Bagian Perubahan Nyata',
            'hero_subtitle' => 'Bersama Taman Zakat, setiap langkahmu memberi dampak bagi ribuan keluarga. Jadilah relawan dan ukir kisah yang berarti.',
            'hero_image' => '/images/gambardetaile/hero bidang kemanusian.svg',
            'stats' => [
                ['number' => '10K+', 'label' => 'Penerima Manfaat'],
                ['number' => '50+', 'label' => 'Program Sosial'],
                ['number' => '8', 'label' => 'Kota Cakupan'],
            ],
            'form_title' => 'Siap Beraksi? Daftarkan Dirimu!',
            'form_subtitle' => 'Isi formulir di bawah ini dan tim kami akan segera menghubungimu.',
            'areas' => [
                'Pendidikan',
                'Kesehatan',
                'Lingkungan',
                'Pemberdayaan Ekonomi',
                'Sosial Kemasyarakatan',
                'Kemanusiaan & Bencana'
            ]
        ];
        
        $stats = $data['stats'] ?? [
            ['number' => '10K+', 'label' => 'Penerima Manfaat'],
            ['number' => '50+', 'label' => 'Program Sosial'],
            ['number' => '8', 'label' => 'Kota Cakupan'],
        ];

        $form_fields = $data['form_fields'] ?? [
            ['name' => 'nama', 'label' => 'Nama Lengkap', 'type' => 'text', 'placeholder' => 'Masukkan nama lengkap', 'required' => '1', 'is_fixed' => '1'],
            ['name' => 'no_hp', 'label' => 'No. HP / WhatsApp', 'type' => 'text', 'placeholder' => 'Contoh: 08123456789', 'required' => '1', 'is_fixed' => '1'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'placeholder' => 'contoh@email.com', 'required' => '1', 'is_fixed' => '1'],
            ['name' => 'kontribusi', 'label' => 'Bidang Kontribusi', 'type' => 'select', 'options' => 'Pendidikan,Kesehatan,Lingkungan,Pemberdayaan Ekonomi,Sosial Kemasyarakatan,Kemanusiaan & Bencana', 'required' => '1', 'is_fixed' => '1'],
            ['name' => 'keterangan', 'label' => 'Ceritakan Motivasimu', 'type' => 'textarea', 'placeholder' => 'Kenapa kamu ingin jadi volunteer Taman Zakat?', 'required' => '0', 'is_fixed' => '1'],
        ];
    @endphp

    <form action="{{ route('admin.volunteer.page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 lg:gap-8">
            
            <!-- Sidebar Navigation (Tabs) -->
            <div class="xl:col-span-1 flex xl:flex-col gap-2 overflow-x-auto pb-4 xl:pb-0 xl:space-y-2 xl:sticky xl:self-start xl:top-8 bg-transparent xl:bg-white xl:p-4 xl:rounded-[2rem] xl:shadow-xl xl:border xl:border-white hide-scrollbar">
                <button type="button" onclick="showSection('hero')" id="tab-hero" class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-white text-dark shadow-sm border border-transparent whitespace-nowrap hover:shadow-md">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-left">Hero Banner</span>
                </button>
                <button type="button" onclick="showSection('stats')" id="tab-stats" class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span class="text-left">Data Statistik</span>
                </button>
                <button type="button" onclick="showSection('form')" id="tab-form" class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-left">Konten Formulir</span>
                </button>
            </div>

            <!-- Content Area -->
            <div class="xl:col-span-3 space-y-6">
                
                {{-- Hero Settings --}}
                <div id="section-hero" class="content-section bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6 block">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h2 class="text-xl font-bold text-dark">Hero Banner</h2>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Hero</label>
                        <input type="text" name="content[hero_title]" value="{{ $data['hero_title'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Sub-judul / Deskripsi</label>
                        <textarea name="content[hero_subtitle]" rows="3" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none">{{ $data['hero_subtitle'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Banner</label>
                        <div class="relative group aspect-video w-full rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex items-center justify-center">
                            @if(isset($data['hero_image']) && $data['hero_image'])
                                <img src="{{ $data['hero_image'] }}" class="w-full h-full object-cover" id="hero-preview">
                                <input type="hidden" name="existing_hero_image" value="{{ $data['hero_image'] }}">
                            @else
                                <div class="text-center p-6" id="hero-placeholder">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Pilih Gambar</p>
                                </div>
                                <img src="" class="w-full h-full object-cover hidden" id="hero-preview">
                            @endif
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-10">
                                <label class="cursor-pointer bg-white text-zinc-800 px-4 py-2 rounded-xl font-bold text-sm shadow-xl hover:bg-gray-100 transition-colors">
                                    Ganti Gambar
                                    <input type="file" name="hero_image" class="hidden" accept="image/*" onchange="previewHeroImage(this)">
                                </label>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Rekomendasi rasio 16:9 atau gambar lanskap.</p>
                    </div>
                </div>

                {{-- Stats Settings --}}
                <div id="section-stats" class="content-section bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6 hidden">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <h2 class="text-xl font-bold text-dark">Data Statistik (Angka)</h2>
                        </div>
                    </div>
                    
                    <div id="stats-container" class="space-y-4">
                        @foreach($stats as $index => $stat)
                        <div class="flex items-center gap-3 stat-item">
                            <div class="flex-1">
                                <input type="text" name="content[stats][{{$index}}][number]" value="{{ $stat['number'] ?? '' }}" placeholder="Angka (Contoh: 10K+)" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm font-bold">
                            </div>
                            <div class="flex-[2]">
                                <input type="text" name="content[stats][{{$index}}][label]" value="{{ $stat['label'] ?? '' }}" placeholder="Label (Contoh: Penerima Manfaat)" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm">
                            </div>
                            <button type="button" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors remove-stat">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    
                    <button type="button" id="add-stat" class="w-full py-3 border-2 border-dashed border-gray-200 text-gray-500 rounded-xl font-bold text-sm hover:border-primary hover:text-primary transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Data
                    </button>
                </div>

                {{-- Form Customization --}}
                <div id="section-form" class="content-section bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6 hidden">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h2 class="text-xl font-bold text-dark">Konten Formulir</h2>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Judul Form</label>
                            <input type="text" name="content[form_title]" value="{{ $data['form_title'] ?? 'Siap Beraksi? Daftarkan Dirimu!' }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Form</label>
                            <textarea name="content[form_subtitle]" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none transition-all resize-none">{{ $data['form_subtitle'] ?? 'Isi formulir di bawah ini dan tim kami akan segera menghubungimu.' }}</textarea>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-bold text-gray-700">Kolom Pertanyaan Form</label>
                            <button type="button" id="add-field" class="px-4 py-2 bg-primary/10 text-primary rounded-xl font-bold text-sm hover:bg-primary hover:text-white transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Pertanyaan
                            </button>
                        </div>
                        <div id="fields-container" class="space-y-4">
                            @foreach($form_fields as $index => $field)
                            <div class="field-item bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative group transition-all hover:border-primary/20 hover:shadow-md">
                                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold field-number">{{ $index + 1 }}</div>
                                        <span class="text-sm font-bold text-gray-700">Pengaturan Pertanyaan</span>
                                    </div>
                                    <button type="button" class="text-red-500 hover:bg-red-50 hover:text-red-600 px-3 py-1.5 rounded-lg transition-colors remove-field flex items-center gap-1.5 text-xs font-bold border border-transparent hover:border-red-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="hidden">
                                        <input type="hidden" name="content[form_fields][{{$index}}][is_fixed]" value="{{ $field['is_fixed'] ?? '0' }}">
                                        <input type="text" name="content[form_fields][{{$index}}][name]" value="{{ $field['name'] }}" class="field-name">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Label Pertanyaan</label>
                                        <input type="text" name="content[form_fields][{{$index}}][label]" value="{{ $field['label'] }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm bg-white" required>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tipe</label>
                                        <div class="relative custom-dropdown-container">
                                            <input type="hidden" name="content[form_fields][{{$index}}][type]" class="field-type" value="{{ $field['type'] }}">
                                            
                                            <button type="button" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-left flex justify-between items-center dropdown-trigger focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                                                <span class="dropdown-selected-text text-gray-700">
                                                    @if($field['type'] == 'text') Teks Pendek
                                                    @elseif($field['type'] == 'textarea') Teks Panjang
                                                    @elseif($field['type'] == 'email') Email
                                                    @elseif($field['type'] == 'select') Pilihan (Dropdown)
                                                    @else Teks Pendek
                                                    @endif
                                                </span>
                                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </button>
                                            
                                            <div class="absolute z-10 w-full mt-1 bg-white rounded-xl shadow-lg border border-gray-100 py-2 hidden dropdown-menu opacity-0 transition-opacity duration-200 top-full left-0 overflow-hidden">
                                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item {{ $field['type'] == 'text' ? 'bg-primary/10 text-primary font-bold' : 'text-gray-700' }} hover:bg-gray-50" data-value="text" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Teks Pendek</button>
                                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item {{ $field['type'] == 'textarea' ? 'bg-primary/10 text-primary font-bold' : 'text-gray-700' }} hover:bg-gray-50" data-value="textarea" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Teks Panjang</button>
                                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item {{ $field['type'] == 'email' ? 'bg-primary/10 text-primary font-bold' : 'text-gray-700' }} hover:bg-gray-50" data-value="email" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Email</button>
                                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item {{ $field['type'] == 'select' ? 'bg-primary/10 text-primary font-bold' : 'text-gray-700' }} hover:bg-gray-50" data-value="select" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Pilihan (Dropdown)</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="md:col-span-2 field-options-container {{ $field['type'] == 'select' ? '' : 'hidden' }}">
                                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Pilihan (Pisahkan dengan koma)</label>
                                        <input type="text" name="content[form_fields][{{$index}}][options]" value="{{ $field['options'] ?? '' }}" placeholder="Contoh: Pendidikan, Kesehatan, Sosial" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm bg-white">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Placeholder teks (opsional)</label>
                                        <input type="text" name="content[form_fields][{{$index}}][placeholder]" value="{{ $field['placeholder'] ?? '' }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm bg-white">
                                    </div>
                                    
                                    <div class="md:col-span-2 flex items-center gap-2 mt-2">
                                        <input type="hidden" name="content[form_fields][{{$index}}][required]" value="0">
                                        <input type="checkbox" name="content[form_fields][{{$index}}][required]" value="1" id="req-{{$index}}" class="w-4 h-4 text-primary rounded border-gray-300" {{ (isset($field['required']) && $field['required'] == '1') ? 'checked' : '' }}>
                                        <label for="req-{{$index}}" class="text-sm text-gray-700">Wajib Diisi</label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20 text-lg w-full md:w-auto">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.content-section').forEach(el => {
            el.classList.remove('block');
            el.classList.add('hidden');
        });
        
        // Reset all tabs
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('bg-white', 'text-dark', 'shadow-sm');
            el.classList.add('bg-transparent', 'text-gray-500');
        });
        
        // Show active section
        document.getElementById('section-' + sectionId).classList.remove('hidden');
        document.getElementById('section-' + sectionId).classList.add('block');
        
        // Highlight active tab
        const activeTab = document.getElementById('tab-' + sectionId);
        activeTab.classList.remove('bg-transparent', 'text-gray-500');
        activeTab.classList.add('bg-white', 'text-dark', 'shadow-sm');
    }
    function previewHeroImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('hero-preview');
                const placeholder = document.getElementById('hero-placeholder');
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Stats Management
        const statsContainer = document.getElementById('stats-container');
        const addStatBtn = document.getElementById('add-stat');
        
        // Remove stat item
        statsContainer.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-stat');
            if (removeBtn) {
                const item = removeBtn.closest('.stat-item');
                if (statsContainer.querySelectorAll('.stat-item').length > 1) {
                    item.remove();
                    reindexStats();
                } else {
                    alert('Minimal harus ada 1 data statistik.');
                }
            }
        });

        // Add stat item
        addStatBtn.addEventListener('click', function() {
            const count = statsContainer.querySelectorAll('.stat-item').length;
            const newItem = document.createElement('div');
            newItem.className = 'flex items-center gap-3 stat-item';
            newItem.innerHTML = `
                <div class="flex-1">
                    <input type="text" name="content[stats][${count}][number]" placeholder="Angka" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm font-bold">
                </div>
                <div class="flex-[2]">
                    <input type="text" name="content[stats][${count}][label]" placeholder="Label" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm">
                </div>
                <button type="button" class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors remove-stat">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            statsContainer.appendChild(newItem);
        });

        function reindexStats() {
            const items = statsContainer.querySelectorAll('.stat-item');
            items.forEach((item, index) => {
                const numberInput = item.querySelector('input[name^="content[stats]"][name$="[number]"]');
                const labelInput = item.querySelector('input[name^="content[stats]"][name$="[label]"]');
                if (numberInput) numberInput.name = `content[stats][${index}][number]`;
                if (labelInput) labelInput.name = `content[stats][${index}][label]`;
            });
        }

        // Fields Management
        const fieldsContainer = document.getElementById('fields-container');
        const addFieldBtn = document.getElementById('add-field');

        // Handle field type change to show/hide options
        fieldsContainer.addEventListener('change', function(e) {
            if (e.target.classList.contains('field-type')) {
                const optionsContainer = e.target.closest('.field-item').querySelector('.field-options-container');
                if (e.target.value === 'select') {
                    optionsContainer.classList.remove('hidden');
                } else {
                    optionsContainer.classList.add('hidden');
                }
            }
        });

        // Remove field item
        fieldsContainer.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-field');
            if (removeBtn) {
                removeBtn.closest('.field-item').remove();
                reindexFields();
            }
        });

        addFieldBtn.addEventListener('click', function() {
            const count = fieldsContainer.querySelectorAll('.field-item').length;
            const uniqueName = 'custom_' + Date.now();
            
            const newItem = document.createElement('div');
            newItem.className = 'field-item bg-white p-6 rounded-2xl border border-gray-100 shadow-sm relative group transition-all hover:border-primary/20 hover:shadow-md';
            newItem.innerHTML = `
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold field-number">${count + 1}</div>
                        <span class="text-sm font-bold text-gray-700">Pengaturan Pertanyaan</span>
                    </div>
                    <button type="button" class="text-red-500 hover:bg-red-50 hover:text-red-600 px-3 py-1.5 rounded-lg transition-colors remove-field flex items-center gap-1.5 text-xs font-bold border border-transparent hover:border-red-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="hidden">
                        <input type="hidden" name="content[form_fields][${count}][is_fixed]" value="0">
                        <input type="text" name="content[form_fields][${count}][name]" value="${uniqueName}" class="field-name">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Label Pertanyaan</label>
                        <input type="text" name="content[form_fields][${count}][label]" placeholder="Contoh: Domisili" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm bg-white" required>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Tipe</label>
                        <div class="relative custom-dropdown-container">
                            <input type="hidden" name="content[form_fields][${count}][type]" class="field-type" value="text">
                            
                            <button type="button" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-left flex justify-between items-center dropdown-trigger focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                                <span class="dropdown-selected-text text-gray-700">Teks Pendek</span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <div class="absolute z-10 w-full mt-1 bg-white rounded-xl shadow-lg border border-gray-100 py-2 hidden dropdown-menu opacity-0 transition-opacity duration-200 top-full left-0 overflow-hidden">
                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item bg-primary/10 text-primary font-bold hover:bg-gray-50" data-value="text" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Teks Pendek</button>
                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item text-gray-700 hover:bg-gray-50" data-value="textarea" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Teks Panjang</button>
                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item text-gray-700 hover:bg-gray-50" data-value="email" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Email</button>
                                <button type="button" class="w-full text-left px-4 py-3 text-sm transition-colors dropdown-item text-gray-700 hover:bg-gray-50" data-value="select" data-active-class="bg-primary/10 text-primary font-bold" data-hover-class="hover:bg-gray-50">Pilihan (Dropdown)</button>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 field-options-container hidden">
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Pilihan (Pisahkan dengan koma)</label>
                        <input type="text" name="content[form_fields][${count}][options]" placeholder="Contoh: Pilihan 1, Pilihan 2, Pilihan 3" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm bg-white">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Placeholder teks (opsional)</label>
                        <input type="text" name="content[form_fields][${count}][placeholder]" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 outline-none text-sm bg-white">
                    </div>
                    
                    <div class="md:col-span-2 flex items-center gap-2 mt-2">
                        <input type="hidden" name="content[form_fields][${count}][required]" value="0">
                        <input type="checkbox" name="content[form_fields][${count}][required]" value="1" id="req-${count}" class="w-4 h-4 text-primary rounded border-gray-300">
                        <label for="req-${count}" class="text-sm text-gray-700">Wajib Diisi</label>
                    </div>
                </div>
            `;
            fieldsContainer.appendChild(newItem);
        });

        function reindexFields() {
            const items = fieldsContainer.querySelectorAll('.field-item');
            items.forEach((item, index) => {
                const inputs = item.querySelectorAll('input[name^="content[form_fields]"], select[name^="content[form_fields]"]');
                inputs.forEach(input => {
                    input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                });
                
                const checkbox = item.querySelector('input[type="checkbox"]');
                const label = item.querySelector('label[for^="req-"]');
                if (checkbox && label) {
                    checkbox.id = `req-${index}`;
                    label.setAttribute('for', `req-${index}`);
                }
                
                const fieldNumber = item.querySelector('.field-number');
                if (fieldNumber) {
                    fieldNumber.textContent = index + 1;
                }
            });
        }

        // Custom Dropdown UI Logic
        document.addEventListener('click', function(e) {
            // Close all dropdowns if clicking outside
            if (!e.target.closest('.custom-dropdown-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                    menu.classList.remove('opacity-100');
                    menu.classList.add('opacity-0');
                });
                document.querySelectorAll('.dropdown-trigger svg').forEach(svg => {
                    svg.style.transform = 'rotate(0deg)';
                });
            }

            // Handle trigger click
            const trigger = e.target.closest('.dropdown-trigger');
            if (trigger) {
                const container = trigger.closest('.custom-dropdown-container');
                const menu = container.querySelector('.dropdown-menu');
                const svg = trigger.querySelector('svg');
                
                const isHidden = menu.classList.contains('hidden');
                
                // Close all others
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    m.classList.add('hidden');
                    m.classList.remove('opacity-100');
                    m.classList.add('opacity-0');
                });
                document.querySelectorAll('.dropdown-trigger svg').forEach(s => {
                    s.style.transform = 'rotate(0deg)';
                });

                // Toggle current
                if (isHidden) {
                    menu.classList.remove('hidden');
                    setTimeout(() => {
                        menu.classList.remove('opacity-0');
                        menu.classList.add('opacity-100');
                    }, 10);
                    svg.style.transform = 'rotate(180deg)';
                }
            }

            // Handle item click
            const item = e.target.closest('.dropdown-item');
            if (item) {
                const container = item.closest('.custom-dropdown-container');
                const input = container.querySelector('.field-type');
                const textSpan = container.querySelector('.dropdown-selected-text');
                const menu = container.querySelector('.dropdown-menu');
                const svg = container.querySelector('.dropdown-trigger svg');
                
                // Update value
                const val = item.getAttribute('data-value');
                input.value = val;
                textSpan.textContent = item.textContent;
                
                // Update active classes
                container.querySelectorAll('.dropdown-item').forEach(i => {
                    i.className = 'w-full text-left px-4 py-3 text-sm transition-colors dropdown-item text-gray-700 ' + i.getAttribute('data-hover-class');
                });
                
                // Add active class
                const activeColor = item.getAttribute('data-active-class');
                item.className = 'w-full text-left px-4 py-3 text-sm transition-colors dropdown-item font-bold ' + activeColor + ' ' + item.getAttribute('data-hover-class');
                
                // Update textSpan color classes
                textSpan.className = 'dropdown-selected-text text-gray-700';
                
                // Close menu
                menu.classList.add('hidden');
                menu.classList.remove('opacity-100');
                menu.classList.add('opacity-0');
                svg.style.transform = 'rotate(0deg)';
                
                // Fire change event
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    });
</script>
@endsection
