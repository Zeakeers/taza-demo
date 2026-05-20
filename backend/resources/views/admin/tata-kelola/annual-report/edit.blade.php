@extends('layouts.admin')
@section('header', 'Edit Laporan Publikasi')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.tata-kelola.annual-report.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tata-kelola.annual-report.update', $annualReport->id ?? $financialReport->id ?? $auditIso->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>    <input type="text" name="year" value="{{ $annualReport->year ?? $financialReport->year ?? $auditIso->year ?? '' }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>    <input type="text" name="title" value="{{ $annualReport->title ?? $financialReport->title ?? $auditIso->title ?? '' }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>    <textarea name="description" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary" rows="4">{{ $annualReport->description ?? $financialReport->description ?? $auditIso->description ?? '' }}</textarea>
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Laporan (Maksimal 3 Gambar)</label>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @for($i = 1; $i <= 3; $i++)
            @php 
                $fieldName = $i == 1 ? 'image' : 'image'.$i; 
                $currentImage = $annualReport->$fieldName ?? null;
            @endphp
            <div>
                <div class="relative aspect-[4/3] bg-gray-50 rounded-xl overflow-hidden border-2 border-dashed border-gray-300 hover:border-primary hover:bg-primary/5 transition-all group">
                    @if($currentImage)
                        <img src="{{ Str::startsWith($currentImage, 'http') || Str::startsWith($currentImage, '/') ? $currentImage : Storage::url($currentImage) }}" id="preview-img-{{ $i }}" class="w-full h-full object-cover">
                        <label class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white text-xs font-bold bg-black/50 px-3 py-1 rounded-full mb-2">Ubah Gambar</span>
                            <input type="file" name="{{ $fieldName }}" accept="image/*" onchange="previewAnnualImage(this, {{ $i }})" class="hidden">
                        </label>
                    @else
                        <img src="" id="preview-img-{{ $i }}" class="hidden w-full h-full object-cover">
                        <label class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer">
                            <div id="preview-placeholder-{{ $i }}" class="flex flex-col items-center justify-center text-gray-400 group-hover:text-primary transition-colors">
                                <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs font-bold">Pilih Gambar {{ $i }}</span>
                            </div>
                            <input type="file" name="{{ $fieldName }}" accept="image/*" onchange="previewAnnualImage(this, {{ $i }})" class="hidden">
                        </label>
                    @endif
                    
                    <button type="button" id="remove-img-btn-{{ $i }}" onclick="removeAnnualImage({{ $i }}, '{{ $fieldName }}')" class="{{ $currentImage ? '' : 'hidden' }} absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-lg shadow-lg hover:bg-red-600 transition-colors z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        @endfor
    </div>
</div>
<div class="mb-4 mt-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">File Laporan (PDF, Opsional)</label>    
    <input type="file" name="file" accept=".pdf" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
    @if(($annualReport->file ?? $financialReport->file ?? $auditIso->file ?? false))
        @php $fileUrl = $annualReport->file ?? $financialReport->file ?? $auditIso->file; @endphp
        <div class="mt-3 flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-200">
            <div class="text-xs text-blue-500 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <a href="{{ Str::startsWith($fileUrl, 'http') || Str::startsWith($fileUrl, '/') ? $fileUrl : Storage::url($fileUrl) }}" target="_blank" class="hover:underline font-medium">Lihat File PDF Saat Ini</a>
            </div>
            <label class="flex items-center gap-2 text-sm text-red-600 cursor-pointer hover:bg-red-50 px-2 py-1 rounded transition-colors">
                <input type="checkbox" name="remove_file" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                <span class="font-medium">Hapus File</span>
            </label>
        </div>
    @endif
</div>

        <div class="mt-6">
            <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg font-medium transition-colors">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
function previewAnnualImage(input, index) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img-' + index).src = e.target.result;
            document.getElementById('preview-img-' + index).classList.remove('hidden');
            const placeholder = document.getElementById('preview-placeholder-' + index);
            if (placeholder) placeholder.classList.add('hidden');
            document.getElementById('remove-img-btn-' + index).classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeAnnualImage(index, fieldName) {
    document.getElementById('preview-img-' + index).src = '';
    document.getElementById('preview-img-' + index).classList.add('hidden');
    const placeholder = document.getElementById('preview-placeholder-' + index);
    if (placeholder) placeholder.classList.remove('hidden');
    document.getElementById('remove-img-btn-' + index).classList.add('hidden');
    // Clear the file input
    const fileInput = document.querySelector(`input[name="${fieldName}"]`);
    if (fileInput) fileInput.value = '';
    
    // Set a hidden input to indicate removal if you want the backend to delete it
    // But since we just want to clear the preview for now:
    let deleteInput = document.getElementById('delete-img-' + index);
    if(!deleteInput) {
        deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.id = 'delete-img-' + index;
        deleteInput.name = 'remove_image_' + index;
        deleteInput.value = '1';
        document.querySelector('form').appendChild(deleteInput);
    }
}
</script>
@endsection