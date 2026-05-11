@extends('layouts.admin')

@section('header', 'Manajemen No. Rekening')

@section('content')
<div x-data="{ 
    showCategoryModal: false, 
    showBankModal: false,
    editMode: false,
    activeCategory: null,
    activeBank: null,
    categoryForm: { id: '', name: '' },
    bankForm: { id: '', category_id: '', bank_name: '', account_number: '', logo: '' },
    
    openAddCategory() {
        this.editMode = false;
        this.categoryForm = { id: '', name: '' };
        this.showCategoryModal = true;
    },
    
    openEditCategory(cat) {
        this.editMode = true;
        this.categoryForm = { id: cat.id, name: cat.name };
        this.showCategoryModal = true;
    },
    
    openAddBank(categoryId) {
        this.editMode = false;
        this.bankForm = { id: '', category_id: categoryId, bank_name: '', account_number: '', logo: '' };
        this.showBankModal = true;
    },
    
    openEditBank(bank) {
        this.editMode = true;
        this.bankForm = { 
            id: bank.id, 
            category_id: bank.rekening_category_id, 
            bank_name: bank.bank_name, 
            account_number: bank.account_number, 
            logo: bank.logo 
        };
        this.showBankModal = true;
    }
}" class="space-y-10 pb-20">

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
        <p class="font-bold">Berhasil</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- Hero Image Management -->
    <section class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-zinc-800">Banner Hero</h2>
                <p class="text-sm text-gray-400">Ganti banner utama pada halaman Pilihan Rekening Donasi.</p>
            </div>
        </div>
        <div class="p-8">
            <form action="{{ route('admin.rekening.update-hero') }}" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-2 gap-10">
                @csrf
                <div class="space-y-4">
                    <div class="relative group aspect-[16/6] rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex items-center justify-center">
                        @if(isset($hero->content['image']))
                            <img src="{{ $hero->content['image'] }}" class="w-full h-full object-cover">
                            <input type="hidden" name="existing_image" value="{{ $hero->content['image'] }}">
                        @else
                            <div class="text-center p-6">
                                <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-500">Belum ada gambar hero</p>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                             <label class="cursor-pointer bg-white text-zinc-800 px-4 py-2 rounded-xl font-bold text-sm shadow-xl">
                                Ganti Gambar
                                <input type="file" name="image" class="hidden" onchange="this.form.submit()">
                             </label>
                        </div>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-2xl">
                        <h4 class="text-sm font-bold text-blue-800 mb-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tips Ukuran Gambar
                        </h4>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            Gunakan gambar dengan resolusi minimal <strong>1920x600 piksel</strong> untuk hasil terbaik. Pastikan subjek utama gambar berada di tengah agar tetap terlihat baik di berbagai perangkat (responsif). Format yang disarankan: <strong>JPG atau WebP</strong> dengan ukuran file di bawah 2MB.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="font-bold text-zinc-800 mb-2 text-lg">Informasi Tambahan</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Banner ini akan muncul sebagai background di bagian atas halaman No. Rekening. Pastikan gambar tidak terlalu ramai agar teks judul tetap mudah dibaca oleh donatur.
                    </p>
                    <div class="mt-6">
                        <button type="submit" class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Categories and Banks Management -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-zinc-800">Daftar Rekening</h2>
            <p class="text-sm text-gray-400">Kelola kategori dan daftar nomor rekening bank.</p>
        </div>
        <button @click="openAddCategory()" class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </button>
    </div>

    <div class="space-y-6">
        @forelse($categories as $category)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary font-bold">
                        {{ $loop->iteration }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-zinc-800">{{ $category->name }}</h3>
                        <p class="text-xs text-gray-400">{{ $category->banks->count() }} Rekening Terdaftar</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="openAddBank({{ $category->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-all" title="Tambah Rekening">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </button>
                    <button @click="openEditCategory({{ Js::from($category) }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-all" title="Edit Kategori">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <button type="button" onclick="openDeleteModal('delete-category-{{ $category->id }}')" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Hapus Kategori">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                    <x-admin.delete-modal id="delete-category-{{ $category->id }}" :action="route('admin.rekening.category.destroy', $category->id)" title="Hapus Kategori" message="Apakah Anda yakin ingin menghapus kategori '{{ $category->name }}' beserta semua rekening di dalamnya?" />
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($category->banks as $bank)
                    <div class="border border-gray-100 rounded-2xl p-5 hover:border-primary/30 transition-all group relative">
                        <div class="flex items-start justify-between mb-4">
                            <div class="h-10 w-24 bg-gray-50 rounded-lg flex items-center justify-center p-2">
                                @if($bank->logo)
                                    <img src="{{ asset('images/logo bank/' . $bank->logo) }}" alt="{{ $bank->bank_name }}" class="max-h-full max-w-full object-contain">
                                @else
                                    <span class="text-[10px] text-gray-400">No Logo</span>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button @click="openEditBank({{ Js::from($bank) }})" class="p-1.5 text-blue-500 hover:bg-blue-50 rounded-md transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button type="button" onclick="openDeleteModal('delete-bank-{{ $bank->id }}')" class="p-1.5 text-red-500 hover:bg-red-50 rounded-md transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                <x-admin.delete-modal id="delete-bank-{{ $bank->id }}" :action="route('admin.rekening.bank.destroy', $bank->id)" title="Hapus Rekening" message="Apakah Anda yakin ingin menghapus rekening {{ $bank->bank_name }} - {{ $bank->account_number }}?" />
                            </div>
                        </div>
                        <h4 class="font-bold text-zinc-800">{{ $bank->bank_name }}</h4>
                        <p class="text-primary font-bold text-lg tracking-wider">{{ $bank->account_number }}</p>
                        <p class="text-[10px] text-gray-400 mt-2 uppercase tracking-widest font-medium">a.n Yayasan Taman Zakat Indonesia</p>
                    </div>
                    @empty
                    <div class="col-span-full py-8 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100">
                        <p class="text-gray-400 text-sm italic">Belum ada data rekening untuk kategori ini.</p>
                        <button @click="openAddBank({{ $category->id }})" class="mt-2 text-primary font-bold text-sm hover:underline">+ Tambah Rekening</button>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        @empty
        <div class="py-20 text-center bg-white rounded-3xl shadow-sm border border-gray-100">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-zinc-800">Tidak ada kategori</h3>
            <p class="text-gray-400 max-w-xs mx-auto mt-2">Mulai dengan menambahkan kategori seperti Zakat, Infaq, atau Jariah.</p>
            <button @click="openAddCategory()" class="mt-6 bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                Tambah Kategori Pertama
            </button>
        </div>
        @endforelse
    </div>

    <!-- Category Modal -->
    <div x-show="showCategoryModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div @click="showCategoryModal = false" class="fixed inset-0 transition-opacity bg-dark/60 backdrop-blur-sm"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="editMode ? '{{ url('admin/rekening/category') }}/' + categoryForm.id : '{{ route('admin.rekening.category.store') }}'" method="POST">
                    @csrf
                    <template x-if="editMode">
                        @method('PUT')
                    </template>
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-zinc-800" x-text="editMode ? 'Edit Kategori' : 'Tambah Kategori'"></h3>
                            <button type="button" @click="showCategoryModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
                                <input type="text" name="name" x-model="categoryForm.name" required class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Contoh: Zakat, Infaq, dll">
                            </div>
                        </div>
                    </div>
                    <div class="p-8 bg-gray-50 flex gap-4">
                        <button type="button" @click="showCategoryModal = false" class="flex-1 px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-all">Batal</button>
                        <button type="submit" class="flex-1 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20" x-text="editMode ? 'Simpan Perubahan' : 'Tambah Kategori'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bank Modal -->
    <div x-show="showBankModal" class="fixed inset-0 z-[100] overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div @click="showBankModal = false" class="fixed inset-0 transition-opacity bg-dark/60 backdrop-blur-sm"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <form :action="editMode ? '{{ url('admin/rekening/bank') }}/' + bankForm.id : '{{ route('admin.rekening.bank.store') }}'" method="POST">
                    @csrf
                    <template x-if="editMode">
                        @method('PUT')
                    </template>
                    <input type="hidden" name="rekening_category_id" x-model="bankForm.category_id">
                    
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-zinc-800" x-text="editMode ? 'Edit Rekening' : 'Tambah Rekening'"></h3>
                            <button type="button" @click="showBankModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Bank</label>
                                    <input type="text" name="bank_name" x-model="bankForm.bank_name" required class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="Contoh: BNI, Mandiri">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Rekening</label>
                                    <input type="text" name="account_number" x-model="bankForm.account_number" required class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="000-000-000">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Logo Bank</label>
                                <div class="grid grid-cols-3 gap-3 p-3 bg-gray-50 rounded-2xl max-h-[200px] overflow-y-auto border border-gray-100">
                                    @foreach($logos as $logo)
                                    <label class="cursor-pointer group relative">
                                        <input type="radio" name="logo" value="{{ $logo }}" x-model="bankForm.logo" class="hidden peer">
                                        <div class="aspect-square bg-white border-2 border-transparent peer-checked:border-primary peer-checked:bg-primary/5 rounded-xl flex items-center justify-center p-2 transition-all hover:border-gray-300">
                                            <img src="{{ asset('images/logo bank/' . $logo) }}" class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 peer-checked:grayscale-0">
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2 italic">*Logo yang tampil diambil dari folder public/images/logo bank</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8 bg-gray-50 flex gap-4">
                        <button type="button" @click="showBankModal = false" class="flex-1 px-6 py-3 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition-all">Batal</button>
                        <button type="submit" class="flex-1 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20" x-text="editMode ? 'Simpan Perubahan' : 'Tambah Rekening'"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
