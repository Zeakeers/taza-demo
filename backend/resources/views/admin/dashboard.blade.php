@extends('layouts.admin')

@section('header', 'Ringkasan Statistik')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Stat Card 1 -->
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary/5 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <span class="text-green-500 text-xs font-bold bg-green-50 px-2.5 py-1 rounded-full">+12%</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Penerima Manfaat</h3>
        <p class="text-3xl font-black text-zinc-800 mt-1">102.088</p>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary/5 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
            <span class="text-blue-500 text-xs font-bold bg-blue-50 px-2.5 py-1 rounded-full">Tetap</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Kantor Layanan</h3>
        <p class="text-3xl font-black text-zinc-800 mt-1">47</p>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-primary/5 transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-secondary/10 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <span class="text-secondary text-xs font-bold bg-secondary/5 px-2.5 py-1 rounded-full">Aktif</span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium">Aksi Kebaikan</h3>
        <p class="text-3xl font-black text-zinc-800 mt-1">19</p>
    </div>

    <!-- Info Card -->
    <div class="bg-dark p-8 rounded-3xl shadow-xl shadow-dark/20 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-secondary text-sm font-bold uppercase tracking-widest mb-4">Butuh Bantuan?</h3>
            <p class="text-gray-300 text-sm leading-relaxed mb-6">Hubungi tim IT jika Anda mengalami kendala pada sistem dashboard ini.</p>
            <a href="#" class="inline-flex items-center gap-2 text-white bg-white/10 hover:bg-white/20 px-5 py-2.5 rounded-xl transition-all font-bold text-sm">
                WhatsApp Support
            </a>
        </div>
        <svg class="absolute -bottom-6 -right-6 w-32 h-32 text-white/5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V7h2v2z"/></svg>
    </div>
</div>

<div class="mt-12">
    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
        <h2 class="text-xl font-bold text-zinc-800 mb-6">Update Konten Terakhir</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-widest border-b border-gray-50">
                        <th class="pb-4 font-bold">Halaman</th>
                        <th class="pb-4 font-bold">Bagian</th>
                        <th class="pb-4 font-bold">Terakhir Diubah</th>
                        <th class="pb-4 font-bold">Status</th>
                        <th class="pb-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
                        <td class="py-5 font-bold text-zinc-800">Home</td>
                        <td class="py-5 text-gray-500">Hero Section</td>
                        <td class="py-5 text-gray-400">Baru saja</td>
                        <td class="py-5">
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Terbit</span>
                        </td>
                        <td class="py-5 text-right">
                            <button class="text-primary font-bold hover:underline transition-all">Kelola</button>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
                        <td class="py-5 font-bold text-zinc-800">Tentang Kami</td>
                        <td class="py-5 text-gray-500">Visi & Misi</td>
                        <td class="py-5 text-gray-400">1 jam yang lalu</td>
                        <td class="py-5">
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Terbit</span>
                        </td>
                        <td class="py-5 text-right">
                            <button class="text-primary font-bold hover:underline transition-all">Kelola</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
