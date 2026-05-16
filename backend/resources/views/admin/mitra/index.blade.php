@extends('layouts.admin')

@section('header', 'Manajemen Mitra')

@section('content')
<div x-data="{ 
    showSectionModal: false, 
    showLogoModal: false,
    editMode: false,
    sectionForm: { id: '', name: '' },
    logoForm: { id: '', section_id: '', name: '' },
    
    openAddSection() {
        this.editMode = false;
        this.sectionForm = { id: '', name: '' };
        this.showSectionModal = true;
    },
    
    openEditSection(section) {
        this.editMode = true;
        this.sectionForm = { id: section.id, name: section.name };
        this.showSectionModal = true;
    },
    
    openAddLogo(sectionId) {
        this.editMode = false;
        this.logoForm = { id: '', section_id: sectionId, name: '' };
        this.showLogoModal = true;
    },
    
    openEditLogo(logo) {
        this.editMode = true;
        this.logoForm = { 
            id: logo.id, 
            section_id: logo.mitra_section_id, 
            name: logo.name
        };
        this.showLogoModal = true;
    }
}" class="space-y-10 pb-20">

    @if(session('success'))
        <div id="alert-success" class="bg-primary text-white p-4 rounded-2xl shadow-lg shadow-primary/20 flex items-center justify-between gap-3 animate-bounce">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div id="alert-error" class="bg-red-500 text-white p-4 rounded-2xl shadow-lg shadow-red-500/20 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            <button type="button" onclick="document.getElementById('alert-error').remove()" class="text-white hover:text-gray-200 focus:outline-none p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-zinc-800">Daftar Mitra</h2>
            <p class="text-sm text-gray-400">Kelola section dan logo mitra yang tampil di halaman Sinergi Kebaikan.</p>
        </div>
        <button @click="openAddSection()" class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20 flex items-center gap-2 shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Section
        </button>
    </div>

    <!-- Sections List -->
    <div class="space-y-6">
        @forelse($sections as $section)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary font-bold">
                        {{ $loop->iteration }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-zinc-800">{{ $section->name }}</h3>
                        <p class="text-xs text-gray-400">{{ $section->logos->count() }} Logo Terdaftar</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="openAddLogo({{ $section->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-all" title="Tambah Logo">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </button>
                    <button @click="openEditSection({{ Js::from($section) }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit Section">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button type="button" onclick="openDeleteModal('delete-section-{{ $section->id }}')" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Hapus Section">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                    <x-admin.delete-modal id="delete-section-{{ $section->id }}" :action="route('admin.mitra.section.destroy', $section->id)" title="Hapus Section" message="Apakah Anda yakin ingin menghapus section '{{ $section->name }}' beserta semua logo di dalamnya?" />
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sortable-logo-list" data-section-id="{{ $section->id }}">
                    @forelse($section->logos as $logo)
                    <div class="border border-gray-100 rounded-2xl p-4 hover:border-primary/30 transition-all group relative flex flex-col items-center text-center cursor-move bg-white logo-item" data-id="{{ $logo->id }}">
                        <div class="relative w-full">
                            <!-- Action buttons (hover) -->
                            <div class="absolute top-0 right-0 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                <button @click="openEditLogo({{ Js::from($logo) }})" class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-md transition-all bg-white/80 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button type="button" onclick="openDeleteModal('delete-logo-{{ $logo->id }}')" class="p-1.5 text-red-500 hover:bg-red-50 rounded-md transition-all bg-white/80 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                <x-admin.delete-modal id="delete-logo-{{ $logo->id }}" :action="route('admin.mitra.logo.destroy', $logo->id)" title="Hapus Logo" message="Apakah Anda yakin ingin menghapus logo '{{ $logo->name }}'?" />
                            </div>
                        </div>
                        <!-- Logo image -->
                        <div class="h-16 w-full bg-gray-50 rounded-xl flex items-center justify-center p-2 mb-3">
                            <img src="{{ asset('uploads/' . $logo->logo) }}" alt="{{ $logo->name }}" class="max-h-full max-w-full object-contain">
                        </div>
                        <p class="text-xs font-medium text-zinc-700 truncate w-full">{{ $logo->name }}</p>
                    </div>
                    @empty
                    <div class="col-span-full py-8 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100">
                        <p class="text-gray-400 text-sm italic">Belum ada logo untuk section ini.</p>
                        <button @click="openAddLogo({{ $section->id }})" class="mt-2 text-primary font-bold text-sm hover:underline">+ Tambah Logo</button>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        @empty
        <div class="py-20 text-center bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-zinc-800">Tidak ada section mitra</h3>
            <p class="text-gray-400 max-w-xs mx-auto mt-2">Mulai dengan menambahkan section seperti Media Partner, Stakeholder Support, dll.</p>
            <button @click="openAddSection()" class="mt-6 bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                Tambah Section Pertama
            </button>
        </div>
        @endforelse
    </div>

    <!-- Section Modal -->
    <div x-show="showSectionModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div @click="showSectionModal = false" class="fixed inset-0 transition-opacity bg-dark/60 backdrop-blur-sm"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="editMode ? '{{ url('admin/mitra/section') }}/' + sectionForm.id : '{{ route('admin.mitra.section.store') }}'" method="POST">
                    @csrf
                    <template x-if="editMode">
                        @method('PUT')
                    </template>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-zinc-800" x-text="editMode ? 'Edit Section' : 'Tambah Section'"></h3>
                            <button type="button" @click="showSectionModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Section</label>
                                <input type="text" name="name" x-model="sectionForm.name" required class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Contoh: Media Partner, Stakeholder Support">
                            </div>
                        </div>
                    </div>
                    <div class="p-8 bg-gray-50 flex gap-4">
                        <button type="button" @click="showSectionModal = false" class="flex-1 px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-all">Batal</button>
                        <button type="submit" class="flex-1 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20" x-text="editMode ? 'Simpan Perubahan' : 'Tambah Section'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logo Modal -->
    <div x-show="showLogoModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div @click="showLogoModal = false" class="fixed inset-0 transition-opacity bg-dark/60 backdrop-blur-sm"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="editMode ? '{{ url('admin/mitra/logo') }}/' + logoForm.id : '{{ route('admin.mitra.logo.store') }}'" method="POST" enctype="multipart/form-data">
                    @csrf
                    <template x-if="editMode">
                        @method('PUT')
                    </template>
                    <input type="hidden" name="mitra_section_id" x-model="logoForm.section_id">
                    
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-zinc-800" x-text="editMode ? 'Edit Logo Mitra' : 'Tambah Logo Mitra'"></h3>
                            <button type="button" @click="showLogoModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Mitra</label>
                                <input type="text" name="name" x-model="logoForm.name" required class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Contoh: BNI, Tribun Jatim">
                            </div>
                            
                            <div x-data="{ preview: null }">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Logo <span x-show="!editMode" class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="file" name="logo" :required="!editMode" accept="image/*" class="hidden" id="logo-upload" 
                                        @change="
                                            const file = $event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => { preview = e.target.result; };
                                                reader.readAsDataURL(file);
                                            }
                                        ">
                                    <label for="logo-upload" class="cursor-pointer flex flex-col items-center justify-center w-full h-40 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl hover:border-primary/50 hover:bg-primary/5 transition-all">
                                        <template x-if="preview">
                                            <img :src="preview" class="max-h-32 max-w-full object-contain p-2">
                                        </template>
                                        <template x-if="!preview">
                                            <div class="text-center p-4">
                                                <svg class="mx-auto h-10 w-10 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-2 text-sm text-gray-500">Klik untuk upload logo</p>
                                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, SVG, WebP (Max 2MB)</p>
                                            </div>
                                        </template>
                                    </label>
                                </div>
                                <p x-show="editMode" class="text-xs text-gray-400 mt-2 italic">*Kosongkan jika tidak ingin mengganti logo</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8 bg-gray-50 flex gap-4">
                        <button type="button" @click="showLogoModal = false" class="flex-1 px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-all">Batal</button>
                        <button type="submit" class="flex-1 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20" x-text="editMode ? 'Simpan Perubahan' : 'Tambah Logo'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoLists = document.querySelectorAll('.sortable-logo-list');
        logoLists.forEach(list => {
            new Sortable(list, {
                animation: 150,
                ghostClass: 'opacity-50',
                draggable: '.logo-item',
                onEnd: function (evt) {
                    const sectionId = list.getAttribute('data-section-id');
                    const items = list.querySelectorAll('.logo-item');
                    const orders = [];
                    items.forEach((item, index) => {
                        orders.push({
                            id: item.getAttribute('data-id'),
                            order: index + 1
                        });
                    });

                    fetch('{{ route("admin.mitra.update-order") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            type: 'logo',
                            orders: orders
                        })
                    }).then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            // Optional: Show a small toast or just let it be since it's instant
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
