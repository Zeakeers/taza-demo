@extends('layouts.admin')
@section('header', isset($legalFormal) ? 'Edit Legal Formal' : 'Tambah Legal Formal')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.tata-kelola.legal-formal.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="legalFormalEditor()">
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($legalFormal) ? route('admin.tata-kelola.legal-formal.update', $legalFormal->id) : route('admin.tata-kelola.legal-formal.store') }}" method="POST">
        @csrf
        @if(isset($legalFormal)) @method('PUT') @endif
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Panel</label>
            <input type="text" name="title" value="{{ $legalFormal->title ?? '' }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Elemen / Teks dalam Card</label>
            <p class="text-xs text-gray-500 mb-2">Tambahkan elemen teks dan pilih tipe visualnya. Mereka akan ditampilkan secara berurutan di dalam panel.</p>
            
            <input type="hidden" name="elements" :value="JSON.stringify(elements)">
            
            <div class="space-y-3 mb-4">
                <template x-for="(element, index) in elements" :key="index">
                    <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 relative flex flex-col gap-2">
                        <button type="button" @click="elements.splice(index, 1)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-medium text-sm">
                            Hapus
                        </button>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pr-12">
                            <div>
                                <label class="text-xs font-bold text-zinc-700">Tipe Visual</label>
                                <div class="relative" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" @click.away="open = false"
                                        class="w-full mt-1 bg-white border border-gray-200 text-zinc-800 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-left flex items-center justify-between">
                                        
                                        <span class="font-medium text-zinc-700" x-text="{
                                            'text': 'Teks Normal',
                                            'text_large': 'Teks Utama (Besar)',
                                            'badge': 'Box Merah (Badge)',
                                            'outline': 'Box Outline (Garis)'
                                        }[element.type] || 'Pilih Tipe'"></span>
                                        
                                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div x-show="open" x-transition.opacity.duration.200ms
                                        class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden" style="display: none;">
                                        <div class="py-1 max-h-48 overflow-y-auto">
                                            <template x-for="opt in [
                                                {val: 'text', label: 'Teks Normal'},
                                                {val: 'text_large', label: 'Teks Utama (Besar)'},
                                                {val: 'badge', label: 'Box Merah (Badge)'},
                                                {val: 'outline', label: 'Box Outline (Garis)'}
                                            ]">
                                                <div @click="element.type = opt.val; open = false"
                                                     :class="element.type === opt.val ? 'text-primary font-bold bg-[#F2F9EC]' : 'text-zinc-700'"
                                                     class="px-4 py-2.5 text-sm cursor-pointer hover:bg-[#F2F9EC] hover:text-primary transition-colors"
                                                     x-text="opt.label">
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-700">Isi Konten</label>
                                <input type="text" x-model="element.content" class="w-full mt-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary" placeholder="Masukkan teks...">
                            </div>
                            <!-- Hidden class to preserve existing seeded styles if any -->
                            <input type="hidden" x-model="element.class">
                        </div>
                    </div>
                </template>
            </div>

            <button type="button" @click="elements.push({type: 'text', content: 'Teks Baru', class: ''})" class="px-4 py-2 border border-dashed border-gray-400 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                + Tambah Elemen
            </button>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </form>
</div>

<script>
function legalFormalEditor() {
    return {
        elements: {!! isset($legalFormal) && $legalFormal->elements ? json_encode($legalFormal->elements) : '[]' !!}
    }
}
</script>
@endsection