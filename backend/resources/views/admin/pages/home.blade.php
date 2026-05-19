@extends('layouts.admin')

@section('content')
    <div class="space-y-8">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <h1 class="text-xl lg:text-3xl font-bold text-dark">Manajemen Halaman Home</h1>
                <p class="text-gray-400 text-[10px] lg:text-base mt-1">Kelola konten visual dan teks untuk halaman utama
                    website.</p>
            </div>
        </div>

        @if(session('success'))
            <div id="alert-success"
                class="bg-primary text-white p-4 rounded-2xl shadow-lg shadow-primary/20 flex items-center justify-between gap-3 animate-bounce">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-success').remove()"
                    class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="alert-error"
                class="bg-red-500 text-white p-4 rounded-2xl shadow-lg shadow-red-500/20 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="document.getElementById('alert-error').remove()"
                    class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

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
                    <span class="text-left">Hero Slider</span>
                </button>
                <button onclick="showSection('programs')" id="tab-programs"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="text-left">Program</span>
                </button>
                <button onclick="showSection('about')" id="tab-about"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-left">Tentang Kami</span>
                </button>
                <button onclick="showSection('stats')" id="tab-stats"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="text-left">Statistik & Map</span>
                </button>
                <button onclick="showSection('cta')" id="tab-cta"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.167H3.38a1.345 1.345 0 01-1.35-1.157 1.346 1.346 0 011.127-1.493l2.229-.351 1.633-4.667a1.76 1.76 0 013.417.592c0 .324-.132.628-.352.88zM15.424 7.21a1.042 1.042 0 011.41 0c2.56 2.56 2.56 6.71 0 9.27a1.042 1.042 0 11-1.41-1.41c1.78-1.78 1.78-4.67 0-6.45a1.042 1.042 0 010-1.41z" />
                    </svg>
                    <span class="text-left">CTA Kebaikan</span>
                </button>
                <button onclick="showSection('testimoni')" id="tab-testimoni"
                    class="tab-btn flex-shrink-0 xl:w-full flex items-center gap-3 px-6 py-4 rounded-2xl transition-all font-semibold bg-transparent text-gray-500 hover:bg-white border border-transparent whitespace-nowrap">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span class="text-left">Testimoni</span>
                </button>
            </div>

            <!-- Content Area -->
            <div class="xl:col-span-3">
                <div class="bg-white rounded-[2.5rem] p-4 sm:p-10 shadow-xl border border-white relative overflow-hidden">

                    {{-- Form Hero Slider --}}
                    <div id="section-hero" class="content-section">
                        <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="hero">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Konten Hero Slider</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Upload gambar ilustrasi untuk
                                        slider utama website.</p>
                                </div>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            <div class="space-y-8">
                                @php $heroData = $hero ? $hero->content : ['images' => []]; @endphp

                                <!-- Grid Gambar Saat Ini -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="hero-preview-container">
                                    @foreach($heroData['images'] ?? [] as $img)
                                        <div
                                            class="group relative aspect-video bg-gray-100 rounded-2xl overflow-hidden border border-gray-200">
                                            <img src="{{ $img }}" class="w-full h-full object-cover">
                                            <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                            <div
                                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                                <button type="button" onclick="this.closest('.relative').remove()"
                                                    class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Upload Box Baru -->
                                    <label id="hero-upload-box"
                                        class="cursor-pointer flex flex-col items-center justify-center aspect-video border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary hover:bg-primary/5 transition-all">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-xs font-bold text-gray-500 mt-2">Tambah Gambar</span>
                                        <input type="file" name="new_images[]" multiple class="hidden"
                                            onchange="previewHeroImages(this)">
                                    </label>
                                </div>

                                <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 flex items-start gap-4">
                                    <div class="bg-blue-500 text-white p-2 rounded-xl shadow-lg shadow-blue-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-blue-900 mb-1">Tips Gambar Responsif</h4>
                                        <p class="text-sm text-blue-700 leading-relaxed">
                                            Agar tampilan tetap rapi di HP maupun Laptop, gunakan gambar dengan dimensi:
                                            <br>
                                            <span class="font-bold">Lebar: 1920px</span> dan <span class="font-bold">Tinggi:
                                                480px - 640px</span> (Rasio 3:1). <br>
                                            Gunakan format <span class="font-bold">SVG</span> atau <span
                                                class="font-bold">PNG Transparan</span> untuk hasil terbaik.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Form Program --}}
                    <div id="section-programs" class="content-section hidden">
                        <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="programs">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <h2 class="text-lg lg:text-2xl font-bold text-dark">Konten Program</h2>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Kelola gambar dan deskripsi untuk 6
                                        kategori program.</p>
                                </div>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php
                                $programsData = $programs ? $programs->content['programs'] ?? [] : [];
                                $defaultCategories = ['Kesehatan', 'Ekonomi', 'Dakwah', 'Sosial', 'Kemanusiaan', 'Pendidikan'];
                            @endphp

                            <div class="space-y-6">
                                @foreach($defaultCategories as $index => $cat)
                                    @php
                                        // Cari data program yang sudah tersimpan atau gunakan default
                                        $prog = collect($programsData)->firstWhere('id', $cat) ?? ['id' => $cat, 'image' => '', 'description' => 'Akses berbagai layanan zakat digital dalam satu pengalaman yang sederhana dan efisien.'];
                                    @endphp
                                    <div class="bg-gray-50 border border-gray-100 p-6 rounded-2xl">
                                        <h3 class="font-bold text-lg text-primary mb-4">{{ $cat }}</h3>
                                        <input type="hidden" name="content[programs][{{ $index }}][id]" value="{{ $cat }}">

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <!-- Image Upload -->
                                            <div class="md:col-span-1">
                                                <label class="block font-bold mb-2 text-sm text-gray-600">Gambar Program</label>
                                                <div
                                                    class="relative aspect-video bg-gray-200 rounded-xl overflow-hidden border border-gray-300 mb-3 group">
                                                    @if($prog['image'])
                                                        <img src="{{ $prog['image'] }}" id="preview-img-{{ $index }}"
                                                            class="w-full h-full object-cover">
                                                        <input type="hidden" id="hidden-img-{{ $index }}"
                                                            name="content[programs][{{ $index }}][image]"
                                                            value="{{ $prog['image'] }}">
                                                        <div id="preview-placeholder-{{ $index }}"
                                                            class="flex items-center justify-center h-full text-gray-400 text-sm hidden">
                                                            Belum ada gambar</div>
                                                    @else
                                                        <div id="preview-placeholder-{{ $index }}"
                                                            class="flex items-center justify-center h-full text-gray-400 text-sm">
                                                            Belum ada gambar</div>
                                                        <img src="" id="preview-img-{{ $index }}"
                                                            class="w-full h-full object-cover hidden">
                                                        <input type="hidden" id="hidden-img-{{ $index }}"
                                                            name="content[programs][{{ $index }}][image]" value="">
                                                    @endif

                                                    <div id="delete-btn-{{ $index }}"
                                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center {{ !$prog['image'] ? 'hidden' : '' }}">
                                                        <button type="button"
                                                            onclick="openDeleteModal('delete-image-modal', 'removeProgramImage(\'{{ $index }}\')')"
                                                            class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all shadow-lg"
                                                            title="Hapus Gambar">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="file" id="file-input-{{ $index }}"
                                                    name="new_program_images[{{ $index }}]" accept="image/*"
                                                    onchange="previewImage(this, '{{ $index }}')"
                                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                                            </div>

                                            <!-- Description -->
                                            <div class="md:col-span-2">
                                                <label class="block font-bold mb-2 text-sm text-gray-600">Deskripsi
                                                    Program</label>
                                                <textarea name="content[programs][{{ $index }}][description]" rows="5"
                                                    class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary transition-all outline-none text-sm">{{ $prog['description'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>

                    {{-- Form Tentang Kami --}}
                    <div id="section-about" class="content-section hidden">
                        <form action="{{ route('admin.home.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="about">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-lg lg:text-2xl font-bold text-dark">Teks Tentang Kami</h2>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php $aboutData = $about ? $about->content : ['title' => '', 'sub' => '', 'desc' => '', 'highlight' => '']; @endphp
                            <div class="space-y-6">
                                <div>
                                    <label class="block font-bold mb-2">Heading Kategori (Contoh: Tentang Kami)</label>
                                    <input type="text" name="content[title]" value="{{ $aboutData['title'] }}"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block font-bold mb-2">Sub-Heading (Contoh: Taman Zakat Indonesia)</label>
                                    <input type="text" name="content[sub]" value="{{ $aboutData['sub'] }}"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block font-bold mb-2">Deskripsi Utama</label>
                                    <textarea name="content[desc]" rows="4"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none">{{ $aboutData['desc'] }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-bold mb-2">Quote/Highlight (Warna Hijau Muda)</label>
                                    <textarea name="content[highlight]" rows="3"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-100/50 border border-primary/20 focus:bg-white focus:border-primary transition-all outline-none">{{ $aboutData['highlight'] }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Form Statistik --}}
                    <div id="section-stats" class="content-section hidden">
                        <form action="{{ route('admin.home.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="stats">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-lg lg:text-2xl font-bold text-dark">Data Statistik Website</h2>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php $statsData = $stats ? $stats->content : ['title' => '', 'desc' => '', 'wilayah' => '', 'manfaat' => '', 'aksi' => '']; @endphp
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <label class="block font-bold mb-2">Heading Section</label>
                                        <input type="text" name="content[title]" value="{{ $statsData['title'] }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block font-bold mb-2">Subheading/Deskripsi</label>
                                        <textarea name="content[desc]" rows="3"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">{{ $statsData['desc'] }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2 text-primary">Wilayah Jangkauan</label>
                                        <input type="text" name="content[wilayah]" value="{{ $statsData['wilayah'] }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none font-bold text-xl">
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2 text-primary">Penerima Manfaat</label>
                                        <input type="text" name="content[manfaat]" value="{{ $statsData['manfaat'] }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none font-bold text-xl">
                                    </div>
                                    <div>
                                        <label class="block font-bold mb-2 text-primary">Aksi Kebaikan</label>
                                        <input type="text" name="content[aksi]" value="{{ $statsData['aksi'] }}"
                                            class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none font-bold text-xl">
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="mt-16 pt-16 border-t border-gray-100">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-2xl font-bold text-dark">Data Map Provinsi</h2>
                                <div
                                    class="bg-primary/10 text-primary px-4 py-2 rounded-xl text-sm font-semibold border border-primary/20">
                                    {{ \App\Models\Province::where('is_active', true)->count() }} Wilayah Aktif
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse whitespace-nowrap">
                                    <thead>
                                        <tr class="border-b border-gray-100">
                                            <th class="p-4 font-bold text-gray-500 text-sm uppercase tracking-wider">
                                                Provinsi</th>
                                            <th class="p-4 font-bold text-gray-500 text-sm uppercase tracking-wider">Status
                                            </th>
                                            <th class="p-4 font-bold text-gray-500 text-sm uppercase tracking-wider">
                                                Penerima Manfaat</th>
                                            <th class="p-4 font-bold text-gray-500 text-sm uppercase tracking-wider">Dana
                                                Disalurkan</th>
                                            <th class="p-4 font-bold text-gray-500 text-sm uppercase tracking-wider">
                                                Dokumentasi</th>
                                            <th
                                                class="p-4 font-bold text-gray-500 text-sm uppercase tracking-wider text-right">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($provinces as $province)
                                            <tr class="hover:bg-gray-50/50 transition-colors">
                                                <td class="p-4 font-bold text-dark">{{ $province->name }}</td>
                                                <td class="p-4">
                                                    @if($province->is_active)
                                                        <span
                                                            class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold border border-primary/20">Aktif</span>
                                                    @else
                                                        <span
                                                            class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td class="p-4 text-gray-600 font-medium">{{ $province->beneficiaries ?? '-' }}
                                                </td>
                                                <td class="p-4 text-gray-600 font-medium">{{ $province->funds ?? '-' }}</td>
                                                <td class="p-4">
                                                    <div class="flex -space-x-2">
                                                        @forelse($province->images ?? [] as $img)
                                                            @if($loop->iteration <= 3)
                                                                <img src="{{ is_array($img) ? ($img['url'] ?? '') : $img }}"
                                                                    class="w-8 h-8 rounded-full border-2 border-white object-cover"
                                                                    alt="img">
                                                            @endif
                                                        @empty
                                                            <span class="text-sm text-gray-400 font-medium">Belum ada</span>
                                                        @endforelse
                                                        @if(is_array($province->images) && count($province->images) > 3)
                                                            <div
                                                                class="w-8 h-8 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500">
                                                                +{{ count($province->images) - 3 }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right">
                                                    <a href="{{ route('admin.provinces.edit', ['province' => $province->id, 'from' => 'home_stats']) }}"
                                                        class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                        Edit Data
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Form CTA --}}
                    <div id="section-cta" class="content-section hidden">
                        <form action="{{ route('admin.home.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="section" value="cta">
                            <div class="flex items-center justify-between mb-8">
                                <h2 class="text-lg lg:text-2xl font-bold text-dark">Banner Ajakan (CTA) Bottom</h2>
                                <button type="submit"
                                    class="bg-primary hover:bg-dark text-white px-4 lg:px-8 py-2.5 lg:py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20">Simpan
                                    Perubahan</button>
                            </div>

                            @php $ctaData = $cta ? $cta->content : ['title' => '', 'desc' => '', 'btn' => '']; @endphp
                            <div class="space-y-6">
                                <div>
                                    <label class="block font-bold mb-2">Judul Ajakan</label>
                                    <input type="text" name="content[title]" value="{{ $ctaData['title'] }}"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">
                                </div>
                                <div>
                                    <label class="block font-bold mb-2">Deskripsi Singkat</label>
                                    <textarea name="content[desc]" rows="3"
                                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none">{{ $ctaData['desc'] }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-bold mb-2 text-secondary">Teks Tombol</label>
                                    <input type="text" name="content[btn]" value="{{ $ctaData['btn'] }}"
                                        class="w-full px-6 py-4 rounded-2xl border-2 border-secondary/20 focus:border-secondary transition-all outline-none font-bold">
                                </div>
                            </div>
                        </form>
                    </div>


                    {{-- Form Testimoni --}}
                    <div id="section-testimoni" class="content-section hidden">
                        <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="testimoni">

                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                                <h2 class="text-lg lg:text-2xl font-bold text-dark">Daftar Testimoni</h2>
                                <button type="submit"
                                    class="bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 w-full sm:w-auto">
                                    Simpan Testimoni
                                </button>
                            </div>

                            @php
                                $testimoniList = $testimoni ? (is_string($testimoni->content) ? json_decode($testimoni->content, true) : $testimoni->content) : [];
                            @endphp

                            <div id="testimoni-list" class="space-y-6">
                                @forelse ($testimoniList as $index => $item)
                                    <div
                                        class="testimoni-item bg-gray-50 p-6 rounded-2xl border border-gray-100 relative group">
                                        <button type="button" onclick="this.parentElement.remove()"
                                            class="absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors z-10">
                                            &times;
                                        </button>
                                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                                            <div class="lg:col-span-3">
                                                <div
                                                    class="relative w-full aspect-square rounded-xl overflow-hidden bg-white border border-gray-200 group-hover:border-primary transition-colors">
                                                    @if(isset($item['image']) && $item['image'])
                                                        <img src="{{ $item['image'] }}" id="preview-testimoni-img-{{$index}}"
                                                            class="w-full h-full object-cover">
                                                        <div id="preview-testimoni-placeholder-{{$index}}"
                                                            class="hidden absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                                                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                            <span class="text-xs font-medium">Foto (1:1)</span>
                                                        </div>
                                                    @else
                                                        <img src="" id="preview-testimoni-img-{{$index}}"
                                                            class="hidden w-full h-full object-cover">
                                                        <div id="preview-testimoni-placeholder-{{$index}}"
                                                            class="absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                                                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                            <span class="text-xs font-medium">Foto (1:1)</span>
                                                        </div>
                                                    @endif
                                                    <input type="file" name="new_images[]" accept="image/*"
                                                        onchange="previewTestimoniImage(this, {{$index}})"
                                                        class="absolute inset-0 opacity-0 cursor-pointer">
                                                    <input type="hidden" name="content[{{$index}}][existing_image]"
                                                        value="{{ $item['image'] ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="lg:col-span-9 space-y-4">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block font-bold mb-2 text-sm text-gray-600">Nama</label>
                                                        <input type="text" name="content[{{$index}}][name]"
                                                            value="{{ $item['name'] ?? '' }}"
                                                            class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary outline-none transition-all"
                                                            required>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block font-bold mb-2 text-sm text-gray-600">Peran/Pekerjaan</label>
                                                        <input type="text" name="content[{{$index}}][role]"
                                                            value="{{ $item['role'] ?? '' }}"
                                                            class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary outline-none transition-all"
                                                            required>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block font-bold mb-2 text-sm text-gray-600">Isi
                                                        Testimoni</label>
                                                    <textarea name="content[{{$index}}][quote]" rows="3"
                                                        class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary outline-none transition-all"
                                                        required>{{ $item['quote'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>

                            <button type="button" onclick="addTestimoni()"
                                class="mt-6 flex items-center justify-center gap-2 w-full py-4 rounded-2xl border-2 border-dashed border-primary/30 text-primary hover:bg-primary/5 transition-colors font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Testimoni
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(id) {
            // Hide all
            document.querySelectorAll('.content-section').forEach(el => el.classList.add('hidden'));
            // Show target
            document.getElementById('section-' + id).classList.remove('hidden');

            // Update tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-white', 'text-dark', 'shadow-sm');
                btn.classList.add('bg-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById('tab-' + id);
            activeBtn.classList.remove('bg-transparent', 'text-gray-500');
            activeBtn.classList.add('bg-white', 'text-dark', 'shadow-sm');
        }

        function addHeroInput() {
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                    <input type="text" name="content[images][]" placeholder="/images/baru.svg" class="flex-1 px-5 py-3 rounded-xl border border-gray-200 outline-none focus:border-primary">
                    <button type="button" onclick="this.parentElement.remove()" class="p-3 text-red-500 hover:bg-red-50 rounded-xl">&times;</button>
                `;
            document.getElementById('hero-inputs').appendChild(div);
        }

        // Auto-open tab based on URL param
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab) {
                showSection(tab);
            }
        });

        function previewImage(input, index) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imgElement = document.getElementById('preview-img-' + index);
                    const placeholder = document.getElementById('preview-placeholder-' + index);
                    const deleteBtn = document.getElementById('delete-btn-' + index);

                    if (imgElement) {
                        imgElement.src = e.target.result;
                        imgElement.classList.remove('hidden');
                    }
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                    if (deleteBtn) {
                        deleteBtn.classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeProgramImage(index) {
            const imgElement = document.getElementById('preview-img-' + index);
            const placeholder = document.getElementById('preview-placeholder-' + index);
            const deleteBtn = document.getElementById('delete-btn-' + index);
            const hiddenInput = document.getElementById('hidden-img-' + index);
            const fileInput = document.getElementById('file-input-' + index);

            // Hide image and show placeholder
            if (imgElement) {
                imgElement.src = '';
                imgElement.classList.add('hidden');
            }
            if (placeholder) {
                placeholder.classList.remove('hidden');
            }
            if (deleteBtn) {
                deleteBtn.classList.add('hidden');
            }

            // Clear values so backend deletes the image and no new file is sent
            if (hiddenInput) {
                hiddenInput.value = '';
            }
            if (fileInput) {
                fileInput.value = '';
            }
        }
        function previewHeroImages(input) {
            const container = document.getElementById('hero-preview-container');
            const uploadBox = document.getElementById('hero-upload-box');

            if (input.files && input.files.length > 0) {
                // Sembunyikan input saat ini dan pindahkan ke dalam wrapper agar ikut tersubmit
                input.style.display = 'none';
                input.classList.remove('hidden');

                // Buat wrapper untuk preview batch ini
                const batchDiv = document.createElement('div');
                batchDiv.className = 'contents';
                batchDiv.appendChild(input);

                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const div = document.createElement('div');
                        div.className = 'group relative aspect-video bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 shadow-sm';
                        div.innerHTML = `
                                <img src="${e.target.result}" class="w-full h-full object-cover">
                                <div class="absolute top-2 left-2 bg-primary text-white text-[10px] px-2 py-1 rounded-full font-bold shadow">BARU</div>
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                    <button type="button" onclick="window.itemToDelete = this.closest('.contents'); openDeleteModal('delete-image-modal', 'window.itemToDelete.remove()')" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all" title="Hapus Batch Ini">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            `;
                        batchDiv.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });

                container.insertBefore(batchDiv, uploadBox);

                // Buat input baru untuk upload box agar user bisa memilih gambar lagi
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'new_images[]';
                newInput.multiple = true;
                newInput.className = 'hidden';
                newInput.onchange = function () { previewHeroImages(this); };
                uploadBox.appendChild(newInput);
            }
        }

        let testimoniCount = {{ isset($testimoniList) ? count($testimoniList) : 0 }};

        function addTestimoni() {
            const index = testimoniCount++;
            const div = document.createElement('div');
            div.className = 'testimoni-item bg-gray-50 p-6 rounded-2xl border border-gray-100 relative group';
            div.innerHTML = `
                    <button type="button" onclick="this.parentElement.remove()" 
                        class="absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors z-10">
                        &times;
                    </button>
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        <div class="lg:col-span-3">
                            <div class="relative w-full aspect-square rounded-xl overflow-hidden bg-white border border-gray-200 group-hover:border-primary transition-colors">
                                <img src="" id="preview-testimoni-img-${index}" class="hidden w-full h-full object-cover">
                                <div id="preview-testimoni-placeholder-${index}" class="absolute inset-0 flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-medium">Foto (1:1)</span>
                                </div>
                                <input type="file" name="new_images[]" accept="image/*" onchange="previewTestimoniImage(this, ${index})" class="absolute inset-0 opacity-0 cursor-pointer">
                                <input type="hidden" name="content[${index}][existing_image]" value="">
                            </div>
                        </div>
                        <div class="lg:col-span-9 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-bold mb-2 text-sm text-gray-600">Nama</label>
                                    <input type="text" name="content[${index}][name]" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary outline-none transition-all" required>
                                </div>
                                <div>
                                    <label class="block font-bold mb-2 text-sm text-gray-600">Peran/Pekerjaan</label>
                                    <input type="text" name="content[${index}][role]" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary outline-none transition-all" required>
                                </div>
                            </div>
                            <div>
                                <label class="block font-bold mb-2 text-sm text-gray-600">Isi Testimoni</label>
                                <textarea name="content[${index}][quote]" rows="3" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary outline-none transition-all" required></textarea>
                            </div>
                        </div>
                    </div>
                `;
            document.getElementById('testimoni-list').appendChild(div);
        }

        function previewTestimoniImage(input, index) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('preview-testimoni-img-' + index);
                    const placeholder = document.getElementById('preview-testimoni-placeholder-' + index);
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- Modal Konfirmasi Hapus Gambar -->
    <x-admin.delete-modal id="delete-image-modal" action="js" title="Hapus Gambar"
        message="Apakah Anda yakin ingin menghapus gambar ini?" />
@endsection