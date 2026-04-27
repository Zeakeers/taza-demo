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
        
        <div class="pt-6 pb-2 px-4 text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Manajemen Konten</div>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Tentang Kami
        </a>

        <div class="space-y-1">
            <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <span class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                    Layanan
                </span>
                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="pl-10 space-y-1">
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Konfirmasi Donasi</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">QR Code</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Kantor Layanan</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Hitung Zakat</a>
            </div>
        </div>

        <div class="space-y-1">
            <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <span class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                    Kolaborasi
                </span>
                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="pl-10 space-y-1">
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Mitra Kami</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Volunteer</a>
            </div>
        </div>
        
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Berita
        </a>

        <div class="space-y-1">
            <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
                <span class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
                    Program
                </span>
                <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="pl-10 space-y-1">
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Pendidikan</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Kesehatan</a>
                <a href="#" class="block py-2 text-sm text-gray-500 hover:text-secondary transition-colors">Kemanusiaan</a>
            </div>
        </div>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-gray-300 hover:text-white group">
            <div class="w-1.5 h-1.5 rounded-full bg-secondary opacity-0 group-hover:opacity-100 transition-all"></div>
            Tata Kelola
        </a>
    </nav>
    
    <div class="p-6 bg-black/20 m-4 rounded-2xl">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=Admin&background=5DA630&color=fff" class="w-10 h-10 rounded-xl shadow-lg">
            <div class="text-sm overflow-hidden">
                <p class="font-bold truncate">Administrator</p>
                <p class="text-gray-400 text-xs truncate">admin@tamanzakat.org</p>
            </div>
        </div>
    </div>
</aside>
