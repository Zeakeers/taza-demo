@extends('layouts.admin')

@section('header', 'FAQ')

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
            <h1 class="text-xl lg:text-3xl font-bold text-dark">Kelola FAQ</h1>
            <p class="text-gray-400 text-[10px] lg:text-base mt-1">Kelola pertanyaan dan jawaban yang sering ditanyakan.</p>
        </div>
    </div>

    @php
        $data = $faq ? $faq->content : [
            'header' => [
                'title' => 'Haloo, ada yang bisa kami bantu?',
                'search_placeholder' => 'Cari bantuan disini ...',
            ],
            'items' => [],
            'topics' => [],
        ];
    @endphp

    <form action="{{ route('admin.layanan-pages.faq.update') }}" method="POST">
        @csrf

        {{-- Header Section --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-zinc-800">Header Halaman FAQ</h2>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                    Simpan Semua
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Halaman</label>
                    <input type="text" name="content[header][title]" value="{{ $data['header']['title'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Haloo, ada yang bisa kami bantu?">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Placeholder Pencarian</label>
                    <input type="text" name="content[header][search_placeholder]" value="{{ $data['header']['search_placeholder'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Cari bantuan disini ...">
                </div>
            </div>
        </div>

        {{-- Popular Topics --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-zinc-800">Topik Populer</h2>
                    <p class="text-sm text-gray-400">Daftar topik populer yang muncul di sidebar FAQ.</p>
                </div>
                <button type="button" onclick="addTopic()" class="text-primary font-bold text-sm hover:underline">+ Tambah Topik</button>
            </div>
            <div id="topics-list" class="flex flex-wrap gap-3">
                @forelse($data['topics'] ?? [] as $tIndex => $topic)
                <div class="topic-item flex items-center gap-2 bg-primary/10 border border-primary/20 rounded-full px-4 py-2">
                    <input type="text" name="content[topics][]" value="{{ $topic }}" class="bg-transparent border-none outline-none text-sm font-medium text-primary w-32" placeholder="Topik">
                    <button type="button" onclick="this.closest('.topic-item').remove()" class="text-red-400 hover:text-red-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                @empty
                @endforelse
            </div>
        </div>

        {{-- FAQ Items --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-zinc-800">Daftar Pertanyaan</h2>
                <p class="text-sm text-gray-400">Tambah, edit, atau hapus item FAQ.</p>
            </div>
            <button type="button" onclick="addFaqItem()" class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah FAQ
            </button>
        </div>

        <div id="faq-list" class="space-y-4">
            @forelse($data['items'] ?? [] as $index => $item)
            <div class="faq-item bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative group">
                <button type="button" onclick="this.closest('.faq-item').remove()" class="absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors z-10">
                    &times;
                </button>
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary font-bold text-sm shrink-0 mt-1">
                        Q
                    </div>
                    <div class="flex-1 space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan</label>
                            <input type="text" name="content[items][{{ $index }}][question]" value="{{ $item['question'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Tulis pertanyaan..." required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jawaban</label>
                            <textarea name="content[items][{{ $index }}][answer]" rows="3" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none" placeholder="Tulis jawaban..." required>{{ $item['answer'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>

        <button type="button" onclick="addFaqItem()" class="mt-6 flex items-center justify-center gap-2 w-full py-4 rounded-2xl border-2 border-dashed border-primary/30 text-primary hover:bg-primary/5 transition-colors font-bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Pertanyaan Baru
        </button>
    </form>
</div>

<script>
    let faqCount = {{ count($data['items'] ?? []) }};

    function addFaqItem() {
        const index = faqCount++;
        const div = document.createElement('div');
        div.className = 'faq-item bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative group';
        div.innerHTML = `
            <button type="button" onclick="this.closest('.faq-item').remove()" class="absolute -top-3 -right-3 bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors z-10">
                &times;
            </button>
            <div class="flex items-start gap-4">
                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary font-bold text-sm shrink-0 mt-1">
                    Q
                </div>
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pertanyaan</label>
                        <input type="text" name="content[items][${index}][question]" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Tulis pertanyaan..." required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jawaban</label>
                        <textarea name="content[items][${index}][answer]" rows="3" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none" placeholder="Tulis jawaban..." required></textarea>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('faq-list').appendChild(div);
    }

    function addTopic() {
        const div = document.createElement('div');
        div.className = 'topic-item flex items-center gap-2 bg-primary/10 border border-primary/20 rounded-full px-4 py-2';
        div.innerHTML = `
            <input type="text" name="content[topics][]" class="bg-transparent border-none outline-none text-sm font-medium text-primary w-32" placeholder="Topik baru">
            <button type="button" onclick="this.closest('.topic-item').remove()" class="text-red-400 hover:text-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        `;
        document.getElementById('topics-list').appendChild(div);
    }
</script>
@endsection
