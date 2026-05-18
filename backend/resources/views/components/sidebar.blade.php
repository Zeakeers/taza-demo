<div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-dark/60 backdrop-blur-sm z-[60] lg:hidden" @click="sidebarOpen = false"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed lg:static inset-y-0 left-0 w-72 bg-dark text-white flex flex-col h-full shrink-0 shadow-2xl z-[70] transition-transform duration-300 ease-in-out">
    <div class="p-8 flex items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg overflow-hidden p-1">
                <img src="{{ asset('images/logo.svg') }}" alt="TZ" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="block font-bold text-xl leading-none">Admin</span>
                <span class="text-secondary text-xs font-medium tracking-widest uppercase">Taman Zakat</span>
            </div>
        </div>
        <button @click="sidebarOpen = false"
            class="lg:hidden p-2 rounded-xl bg-white/5 text-gray-400 hover:text-white transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <nav id="sidebar-nav-scroll" class="flex-1 px-4 py-4 space-y-2 overflow-y-auto sidebar-scroll">
        {{-- Group 1: Manajemen Konten (Untuk Markom & Dev) --}}
        @if(auth()->user()->role == 'dev' || auth()->user()->role == 'markom')
            <div class="pt-2 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Manajemen Konten
            </div>

            <a href="{{ route('admin.home.edit') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.home.edit') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.home.edit') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Dashboard Home
            </a>

            <a href="{{ route('admin.about.edit') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.about.edit') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'hover:bg-white/5 text-gray-300 hover:text-white' }} transition-all group">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.about.edit') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Tentang Kami
            </a>

            <div class="space-y-1">
                <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                    <span class="flex items-center gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all">
                        </div>
                        Layanan
                    </span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" stroke-width="2">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="pl-10 space-y-1 {{ request()->routeIs('admin.rekening.*') || request()->routeIs('admin.layanan-pages.*') ? '' : 'hidden' }}">
                    <a href="{{ route('admin.layanan-pages.qrcode') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.layanan-pages.qrcode*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">QR Code
                        Donasi</a>
                    <a href="{{ route('admin.layanan-pages.kantor') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.layanan-pages.kantor*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Kantor
                        Pelayanan</a>
                    <a href="{{ route('admin.layanan-pages.hitung-zakat') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.layanan-pages.hitung-zakat*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Hitung
                        Zakat</a>
                    <a href="{{ route('admin.rekening.index') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.rekening.*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">No.
                        Rekening</a>
                    <a href="{{ route('admin.layanan-pages.faq') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.layanan-pages.faq*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">FAQ</a>
                </div>
            </div>

            <div class="space-y-1">
                <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                    <span class="flex items-center gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all">
                        </div>
                        Kolaborasi
                    </span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" stroke-width="2">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="pl-10 space-y-1 {{ request()->routeIs('admin.mitra.*') || request()->routeIs('admin.volunteer.page.*') ? '' : 'hidden' }}">
                    <a href="{{ route('admin.mitra.index') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.mitra.*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Mitra
                        Kami</a>
                    <a href="{{ route('admin.volunteer.page.edit') }}"
                        class="block py-2 text-sm {{ request()->routeIs('admin.volunteer.page.*') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Volunteer</a>
                </div>
            </div>

            <div class="space-y-1">
                <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                    <span class="flex items-center gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all">
                        </div>
                        Program
                    </span>
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" stroke-width="2">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="pl-10 space-y-1 {{ request()->routeIs('admin.program.*') ? '' : 'hidden' }}">
                    <a href="{{ route('admin.program.edit', 'dakwah') }}" class="block py-2 text-sm {{ request()->is('admin/program/dakwah') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Dakwah</a>
                    <a href="{{ route('admin.program.edit', 'ekonomi') }}" class="block py-2 text-sm {{ request()->is('admin/program/ekonomi') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Ekonomi</a>
                    <a href="{{ route('admin.program.edit', 'kemanusiaan') }}" class="block py-2 text-sm {{ request()->is('admin/program/kemanusiaan') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Kemanusiaan</a>
                    <a href="{{ route('admin.program.edit', 'kesehatan') }}" class="block py-2 text-sm {{ request()->is('admin/program/kesehatan') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Kesehatan</a>
                    <a href="{{ route('admin.program.edit', 'pendidikan') }}" class="block py-2 text-sm {{ request()->is('admin/program/pendidikan') ? 'text-secondary font-bold' : 'text-gray-500 hover:text-secondary' }} transition-colors">Pendidikan</a>
                </div>
            </div>

            <a href="{{ route('admin.berita.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.berita.*') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all group">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.berita.*') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Berita
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                Tata Kelola
            </a>
        @endif

        {{-- Group 2: Hasil Form User (Untuk Program & Dev) --}}
        @if(auth()->user()->role == 'dev' || auth()->user()->role == 'program')
            <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Data Form & Review
            </div>

            <a href="{{ route('admin.custom-forms.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.custom-forms.*') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all group">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.custom-forms.*') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Kelola Formulir
            </a>

            <a href="{{ route('admin.konfirmasi-donasi.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.konfirmasi-donasi.*') || request()->is('admin/konfirmasi-donasi') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all group">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.konfirmasi-donasi.*') || request()->is('admin/konfirmasi-donasi') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Data Konfirmasi Donasi
            </a>

            <a href="{{ route('admin.permohonan-bantuan.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.permohonan-bantuan.*') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all group">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.permohonan-bantuan.*') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Data Permohonan Bantuan
            </a>

            <a href="{{ route('admin.volunteer.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.volunteer.*') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all group">
                <div
                    class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.volunteer.*') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all">
                </div>
                Data Pendaftar Volunteer
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                Pesan Hubungi Kami
            </a>
        @endif

        {{-- Group 3: Sistem (Hanya untuk Dev) --}}
        @if(auth()->user()->role == 'dev')
            <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Sistem Admin</div>

            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-secondary' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Manajemen Akun Admin
            </a>
        @endif
    </nav>

    <div class="p-4 m-4 rounded-2xl bg-black/20">
        <div class="flex items-center gap-3 mb-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=5DA630&color=fff"
                class="w-10 h-10 rounded-xl shadow-lg">
            <div class="text-sm overflow-hidden">
                <p class="font-bold truncate">{{ auth()->user()->name }}</p>
                <p class="text-gray-400 text-[10px] uppercase tracking-wider">{{ auth()->user()->role }}</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white font-semibold text-xs transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar Panel
            </button>
        </form>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarNav = document.getElementById("sidebar-nav-scroll");
        if (sidebarNav) {
            // Restore scroll position
            if (sessionStorage.getItem("sidebar-scroll")) {
                sidebarNav.scrollTop = sessionStorage.getItem("sidebar-scroll");
            }

            // Save scroll position on scroll
            sidebarNav.addEventListener("scroll", function() {
                sessionStorage.setItem("sidebar-scroll", sidebarNav.scrollTop);
            });
        }
    });
</script>