@extends('layouts.admin')
@section('header', 'Edit Audit ISO')
@section('content')
<div class="mb-6">
    <a href="{{ route('admin.tata-kelola.audit-iso.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Kembali</a>
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

    <form action="{{ route('admin.tata-kelola.audit-iso.update', $annualReport->id ?? $financialReport->id ?? $auditIso->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>    <textarea name="description" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary" rows="4">{{ $annualReport->description ?? $financialReport->description ?? $auditIso->description ?? '' }}</textarea>
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Teks Link Sertifikat</label>    <input type="text" name="link_text" value="{{ $annualReport->link_text ?? $financialReport->link_text ?? $auditIso->link_text ?? '' }}" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">File Sertifikat (PDF, Opsional)</label>    
    <input type="file" name="file" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
    @if(($annualReport->file ?? $financialReport->file ?? $auditIso->file ?? false))
        @php $fileUrl = $annualReport->file ?? $financialReport->file ?? $auditIso->file; @endphp
        <div class="mt-3 flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-200">
            <div class="text-xs text-blue-500 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <a href="{{ Str::startsWith($fileUrl, 'http') || Str::startsWith($fileUrl, '/') ? $fileUrl : Storage::url($fileUrl) }}" target="_blank" class="hover:underline font-medium">Lihat File Saat Ini</a>
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
@endsection