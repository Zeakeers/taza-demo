@props(['route'])

<form method="GET" action="{{ $route }}" class="mb-6 flex flex-col md:flex-row gap-4 items-end">
    <div class="flex-1 w-full">
        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Pencarian</label>
        <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-primary focus:bg-white focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
    </div>
    <div class="w-full md:w-44">
        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Mulai</label>
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-primary focus:bg-white outline-none transition-all text-sm text-gray-600">
    </div>
    <div class="w-full md:w-44">
        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tanggal Akhir</label>
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-primary focus:bg-white outline-none transition-all text-sm text-gray-600">
    </div>
    <div class="flex gap-2 w-full md:w-auto">
        <button type="submit" class="flex-1 md:flex-none bg-primary hover:bg-dark text-white px-5 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 text-sm">
            Terapkan
        </button>
        @if(request()->hasAny(['search', 'start_date', 'end_date']))
        <a href="{{ $route }}" class="flex-none bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2.5 rounded-xl font-bold transition-all flex items-center justify-center" title="Reset Filter">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        </a>
        @endif
    </div>
</form>
