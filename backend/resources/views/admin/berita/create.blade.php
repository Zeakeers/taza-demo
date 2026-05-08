@extends('layouts.admin')

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('admin.berita.index') }}" class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    Tambah Berita Baru
</div>
@endsection

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-zinc-800">Tulis Berita / Artikel</h2>
    <p class="text-gray-500 text-sm mt-1">Buat berita baru untuk ditampilkan di website.</p>
</div>

@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl mb-6 font-medium">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    @csrf
    
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Konten Berita
            </h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul berita..." class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Isi Konten Berita <span class="text-red-500">*</span></label>
                    <textarea name="konten" rows="12" required placeholder="Tuliskan isi berita di sini..." class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-y">{{ old('konten') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="space-y-6">
        <!-- Sidebar Options -->
        <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
            <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Media & Pengaturan
            </h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-zinc-700 mb-2">Thumbnail / Gambar <span class="text-red-500">*</span></label>
                    <label for="file-upload" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer relative overflow-hidden group">
                        <div class="space-y-1 text-center" id="upload-placeholder">
                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-primary transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <span class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                    <span>Upload file gambar</span>
                                    <input id="file-upload" name="thumbnail" type="file" required class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </span>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 5MB</p>
                        </div>
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" />
                    </label>
                </div>
                
                <hr class="border-gray-100">

                <div class="space-y-4">
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home') ? 'checked' : '' }} class="w-5 h-5 text-primary focus:ring-primary rounded border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-zinc-800">Tampilkan di Home</span>
                            <span class="text-xs text-gray-500">Berita ini akan muncul di halaman utama</span>
                        </div>
                    </label>

                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="w-5 h-5 text-green-500 focus:ring-green-500 rounded border-gray-300">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-zinc-800">Publish Langsung</span>
                            <span class="text-xs text-gray-500">Jika uncheck, berita masuk ke Draft</span>
                        </div>
                    </label>
                </div>
                
                <hr class="border-gray-100">
                
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.berita.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-zinc-600 px-6 py-3 rounded-xl font-bold transition-all text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-primary/30">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('upload-placeholder').classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
