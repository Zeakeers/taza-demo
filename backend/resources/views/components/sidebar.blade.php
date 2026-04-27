<aside class="w-72 bg-dark text-white flex flex-col h-full shrink-0 shadow-2xl z-50">
    <div class="p-8 flex items-center gap-4">
         <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg overflow-hidden p-1">
             <img src="{{ asset('images/logo.svg') }}" alt="TZ" class="w-full h-full object-contain">
         </div>
         <div>
            <span class="block font-bold text-xl leading-none">Admin</span>
            <span class="text-secondary text-xs font-medium tracking-widest uppercase">Taman Zakat</span>
         </div>
    </div>
    
    <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto sidebar-scroll">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        
        {{-- Group 1: Manajemen Konten (Untuk Content Manager & Dev) --}}
        @if(auth()->user()->role == 'dev' || auth()->user()->role == 'content_manager')
        <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Manajemen Konten</div>
        
        <a href="{{ route('admin.home.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.home.edit') ? 'bg-primary text-white font-semibold shadow-lg shadow-primary/20' : 'text-gray-300 hover:bg-white/5' }} transition-all">
            <div class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.home.edit') ? 'bg-white' : 'bg-secondary opacity-0' }} group-hover:opacity-100 transition-all"></div>
            Dashboard Home
        </a>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Tentang Kami
        </a>

        <div class="space-y-1">
            <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <span class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                    Layanan
                </span>
                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="pl-10 space-y-1 hidden">
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">QR Code Donasi</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Kantor Pelayanan</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Hitung Zakat</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">No. Rekening</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">FAQ</a>
            </div>
        </div>

        <div class="space-y-1">
            <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <span class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                    Kolaborasi
                </span>
                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="pl-10 space-y-1 hidden">
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Mitra Kami</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Volunteer</a>
            </div>
        </div>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Program
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Berita
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Tata Kelola
        </a>
        @endif

        {{-- Group 2: Hasil Form User (Untuk Reviewer & Dev) --}}
        @if(auth()->user()->role == 'dev' || auth()->user()->role == 'reviewer')
        <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Data Form & Review</div>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Data Konfirmasi Donasi
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Data Permohonan Bantuan
        </a>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Data Pendaftar Volunteer
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Pesan Hubungi Kami
        </a>
        @endif

        {{-- Group 3: Sistem (Hanya untuk Dev) --}}
        @if(auth()->user()->role == 'dev')
        <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Sistem Admin</div>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Manajemen Akun Admin
        </a>
        @endif
    </nav>
    
    <div class="p-4 m-4 rounded-2xl bg-black/20">
        <div class="flex items-center gap-3 mb-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=5DA630&color=fff" class="w-10 h-10 rounded-xl shadow-lg">
            <div class="text-sm overflow-hidden">
                <p class="font-bold truncate">{{ auth()->user()->name }}</p>
                <p class="text-gray-400 text-[10px] uppercase tracking-wider">{{ auth()->user()->role }}</p>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded-xl bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white font-semibold text-xs transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Keluar Panel
            </button>
        </form>
    </div>
</aside>
