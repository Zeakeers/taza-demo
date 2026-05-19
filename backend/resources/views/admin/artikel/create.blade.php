@extends('layouts.admin')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.artikel.index') }}"
            class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        Tambah Artikel Baru
    </div>
@endsection

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-zinc-800">Tulis Artikel Baru</h2>
        <p class="text-gray-500 text-sm mt-1">Buat artikel baru untuk ditampilkan di website.</p>
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

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data"
        class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Konten Artikel
                </h3>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Judul Artikel <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                            placeholder="Masukkan judul artikel..."
                            class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="hidden" name="kategori" id="kategori-input" value="{{ old('kategori') }}" required>
                        <div class="relative" id="kategori-dropdown">
                            <button type="button" onclick="toggleKategoriDropdown()"
                                class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all text-left flex items-center justify-between">
                                <span id="kategori-label" class="text-zinc-400">-- Pilih Kategori --</span>
                                <svg id="kategori-chevron" class="w-5 h-5 text-gray-400 transition-transform duration-200 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="kategori-options" class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden hidden">
                                <div class="py-1">
                                    <div onclick="selectKategori('Aksi Taman Zakat')" class="kategori-option px-4 py-3 text-sm text-zinc-700 cursor-pointer hover:bg-[#F2F9EC] hover:text-primary transition-colors">Aksi Taman Zakat</div>
                                    <div onclick="selectKategori('Report Program')" class="kategori-option px-4 py-3 text-sm text-zinc-700 cursor-pointer hover:bg-[#F2F9EC] hover:text-primary transition-colors">Report Program</div>
                                    <div onclick="selectKategori('Annual Report')" class="kategori-option px-4 py-3 text-sm text-zinc-700 cursor-pointer hover:bg-[#F2F9EC] hover:text-primary transition-colors">Annual Report</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Tags / Label</label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
                            placeholder="Contoh: TamanZakat, ArtikelTerkini, Sosial (pisahkan dengan koma)"
                            class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Isi Konten Artikel <span
                                class="text-red-500">*</span></label>
                        <textarea id="konten-editor" name="konten" rows="12" placeholder="Tuliskan isi artikel di sini..."
                            class="w-full bg-gray-50 border border-gray-200 text-zinc-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-y">{{ old('konten') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Sidebar Options -->
            <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                <h3 class="text-lg font-bold text-zinc-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Media & Pengaturan
                </h3>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-zinc-700 mb-2">Thumbnail / Gambar <span
                                class="text-red-500">*</span></label>
                        <label for="file-upload"
                            class="mt-1 flex flex-col items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer relative overflow-hidden group">
                            <div class="space-y-1 text-center py-6 w-full" id="upload-placeholder">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-primary transition-colors"
                                    stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <span
                                        class="relative cursor-pointer rounded-md font-medium text-primary hover:text-primary/80 focus-within:outline-none">
                                        <span>Upload file gambar</span>
                                        <input id="file-upload" name="thumbnail" type="file" required class="sr-only"
                                            accept="image/*" onchange="previewImage(this)">
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                            <img id="image-preview" class="w-full object-contain hidden" />

                            <!-- Overlay untuk ganti gambar saat hover -->
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none hidden"
                                id="hover-overlay">
                                <span class="text-white font-medium text-sm">Klik untuk mengubah gambar</span>
                            </div>
                            <input id="file-upload-overlay" name="thumbnail_overlay" type="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer hidden" accept="image/*"
                                onchange="document.getElementById('file-upload').files = this.files; previewImage(this)">
                        </label>
                    </div>

                    <hr class="border-gray-100">

                    <div class="space-y-4">
                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home') ? 'checked' : '' }}
                                class="w-5 h-5 text-primary focus:ring-primary rounded border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-zinc-800">Tampilkan di Home</span>
                                <span class="text-xs text-gray-500">Artikel ini akan muncul di halaman utama</span>
                            </div>
                        </label>

                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors" title="Pilihan Editor hanya 1 artikel">
                            <input type="checkbox" name="is_editor_choice" value="1" {{ old('is_editor_choice') ? 'checked' : '' }}
                                class="w-5 h-5 text-yellow-500 focus:ring-yellow-500 rounded border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-zinc-800">Pilihan Editor</span>
                                <span class="text-xs text-gray-500">Hanya 1 artikel yang akan menjadi Pilihan Editor (akan menimpa yang sebelumnya jika terpilih)</span>
                            </div>
                        </label>

                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="w-5 h-5 text-green-500 focus:ring-green-500 rounded border-gray-300">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-zinc-800">Publish Langsung</span>
                                <span class="text-xs text-gray-500">Jika uncheck, artikel masuk ke Draft</span>
                            </div>
                        </label>
                    </div>

                    <hr class="border-gray-100">

                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('admin.artikel.index') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-zinc-600 px-6 py-3 rounded-xl font-bold transition-all text-center">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex-1 bg-primary hover:bg-primary/90 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-primary/30">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        /* Menyembunyikan logo "Powered by CKEditor" */
        .ck-powered-by {
            display: none !important;
        }
    </style>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('upload-placeholder').classList.add('hidden');

                    var hoverOverlay = document.getElementById('hover-overlay');
                    if (hoverOverlay) {
                        hoverOverlay.classList.remove('hidden');
                        document.getElementById('file-upload-overlay').classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.artikel.upload-image') }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${file.name}.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    resolve({
                        default: response.url
                    });
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            _sendRequest(file) {
                const data = new FormData();
                data.append('upload', file);
                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#konten-editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'imageUpload',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo'
                    ]
                },
                language: 'id'
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        // Custom Kategori Dropdown
        function toggleKategoriDropdown() {
            var options = document.getElementById('kategori-options');
            var chevron = document.getElementById('kategori-chevron');
            options.classList.toggle('hidden');
            chevron.style.transform = options.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }

        function selectKategori(value) {
            document.getElementById('kategori-input').value = value;
            document.getElementById('kategori-label').textContent = value;
            document.getElementById('kategori-label').classList.remove('text-zinc-400');
            document.getElementById('kategori-label').classList.add('text-zinc-800', 'font-medium');
            document.getElementById('kategori-options').classList.add('hidden');
            document.getElementById('kategori-chevron').style.transform = '';

            // Highlight selected option
            document.querySelectorAll('.kategori-option').forEach(function(el) {
                el.classList.remove('text-primary', 'font-bold', 'bg-[#F2F9EC]');
                if (el.textContent.trim() === value) {
                    el.classList.add('text-primary', 'font-bold', 'bg-[#F2F9EC]');
                }
            });
        }

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            var dropdown = document.getElementById('kategori-dropdown');
            if (dropdown && !dropdown.contains(e.target)) {
                document.getElementById('kategori-options').classList.add('hidden');
                document.getElementById('kategori-chevron').style.transform = '';
            }
        });

        // Restore old value if validation failed
        @if(old('kategori'))
            selectKategori('{{ old('kategori') }}');
        @endif
    </script>
@endsection