@extends('layouts.admin')

@section('header', 'Kelola Formulir')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex-1">
            <h1 class="text-xl lg:text-3xl font-bold text-dark">Kelola Formulir</h1>
            <p class="text-gray-400 text-[10px] lg:text-base mt-1">Buat formulir kustom dan bagikan link unik ke pelanggan.</p>
        </div>
        <a href="{{ route('admin.custom-forms.create') }}" class="bg-primary hover:bg-dark text-white px-5 lg:px-8 py-3 rounded-xl lg:rounded-2xl font-bold text-sm lg:text-base transition-all shadow-lg shadow-primary/20 flex items-center gap-2 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Formulir Baru
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div id="alert-success" class="bg-primary text-white p-4 rounded-2xl shadow-lg shadow-primary/20 flex items-center justify-between gap-3 animate-bounce">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    <x-admin.delete-modal id="modal-delete-form" action="js" title="Hapus Formulir" message="Apakah Anda yakin ingin menghapus formulir ini beserta seluruh datanya? Tindakan ini tidak dapat dibatalkan." />

    {{-- Form Cards Grid --}}
    <div>
        <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            Daftar Formulir ({{ $forms->count() }})
        </h2>

        @if($forms->count() > 0)
            {{-- Search Forms --}}
            <div class="mb-4">
                <input type="text" id="search-forms" placeholder="Cari formulir berdasarkan nama..." class="w-full max-w-md px-5 py-3 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none text-sm" onkeyup="filterForms()">
            </div>

            <div id="forms-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-6">
                @foreach($forms as $form)
                    <div class="form-card bg-white rounded-[1.5rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group" data-title="{{ strtolower($form->title) }}">
                        {{-- Card Header with gradient --}}
                        <div class="bg-gradient-to-br from-primary/10 via-secondary/5 to-transparent p-5 pb-4">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-dark text-base lg:text-lg truncate">{{ $form->title }}</h3>
                                    @if($form->description)
                                        <p class="text-gray-500 text-xs mt-1 line-clamp-2">{{ $form->description }}</p>
                                    @endif
                                </div>
                                <span class="shrink-0 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $form->is_active ? 'bg-primary/15 text-primary' : 'bg-red-50 text-red-500' }}">
                                    {{ $form->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>

                        {{-- Stats --}}
                        <div class="px-5 py-4 border-t border-gray-50">
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="font-semibold text-dark">{{ $form->submissions_count }}</span> respons
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $form->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        {{-- Share Link --}}
                        <div class="px-5 py-3 bg-gray-50/50 border-t border-gray-50">
                            <div class="flex items-center gap-2">
                                <input type="text" value="{{ route('public.form.show', $form->slug) }}" readonly class="flex-1 text-[11px] text-gray-500 bg-white border border-gray-100 rounded-xl px-3 py-2 truncate outline-none" id="link-{{ $form->id }}">
                                <button onclick="copyLink('link-{{ $form->id }}')" class="shrink-0 bg-primary/10 text-primary hover:bg-primary hover:text-white p-2 rounded-xl transition-all" title="Salin Link">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                </button>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="px-5 py-3 border-t border-gray-50 flex items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.custom-forms.index', ['form_id' => $form->id]) }}" class="flex-1 text-center text-xs font-bold text-primary bg-primary/10 hover:bg-primary hover:text-white py-2.5 rounded-xl transition-all">
                                Lihat Data
                            </a>
                            <a href="{{ route('admin.custom-forms.edit', $form) }}" class="p-2.5 rounded-xl text-gray-400 hover:text-dark hover:bg-gray-100 transition-all" title="Edit Form">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.custom-forms.toggle-status', $form) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2.5 rounded-xl transition-all {{ $form->is_active ? 'text-yellow-500 hover:bg-yellow-50' : 'text-green-500 hover:bg-green-50' }}" title="{{ $form->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    @if($form->is_active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </button>
                            </form>
                            <form action="{{ route('admin.custom-forms.destroy', $form) }}" method="POST" class="inline" id="delete-form-{{ $form->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="openDeleteModal('modal-delete-form', 'document.getElementById(\'delete-form-{{ $form->id }}\').submit()')" class="p-2.5 rounded-xl text-red-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus Form">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-12 text-center flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-primary/10 text-primary rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h2 class="text-xl font-bold text-dark mb-2">Belum Ada Formulir</h2>
                <p class="text-gray-500 max-w-md mx-auto mb-6">Mulai buat formulir kustom pertama Anda dan bagikan link uniknya ke pelanggan untuk mengumpulkan data.</p>
                <a href="{{ route('admin.custom-forms.create') }}" class="bg-primary hover:bg-dark text-white px-8 py-3 rounded-2xl font-bold text-sm transition-all shadow-lg shadow-primary/20 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Formulir Pertama
                </a>
            </div>
        @endif
    </div>

    {{-- Submission Data Viewer --}}
    @if($selectedForm)
        <div class="mt-8">
            <div class="bg-white rounded-[2.5rem] p-5 sm:p-8 lg:p-10 shadow-xl border border-white relative">
                {{-- Prominent Close Button --}}
                <a href="{{ route('admin.custom-forms.index') }}" class="absolute top-5 right-5 sm:top-8 sm:right-8 bg-red-50 hover:bg-red-500 text-red-500 hover:text-white p-3 rounded-2xl transition-all group z-10" title="Tutup Tabel Data">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </a>

                {{-- Table Header --}}
                <div class="flex flex-col gap-4 mb-8 pr-14">
                    <div>
                        <div class="flex items-center gap-3 mb-1 flex-wrap">
                            <a href="{{ route('admin.custom-forms.index') }}" class="text-gray-400 hover:text-primary transition-colors shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </a>
                            <h2 class="text-lg lg:text-2xl font-bold text-dark">{{ $selectedForm->title }}</h2>
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">{{ $submissions->total() }} Data</span>
                        </div>
                        <p class="text-sm text-gray-400 ml-8">Data respons yang masuk dari formulir ini.</p>
                    </div>
                    <div class="flex items-center gap-3 flex-wrap">
                        {{-- Date Filter --}}
                        <form method="GET" action="{{ route('admin.custom-forms.index') }}" class="flex items-center gap-2">
                            <input type="hidden" name="form_id" value="{{ $selectedForm->id }}">
                            <input type="date" name="date" value="{{ $searchDate }}" class="px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none text-sm" onchange="this.form.submit()">
                            @if($searchDate)
                                <a href="{{ route('admin.custom-forms.index', ['form_id' => $selectedForm->id]) }}" class="text-red-400 hover:text-red-600 p-2 rounded-xl hover:bg-red-50 transition-all" title="Reset Filter">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </a>
                            @endif
                        </form>
                        {{-- Export CSV --}}
                        <a href="{{ route('admin.custom-forms.export-csv', $selectedForm) }}" class="bg-dark hover:bg-primary text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export CSV
                        </a>
                    </div>
                </div>

                {{-- Data Table --}}
                @if($submissions->count() > 0)
                    <div class="overflow-x-auto rounded-2xl border border-gray-100 hide-scrollbar">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-dark to-dark/90 text-white">
                                    <th class="px-4 py-4 text-left font-bold text-xs uppercase tracking-wider rounded-tl-2xl whitespace-nowrap">No</th>
                                    <th class="px-4 py-4 text-left font-bold text-xs uppercase tracking-wider whitespace-nowrap">Tanggal</th>
                                    @foreach($selectedForm->fields as $field)
                                        <th class="px-4 py-4 text-left font-bold text-xs uppercase tracking-wider whitespace-nowrap">{{ $field->label }}</th>
                                    @endforeach
                                    <th class="px-4 py-4 text-center font-bold text-xs uppercase tracking-wider rounded-tr-2xl whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($submissions as $index => $submission)
                                    <tr class="hover:bg-primary/5 transition-colors">
                                        <td class="px-4 py-4 text-gray-500 font-medium">{{ $submissions->firstItem() + $index }}</td>
                                        <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $submission->created_at->format('d M Y, H:i') }}</td>
                                        @foreach($selectedForm->fields as $field)
                                            <td class="px-4 py-4 text-gray-700 max-w-[200px]">
                                                @php $value = $submission->data[$field->label] ?? '-'; @endphp
                                                @if($field->type === 'file' && $value !== '-')
                                                    <a href="{{ $value }}" target="_blank" class="text-primary hover:underline font-medium text-xs flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                                        Lihat File
                                                    </a>
                                                @elseif(is_array($value))
                                                    <span class="truncate block">{{ implode(', ', $value) }}</span>
                                                @else
                                                    <span class="truncate block">{{ $value }}</span>
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="px-4 py-4">
                                            <div class="flex items-center justify-center gap-1">
                                                <button onclick="openEditModal({{ $submission->id }}, {{ json_encode($submission->data) }})" class="text-primary hover:bg-primary/10 p-2 rounded-lg transition-all" title="Edit Data">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                </button>
                                                <form id="delete-sub-{{ $submission->id }}" action="{{ route('admin.custom-forms.destroy-submission', $submission) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="openDeleteModal('modal-delete-form', 'document.getElementById(\'delete-sub-{{ $submission->id }}\').submit()')" class="text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-all" title="Hapus Data">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $submissions->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <h3 class="font-bold text-dark text-lg mb-1">Belum Ada Data</h3>
                        <p class="text-gray-400 text-sm">Belum ada respons yang masuk untuk formulir ini{{ $searchDate ? ' pada tanggal yang dipilih' : '' }}.</p>
                    </div>
                @endif

                {{-- Bottom Close Bar --}}
                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-center">
                    <a href="{{ route('admin.custom-forms.index') }}" class="flex items-center gap-2 bg-gray-100 hover:bg-red-50 text-gray-500 hover:text-red-500 px-6 py-3 rounded-2xl font-bold text-sm transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Tutup Tabel Data
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Edit Submission Modal --}}
<div id="edit-modal" class="fixed inset-0 z-[100] hidden">
    <div class="absolute inset-0 bg-dark/60 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="relative flex items-center justify-center min-h-full p-4">
        <div class="bg-white rounded-[2rem] shadow-2xl max-w-lg w-full max-h-[85vh] flex flex-col relative">
            {{-- Modal Header --}}
            <div class="flex items-center justify-between p-6 pb-4 border-b border-gray-100 shrink-0">
                <div>
                    <h3 class="text-xl font-bold text-dark">Edit Data Respons</h3>
                    <p class="text-sm text-gray-400 mt-0.5">Perbarui data yang dikirim pelanggan.</p>
                </div>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-dark p-2 rounded-xl hover:bg-gray-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Modal Body (Scrollable with hidden scrollbar) --}}
            <form id="edit-form" method="POST" class="flex flex-col flex-1 overflow-hidden">
                @csrf
                @method('PUT')
                <div id="edit-content" class="p-6 space-y-4 overflow-y-auto flex-1 modal-scroll"></div>

                {{-- Modal Footer --}}
                <div class="p-6 pt-4 border-t border-gray-100 flex items-center gap-3 justify-end shrink-0">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-2.5 rounded-xl font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-colors text-sm">Batal</button>
                    <button type="submit" class="bg-primary hover:bg-dark text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Thin subtle scrollbar for modal */
    .modal-scroll::-webkit-scrollbar { width: 4px; }
    .modal-scroll::-webkit-scrollbar-track { background: transparent; }
    .modal-scroll::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
    .modal-scroll::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    .modal-scroll { scrollbar-width: thin; scrollbar-color: #d1d5db transparent; }

    /* Hide scrollbar for table */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
    function filterForms() {
        const query = document.getElementById('search-forms').value.toLowerCase();
        document.querySelectorAll('.form-card').forEach(card => {
            const title = card.dataset.title;
            card.style.display = title.includes(query) ? '' : 'none';
        });
    }

    function copyLink(inputId) {
        const input = document.getElementById(inputId);
        input.select();
        navigator.clipboard.writeText(input.value).then(() => {
            showCopyToast();
        });
    }

    function showCopyToast() {
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-6 right-6 bg-dark text-white px-6 py-3 rounded-2xl shadow-2xl z-[200] font-semibold text-sm flex items-center gap-2 animate-bounce';
        toast.innerHTML = '<svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Link berhasil disalin!';
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2500);
    }

    function openEditModal(submissionId, data) {
        const form = document.getElementById('edit-form');
        form.action = `/admin/custom-forms/submissions/${submissionId}`;

        const content = document.getElementById('edit-content');
        content.innerHTML = '';

        for (const [key, value] of Object.entries(data)) {
            const div = document.createElement('div');

            let displayValue = value;
            if (Array.isArray(value)) {
                displayValue = value.join(', ');
            }

            // Check if it's a file URL — show read-only
            if (typeof displayValue === 'string' && (displayValue.startsWith('http') || displayValue.startsWith('/storage'))) {
                div.innerHTML = `
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">${key}</label>
                    <a href="${displayValue}" target="_blank" class="text-primary hover:underline font-medium text-sm flex items-center gap-1 mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        Lihat File (tidak bisa diubah)
                    </a>
                    <input type="hidden" name="data[${key}]" value="${displayValue}">
                `;
            } else {
                const isLong = displayValue && displayValue.length > 80;
                if (isLong) {
                    div.innerHTML = `
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">${key}</label>
                        <textarea name="data[${key}]" rows="3" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-primary transition-all outline-none text-sm">${displayValue || ''}</textarea>
                    `;
                } else {
                    div.innerHTML = `
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">${key}</label>
                        <input type="text" name="data[${key}]" value="${displayValue || ''}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-primary transition-all outline-none text-sm">
                    `;
                }
            }
            content.appendChild(div);
        }

        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }
</script>
@endsection

