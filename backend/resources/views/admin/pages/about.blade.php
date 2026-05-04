@extends('layouts.admin')

@section('content')
    <div class="space-y-8">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <h1 class="text-xl lg:text-3xl font-bold text-dark">Manajemen Halaman Tentang Kami</h1>
                <p class="text-gray-400 text-[10px] lg:text-base mt-1">Kelola konten visual dan teks untuk halaman Tentang Kami.</p>
            </div>
            <div class="shrink-0 bg-primary/10 text-primary px-3 lg:px-4 py-1.5 lg:py-2 rounded-xl text-[10px] lg:text-sm font-semibold border border-primary/20 whitespace-nowrap">
                Halaman Aktif
            </div>
        </div>


        <div id="dynamic-alerts"></div>

        @if(session('success'))
            <div id="alert-success" class="bg-primary text-white p-4 rounded-2xl shadow-lg shadow-primary/20 flex items-center justify-between gap-3 animate-bounce">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="alert-error" class="bg-red-500 text-white p-4 rounded-2xl shadow-lg shadow-red-500/20 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-error').remove()" class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <x-admin.delete-modal id="modal-delete-image" action="js" title="Hapus Gambar" message="Apakah Anda yakin ingin menghapus gambar ini? Perubahan akan disimpan saat Anda menekan tombol Simpan Perubahan." />

    <div class="grid grid-cols-1 xl:grid-cols-4 gap-4 lg:gap-8">
            <!-- Sidebar Navigation (Tabs) -->
            <div
                class="xl:col-span-1 flex xl:flex-col gap-2 overflow-x-auto pb-4 xl:pb-0 xl:space-y-2 xl:sticky xl:self-start xl:top-8 bg-transparent xl:bg-white xl:p-4 xl:rounded-[2rem] xl:shadow-xl xl:border xl:border-white hide-scrollbar">
                <button onclick="showSection('hero')" id="tab-hero"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-white text-dark shadow-sm hover:shadow-md border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-left">Hero Section</span>
                </button>
                <button onclick="showSection('mengenal')" id="tab-mengenal"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-left">Mengenal Lebih Dekat</span>
                </button>
                <button onclick="showSection('kepengurusan')" id="tab-kepengurusan"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="text-left">Struktur Organisasi</span>
                </button>
                <button onclick="showSection('stats')" id="tab-stats"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-left">Dampak Penyaluran</span>
                </button>
                <button onclick="showSection('value')" id="tab-value"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-left">Amanah (Value)</span>
                </button>
                <button onclick="showSection('penghargaan')" id="tab-penghargaan"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <span class="text-left">Penghargaan</span>
                </button>
            </div>

            <!-- Content Area -->
            <div class="xl:col-span-3">
                <div class="bg-white rounded-[2.5rem] p-4 sm:p-10 shadow-xl border border-white relative">

                    {{-- Form Hero --}}
                    <div id="section-hero" class="content-section">
                        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="hero">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Konten Hero</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola gambar latar dan teks kutipan utama.</p>
                                </div>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php $heroData = $hero ? $hero->content : ['title' => '', 'name' => '', 'position' => '', 'quote' => '', 'image' => '']; @endphp
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block font-bold mb-2">Judul Kutipan Utama</label>
                                        <textarea name="content[title]" rows="3"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none" placeholder="Hal paling sia-sia adalah...">{{ $heroData['title'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2">Nama Tokoh</label>
                                        <input type="text" name="content[name]" value="{{ $heroData['name'] ?? '' }}" placeholder="H. SLAMET BUDIONO..."
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2">Posisi (Jabatan)</label>
                                        <input type="text" name="content[position]" value="{{ $heroData['position'] ?? '' }}" placeholder="FOUNDER & CEO..."
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold mb-2">Deskripsi Kutipan</label>
                                        <textarea name="content[quote]" rows="3"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none" placeholder="Semangat kami adalah memastikan...">{{ $heroData['quote'] ?? '' }}</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold mb-2">Gambar Background Hero</label>
                                        <div class="relative aspect-[21/9] bg-gray-100 rounded-2xl overflow-hidden border border-gray-200">
                                            @if(!empty($heroData['image']))
                                                <img src="{{ $heroData['image'] }}" class="w-full h-full object-cover">
                                                <input type="hidden" name="existing_image" value="{{ $heroData['image'] }}">
                                            @else
                                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <span class="text-sm">Belum ada gambar</span>
                                                </div>
                                                <input type="hidden" name="existing_image" value="">
                                            @endif
                                            <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-all flex items-center justify-center">
                                                <label class="cursor-pointer bg-white text-dark px-4 py-2 rounded-xl font-bold shadow-lg hover:scale-105 transition-transform text-sm">
                                                    Ganti Gambar
                                                    <input type="file" name="new_image" accept="image/*" class="hidden" onchange="validateAndSubmit(this)">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Form Statistik --}}
                    <div id="section-stats" class="content-section hidden">
                        <form action="{{ route('admin.about.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="stats">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Data Statistik</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola angka dampak penyaluran dan deskripsinya.</p>
                                </div>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php $statsData = $stats ? $stats->content : ['wilayah_count' => '47', 'wilayah_desc' => '', 'penerima_count' => '102.088', 'penerima_desc' => '', 'aksi_count' => '19', 'aksi_desc' => '']; @endphp
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block font-bold mb-2 text-primary">Angka Wilayah Jangkauan</label>
                                        <input type="text" name="content[wilayah_count]" value="{{ $statsData['wilayah_count'] ?? '' }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none font-bold text-xl">
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2">Deskripsi Wilayah (Popup Modal)</label>
                                        <textarea name="content[wilayah_desc]" rows="2"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">{{ $statsData['wilayah_desc'] ?? '' }}</textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block font-bold mb-2 text-primary">Angka Penerima Manfaat</label>
                                        <input type="text" name="content[penerima_count]" value="{{ $statsData['penerima_count'] ?? '' }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none font-bold text-xl">
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2">Deskripsi Penerima Manfaat (Popup Modal)</label>
                                        <textarea name="content[penerima_desc]" rows="2"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">{{ $statsData['penerima_desc'] ?? '' }}</textarea>
                                    </div>
                                    
                                    <div>
                                        <label class="block font-bold mb-2 text-primary">Angka Aksi Kebaikan</label>
                                        <input type="text" name="content[aksi_count]" value="{{ $statsData['aksi_count'] ?? '' }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none font-bold text-xl">
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2">Deskripsi Aksi Kebaikan (Popup Modal)</label>
                                        <textarea name="content[aksi_desc]" rows="2"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">{{ $statsData['aksi_desc'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    {{-- Form Value --}}
                    <div id="section-value" class="content-section hidden">
                        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="value">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Konten Amanah / Value</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola judul, deskripsi, dan gambar pada bagian nilai utama.</p>
                                </div>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php $valueData = $value ? $value->content : ['title' => '', 'desc' => '', 'image' => '']; @endphp
                            <div class="space-y-6">
                                <div>
                                    <label class="block font-bold mb-2">Judul (Contoh: Kepuasan Anda adalah Amanah Kami)</label>
                                    <input type="text" name="content[title]" value="{{ $valueData['title'] ?? '' }}"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block font-bold mb-2">Deskripsi</label>
                                    <textarea name="content[desc]" rows="4"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">{{ $valueData['desc'] ?? '' }}</textarea>
                                </div>
                                
                                <div>
                                    <label class="block font-bold mb-2 text-sm text-gray-600">Gambar Value (Sebelah Kiri)</label>
                                    <div class="relative w-full max-w-[280px] aspect-[4/3] group mt-4">
                                        <div class="w-full h-full bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm relative">
                                            @if(!empty($valueData['image']))
                                                <img id="preview-value" src="{{ $valueData['image'] }}" class="w-full h-full object-cover">
                                                <input type="hidden" name="existing_image" id="existing-image-value" value="{{ $valueData['image'] }}">
                                            @else
                                                <div id="placeholder-value" class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <span class="text-sm">Belum ada gambar</span>
                                                </div>
                                                <input type="hidden" name="existing_image" id="existing-image-value" value="">
                                            @endif
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                                <label class="cursor-pointer bg-white text-dark px-4 py-2 rounded-xl font-bold shadow-lg hover:scale-105 transition-transform text-sm">
                                                    Ganti Gambar
                                                    <input type="file" name="new_image" id="input-image-value" accept="image/*" class="hidden" onchange="previewValueImage(this)">
                                                </label>
                                            </div>
                                        </div>

                                        <input type="hidden" name="remove_image_value" id="remove-image-value" value="0">
                                        
                                        @if(!empty($valueData['image']))
                                            <button type="button" id="btn-remove-value" onclick="removeValueImage()" class="absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-all z-20 opacity-0 group-hover:opacity-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Form Mengenal Lebih Dekat --}}
                    <div id="section-mengenal" class="content-section hidden">
                        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="mengenal">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Mengenal Lebih Dekat</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola konten Sejarah, Visi Misi, Legalitas, dan Profile.</p>
                                </div>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php
                                $mengenalData = isset($mengenal) && $mengenal ? $mengenal->content : [];
                                $mengenalTabs = ['Sejarah', 'Visi Misi', 'Legalitas', 'Profile'];
                            @endphp
                            <div class="space-y-6">
                                <div class="flex border-b border-gray-200 overflow-x-auto" id="mengenal-tabs">
                                    @foreach($mengenalTabs as $tab)
                                        <button type="button" onclick="showMengenalTab('{{ Str::slug($tab) }}')" class="px-6 py-3 font-semibold whitespace-nowrap {{ $loop->first ? 'text-primary border-b-2 border-primary' : 'text-gray-500 hover:text-primary' }}" id="btn-mengenal-{{ Str::slug($tab) }}">{{ $tab }}</button>
                                    @endforeach
                                </div>

                                @foreach($mengenalTabs as $tab)
                                    <div id="mengenal-content-{{ Str::slug($tab) }}" class="mengenal-tab-content {{ $loop->first ? '' : 'hidden' }} bg-gray-50 border border-gray-100 rounded-b-2xl p-6">
                                        @if($tab === 'Sejarah')
                                            <div class="mb-6">
                                                <label class="block font-bold mb-2 text-sm text-gray-600">Gambar Sejarah</label>
                                                <div class="relative w-full max-w-md aspect-video group mt-4">
                                                    <div class="w-full h-full bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm relative">
                                                        @if(!empty($mengenalData[$tab]['image']))
                                                            <img id="preview-sejarah" src="{{ $mengenalData[$tab]['image'] }}" class="w-full h-full object-cover">
                                                            <input type="hidden" name="content[{{ $tab }}][existing_image]" id="existing-image-sejarah" value="{{ $mengenalData[$tab]['image'] }}">
                                                        @else
                                                            <div id="placeholder-sejarah" class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                <span class="text-xs font-medium">Belum ada gambar sejarah</span>
                                                            </div>
                                                            <input type="hidden" name="content[{{ $tab }}][existing_image]" id="existing-image-sejarah" value="">
                                                        @endif
                                                        
                                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                                            <label class="cursor-pointer bg-white text-dark px-5 py-2.5 rounded-xl font-bold shadow-xl hover:scale-105 transition-transform text-sm">
                                                                Pilih Gambar Sejarah
                                                                <input type="file" name="new_image_sejarah" id="input-image-sejarah" accept="image/*" class="hidden" onchange="previewSejarahImage(this)">
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="remove_image_sejarah" id="remove-image-sejarah" value="0">
                                                    
                                                    @if(!empty($mengenalData[$tab]['image']))
                                                        <button type="button" id="btn-remove-sejarah" onclick="removeSejarahImage()" class="absolute -top-3 -right-3 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-all z-20 opacity-0 group-hover:opacity-100">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <label class="block font-bold mb-2 text-sm text-gray-600">Konten Teks</label>
                                            <textarea name="content[{{ $tab }}][text]" rows="10" class="rich-text w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary transition-all outline-none text-sm">{{ $mengenalData[$tab]['text'] ?? ($mengenalData[$tab]['topText'] ?? '') }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div id="section-kepengurusan" class="content-section hidden">
                        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="kepengurusan">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Struktur Organisasi</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola anggota kepengurusan (Tambah, Edit, Hapus).</p>
                                </div>
                                <button type="submit" class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan Perubahan</button>
                            </div>

                            @php
                                $kepengurusanObj = isset($kepengurusan) && $kepengurusan ? $kepengurusan->content : [];
                                // Convert to sequential array for easy editing
                                $kepengurusanData = [];
                                foreach ($kepengurusanObj as $catName => $members) {
                                    $kepengurusanData[] = [
                                        'category' => $catName,
                                        'members' => $members
                                    ];
                                }
                            @endphp

                            <div id="container-kategori-kepengurusan" class="space-y-6">
                                @foreach($kepengurusanData as $catIndex => $category)
                                    <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 relative group/cat">
                                        <div class="flex items-center gap-4 mb-4">
                                            <input type="text" name="content[{{ $catIndex }}][category]" value="{{ $category['category'] }}" placeholder="Nama Dewan (contoh: Dewan Direksi)" class="font-bold text-lg text-primary bg-white border border-gray-200 px-4 py-2 rounded-xl focus:border-primary outline-none flex-1">
                                            <button type="button" onclick="this.closest('.bg-gray-50').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors border border-red-100" title="Hapus Kategori Dewan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </div>
                                        
                                        <div id="container-member-{{ $catIndex }}" class="space-y-4">
                                            @foreach($category['members'] as $memIndex => $member)
                                                <div class="flex gap-4 items-start bg-white p-4 rounded-xl border border-gray-200">
                                                    <div class="w-32 flex-shrink-0">
                                                        <div class="relative aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200 group">
                                                            @if(!empty($member['image']))
                                                                <img src="{{ $member['image'] }}" class="w-full h-full object-cover">
                                                            @else
                                                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                </div>
                                                            @endif
                                                            <input type="hidden" name="content[{{ $catIndex }}][members][{{ $memIndex }}][existing_image]" value="{{ $member['image'] ?? '' }}">
                                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                                                <label class="cursor-pointer text-white text-xs font-bold text-center w-full h-full flex flex-col items-center justify-center">
                                                                    Ganti<br>Gambar
                                                                    <input type="file" name="new_images[{{ $catIndex }}][members][{{ $memIndex }}]" class="hidden" accept="image/*" onchange="previewMemberImage(this)">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 space-y-3">
                                                        <input type="text" name="content[{{ $catIndex }}][members][{{ $memIndex }}][name]" value="{{ $member['name'] ?? '' }}" placeholder="Nama Lengkap" class="w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 focus:border-primary outline-none text-sm">
                                                        <input type="text" name="content[{{ $catIndex }}][members][{{ $memIndex }}][role]" value="{{ $member['role'] ?? '' }}" placeholder="Posisi/Jabatan" class="w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 focus:border-primary outline-none text-sm">
                                                    </div>
                                                    <button type="button" onclick="this.closest('.flex.gap-4').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" onclick="addMember({{ $catIndex }})" class="mt-4 flex items-center gap-2 text-sm font-bold text-primary hover:text-dark transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            Tambah Anggota
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" onclick="addKategoriDewan()" class="mt-6 flex items-center justify-center w-full gap-2 text-sm font-bold text-primary border-2 border-dashed border-primary/30 rounded-xl py-4 hover:bg-primary/5 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Kategori Dewan (Section Baru)
                            </button>
                        </form>
                    </div>

                    {{-- Form Penghargaan --}}
                    <div id="section-penghargaan" class="content-section hidden">
                        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="penghargaan">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Penghargaan</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola daftar gambar penghargaan Taman Zakat.</p>
                                </div>
                                <button type="submit" class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan Perubahan</button>
                            </div>

                            @php
                                $penghargaanData = isset($penghargaan) && $penghargaan ? $penghargaan->content : [];
                            @endphp

                            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6">
                                <div id="container-penghargaan" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @php $awards = $penghargaan ? $penghargaan->content : []; @endphp
                                    @foreach($awards as $index => $award)
                                        <div class="relative bg-white p-4 rounded-xl border border-gray-200 group">
                                            <div class="relative aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                                @if(!empty($award['image']))
                                                    <img src="{{ $award['image'] }}" class="w-full h-full object-cover">
                                                    <input type="hidden" name="content[{{ $index }}][existing_image]" value="{{ $award['image'] }}">
                                                @else
                                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                        <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                    <input type="hidden" name="content[{{ $index }}][existing_image]" value="">
                                                @endif
                                                <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-all flex items-center justify-center">
                                                    <label class="cursor-pointer text-white text-xs font-bold text-center w-full h-full flex flex-col items-center justify-center">Ganti Gambar
                                                        <input type="file" name="new_images[{{ $index }}]" class="hidden" accept="image/*" onchange="previewMemberImage(this)">
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="content[{{ $index }}][title]" value="{{ $award['title'] ?? '' }}">
                                            <input type="hidden" name="content[{{ $index }}][year]" value="{{ $award['year'] ?? '' }}">
                                            <button type="button" onclick="this.closest('.relative.bg-white').remove()" class="absolute -top-3 -right-3 bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addPenghargaan()" class="mt-6 flex items-center justify-center w-full gap-2 text-sm font-bold text-primary border-2 border-dashed border-primary/30 rounded-xl py-4 hover:bg-primary/5 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Tambah Gambar Penghargaan
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(id) {
            document.querySelectorAll('.content-section').forEach(el => el.classList.add('hidden'));
            document.getElementById('section-' + id).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-dark', 'shadow-sm');
                btn.classList.add('bg-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById('tab-' + id);
            activeBtn.classList.remove('bg-transparent', 'text-gray-500');
            activeBtn.classList.add('bg-white', 'text-dark', 'shadow-sm');
        }

        function showMengenalTab(tabId) {
            document.querySelectorAll('.mengenal-tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('mengenal-content-' + tabId).classList.remove('hidden');

            document.querySelectorAll('#mengenal-tabs button').forEach(btn => {
                btn.classList.remove('text-primary', 'border-b-2', 'border-primary');
                btn.classList.add('text-gray-500');
            });
            const activeBtn = document.getElementById('btn-mengenal-' + tabId);
            activeBtn.classList.remove('text-gray-500');
            activeBtn.classList.add('text-primary', 'border-b-2', 'border-primary');
        }

        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab) {
                showSection(tab);
            }
        });

        function addKategoriDewan() {
            const container = document.getElementById('container-kategori-kepengurusan');
            const catIndex = Date.now() + Math.floor(Math.random() * 1000);
            
            const html = `
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 relative group/cat">
                    <div class="flex items-center gap-4 mb-4">
                        <input type="text" name="content[${catIndex}][category]" placeholder="Nama Dewan (contoh: Dewan Direksi)" class="font-bold text-lg text-primary bg-white border border-gray-200 px-4 py-2 rounded-xl focus:border-primary outline-none flex-1">
                        <button type="button" onclick="this.closest('.bg-gray-50').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors border border-red-100" title="Hapus Kategori Dewan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                    
                    <div id="container-member-${catIndex}" class="space-y-4">
                        <!-- Anggota kosong, tunggu ditambahkan -->
                    </div>
                    <button type="button" onclick="addMember(${catIndex})" class="mt-4 flex items-center gap-2 text-sm font-bold text-primary hover:text-dark transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Anggota
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addMember(catIndex) {
            const container = document.getElementById('container-member-' + catIndex);
            const memIndex = Date.now() + Math.floor(Math.random() * 1000);
            
            const html = `
                <div class="flex gap-4 items-start bg-white p-4 rounded-xl border border-gray-200">
                    <div class="w-32 flex-shrink-0">
                        <div class="relative aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="hidden" name="content[${catIndex}][members][${memIndex}][existing_image]" value="">
                            <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-all flex items-center justify-center">
                                <label class="cursor-pointer text-white text-xs font-bold text-center">Ganti<br>Gambar
                                    <input type="file" name="new_images[${catIndex}][members][${memIndex}]" class="hidden" accept="image/*" onchange="previewMemberImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 space-y-3">
                        <input type="text" name="content[${catIndex}][members][${memIndex}][name]" placeholder="Nama Lengkap" class="w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 focus:border-primary outline-none text-sm">
                        <input type="text" name="content[${catIndex}][members][${memIndex}][role]" placeholder="Posisi/Jabatan" class="w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-100 focus:border-primary outline-none text-sm">
                    </div>
                    <button type="button" onclick="this.closest('.flex.gap-4').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function addPenghargaan() {
            const container = document.getElementById('container-penghargaan');
            const index = Date.now() + Math.floor(Math.random() * 1000);
            const html = `
                <div class="relative bg-white p-4 rounded-xl border border-gray-200 group">
                    <div class="relative aspect-square bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="hidden" name="content[${index}][existing_image]" value="">
                        <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-all flex items-center justify-center">
                            <label class="cursor-pointer text-white text-xs font-bold text-center w-full h-full flex flex-col items-center justify-center">Ganti Gambar
                                <input type="file" name="new_images[${index}]" class="hidden" accept="image/*" onchange="previewMemberImage(this)">
                            </label>
                        </div>
                    </div>
                    <button type="button" onclick="this.closest('.relative.bg-white').remove()" class="absolute -top-3 -right-3 bg-red-500 text-white p-1.5 rounded-full hover:bg-red-600 transition-colors shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function previewMemberImage(input) {
            if (input.files && input.files[0]) {
                if (!validateFileSize(input)) return;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = input.closest('.relative');
                    let img = imgContainer.querySelector('img');
                    const placeholder = imgContainer.querySelector('.text-gray-400');
                    
                    if (placeholder) placeholder.remove();
                    
                    if (!img) {
                        img = document.createElement('img');
                        img.className = 'w-full h-full object-cover';
                        imgContainer.prepend(img);
                    }
                    img.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewSejarahImage(input) {
            if (input.files && input.files[0]) {
                if (!validateFileSize(input)) return;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = input.closest('.relative');
                    let img = container.querySelector('#preview-sejarah');
                    const placeholder = container.querySelector('#placeholder-sejarah');
                    
                    if (placeholder) placeholder.remove();
                    
                    if (!img) {
                        img = document.createElement('img');
                        img.id = 'preview-sejarah';
                        img.className = 'w-full h-full object-cover';
                        container.prepend(img);
                    }
                    img.src = e.target.result;
                    document.getElementById('remove-image-sejarah').value = '0';
                    
                    // Show delete button
                    const btnRemove = document.getElementById('btn-remove-sejarah');
                        if (btnRemove) {
                            btnRemove.classList.remove('hidden');
                        } else {
                            // Create it if it doesn't exist
                            const btn = document.createElement('button');
                            btn.type = 'button';
                            btn.id = 'btn-remove-sejarah';
                            btn.onclick = removeSejarahImage;
                            btn.className = 'absolute -top-3 -right-3 bg-red-500 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-all z-20 opacity-0 group-hover:opacity-100';
                            btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>';
                            container.appendChild(btn);
                        }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeSejarahImage() {
            openDeleteModal('modal-delete-image', 'executeRemoveSejarahImage()');
        }

        function executeRemoveSejarahImage() {
            const container = document.querySelector('#preview-sejarah')?.closest('.relative');
            if (container) {
                const img = container.querySelector('#preview-sejarah');
                if (img) img.remove();
                
                const input = document.getElementById('input-image-sejarah');
                if (input) input.value = '';
                
                const existingInput = document.getElementById('existing-image-sejarah');
                if (existingInput) existingInput.value = '';
                
                const removeInput = document.getElementById('remove-image-sejarah');
                if (removeInput) removeInput.value = '1';

                const btnRemove = document.getElementById('btn-remove-sejarah');
                if (btnRemove) btnRemove.remove();

                // Add placeholder back
                const html = `
                    <div id="placeholder-sejarah" class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-xs font-medium">Belum ada gambar sejarah</span>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', html);
            }
        }

        function previewValueImage(input) {
            if (input.files && input.files[0]) {
                if (!validateFileSize(input)) return;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = input.closest('.relative');
                    let img = container.querySelector('#preview-value');
                    const placeholder = container.querySelector('#placeholder-value');
                    
                    if (placeholder) placeholder.remove();
                    
                    if (!img) {
                        img = document.createElement('img');
                        img.id = 'preview-value';
                        img.className = 'w-full h-full object-cover';
                        container.prepend(img);
                    }
                    img.src = e.target.result;
                    document.getElementById('remove-image-value').value = '0';
                    
                    // Show delete button
                    const btnRemove = document.getElementById('btn-remove-value');
                    if (btnRemove) {
                        btnRemove.classList.remove('hidden');
                    } else {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.id = 'btn-remove-value';
                        btn.onclick = removeValueImage;
                        btn.className = 'absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-all z-20 opacity-0 group-hover:opacity-100';
                        btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>';
                        container.appendChild(btn);
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeValueImage() {
            openDeleteModal('modal-delete-image', 'executeRemoveValueImage()');
        }

        function executeRemoveValueImage() {
            const container = document.querySelector('#preview-value')?.closest('.relative');
            if (container) {
                const img = container.querySelector('#preview-value');
                if (img) img.remove();
                
                const input = document.getElementById('input-image-value');
                if (input) input.value = '';
                
                const existingInput = document.getElementById('existing-image-value');
                if (existingInput) existingInput.value = '';
                
                const removeInput = document.getElementById('remove-image-value');
                if (removeInput) removeInput.value = '1';

                const btnRemove = document.getElementById('btn-remove-value');
                if (btnRemove) btnRemove.remove();

                // Add placeholder back
                const html = `
                    <div id="placeholder-value" class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-sm">Belum ada gambar</span>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', html);
            }
        }

        function validateFileSize(input) {
            if (input.files && input.files[0]) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (input.files[0].size > maxSize) {
                    showToast('Maaf, file Anda terlalu besar! Maksimal ukuran file adalah 2MB.', 'error');
                    input.value = ''; // Reset input
                    return false;
                }
            }
            return true;
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('dynamic-alerts');
            const id = 'toast-' + Date.now();
            const bgColor = type === 'success' ? 'bg-primary' : 'bg-red-500';
            const shadowColor = type === 'success' ? 'shadow-primary/20' : 'shadow-red-500/20';
            const icon = type === 'success' 
                ? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
                : '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';

            const html = `
                <div id="${id}" class="${bgColor} text-white p-4 rounded-2xl shadow-lg ${shadowColor} flex items-center justify-between gap-3 mb-6 animate-slide-down">
                    <div class="flex items-center gap-3">
                        ${icon}
                        <span class="font-medium">${message}</span>
                    </div>
                    <button type="button" onclick="document.getElementById('${id}').remove()" class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            `;
            container.innerHTML = html;
            
            // Auto scroll to top
            scrollToTop();

            // Auto hide after 5 seconds
            setTimeout(() => {
                const el = document.getElementById(id);
                if (el) el.remove();
            }, 5000);
        }

        function scrollToTop() {
            const area = document.getElementById('main-content-area');
            if (area) {
                area.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        // Auto scroll to top on page load if alert exists
        window.addEventListener('DOMContentLoaded', () => {
            @if(session('active_tab'))
                showSection('{{ session('active_tab') }}');
            @endif

            if (document.getElementById('alert-success') || document.getElementById('alert-error')) {
                scrollToTop();
            }
        });

        function validateAndSubmit(input) {
            if (validateFileSize(input)) {
                input.form.submit();
            }
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        document.querySelectorAll('.rich-text').forEach(textarea => {
            ClassicEditor
                .create(textarea, {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        textarea.value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
        /* Sembunyikan Logo CKEditor */
        .ck-powered-by {
            display: none !important;
        }
        @keyframes slide-down {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-down {
            animation: slide-down 0.3s ease-out;
        }
    </style>
@endsection
