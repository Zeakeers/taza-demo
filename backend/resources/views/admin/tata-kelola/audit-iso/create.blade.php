@extends('layouts.admin')
@section('header', 'Tambah Audit ISO')
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

    <form action="{{ route('admin.tata-kelola.audit-iso.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>    <textarea name="description" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary" rows="4"></textarea>
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Teks Link Sertifikat</label>    <input type="text" name="link_text" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
</div>
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">File Sertifikat (PDF, Opsional)</label>    <input type="file" name="file" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
</div>

        <div class="mt-6">
            <button type="submit" class="bg-primary hover:bg-primary/90 text-white px-6 py-2 rounded-lg font-medium transition-colors">Simpan</button>
        </div>
    </form>
</div>
@endsection