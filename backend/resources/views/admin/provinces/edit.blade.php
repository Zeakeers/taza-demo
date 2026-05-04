@extends('layouts.admin')

@section('header', 'Edit Map Provinsi')

@section('content')
    <div class="space-y-8">
        <div class="flex items-start lg:items-center gap-4">
            <a href="{{ route('admin.home.edit', ['tab' => 'stats']) }}"
                class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-all shrink-0 mt-1 lg:mt-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl lg:text-3xl font-bold text-dark">Edit Provinsi: {{ $province->name }}</h1>
                <p class="text-gray-400 text-xs lg:text-base mt-1">Kelola data penyebaran dan dokumentasi aksi kebaikan.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] p-4 sm:p-10 shadow-xl border border-white relative overflow-hidden">
            <form action="{{ route('admin.provinces.update', $province->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <div class="bg-gray-50 p-4 lg:p-6 rounded-2xl border border-gray-100">
                            <label class="flex items-start lg:items-center gap-4 cursor-pointer">
                                <input type="checkbox" name="is_active" class="peer sr-only" {{ $province->is_active ? 'checked' : '' }}>
                                <div
                                    class="relative shrink-0 w-12 lg:w-14 h-7 lg:h-8 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-5 lg:peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 lg:after:h-6 after:w-5 lg:after:w-6 after:transition-all peer-checked:bg-primary">
                                </div>
                                <div>
                                    <span class="font-bold text-dark text-base lg:text-lg">Aktifkan Wilayah Ini di Map</span>
                                    <p class="text-[10px] lg:text-sm text-gray-400 mt-1">Jika aktif, provinsi akan ditandai warna Hijau Tua di Map Utama.</p>
                                </div>
                            </label>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-sm lg:text-base">Total Penerima Manfaat <span
                                    class="text-[10px] lg:text-xs text-gray-400 font-normal ml-2">(Contoh: 18,200)</span></label>
                            <input type="text" name="beneficiaries" value="{{ $province->beneficiaries }}"
                                class="w-full px-4 lg:px-6 py-3 lg:py-4 rounded-xl lg:rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none font-bold text-lg lg:text-xl">
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-sm lg:text-base">Total Dana Disalurkan <span
                                    class="text-[10px] lg:text-xs text-gray-400 font-normal ml-2">(Contoh: Rp 1.8M)</span></label>
                            <input type="text" name="funds" value="{{ $province->funds }}"
                                class="w-full px-4 lg:px-6 py-3 lg:py-4 rounded-xl lg:rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none font-bold text-lg lg:text-xl">
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-sm lg:text-base text-primary">Quote / Pesan Harapan</label>
                            <textarea name="quote" rows="3"
                                class="w-full px-4 lg:px-6 py-3 lg:py-4 rounded-xl lg:rounded-2xl bg-[#7FC248]/5 border border-[#7FC248]/20 focus:bg-white focus:border-primary transition-all outline-none italic font-medium text-dark text-sm lg:text-base">{{ $province->quote }}</textarea>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-dark mb-2">Dokumentasi Aksi Nyata</h3>
                        <p class="text-sm text-gray-500 mb-2">Upload gambar-gambar yang menunjukkan bukti penyaluran program
                            di provinsi ini.</p>

                        <div class="grid grid-cols-2 gap-4 auto-rows-max" id="province-preview-container">
                            @foreach($province->images ?? [] as $i => $img)
                                            @php
                                                $imgUrl = is_array($img) ? ($img['url'] ?? '') : $img;
                                                $imgTitle = is_array($img) ? ($img['title'] ?? '') : '';
                                                $imgDesc = is_array($img) ? ($img['description'] ?? '') : '';
                                            @endphp
                                 <div
                                                class="bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden shadow-sm relative group contents-existing opacity-0 transition-opacity duration-500">
                                                <div class="image-wrapper aspect-video bg-gray-100 relative">
                                                    <img src="{{ $imgUrl }}" class="w-full h-full object-cover" onload="adjustExistingCard(this)" onerror="this.closest('.contents-existing').classList.remove('opacity-0')">
                                                    <input type="hidden" name="existing_images[{{ $i }}][url]" value="{{ $imgUrl }}">
                                                    <div
                                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center z-10">
                                                        <button type="button" onclick="window.itemToDelete = this.closest('.contents-existing'); openDeleteModal('delete-image-modal', 'window.itemToDelete.remove()')"
                                                            class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all shadow-lg">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-wrapper p-5 space-y-4">
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-600 mb-2">Judul Program</label>
                                                        <input type="text" name="existing_images[{{ $i }}][title]" value="{{ $imgTitle }}"
                                                            class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-base focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                                            placeholder="Contoh: Bantuan Beras">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-bold text-gray-600 mb-2">Deskripsi Singkat</label>
                                                        <textarea name="existing_images[{{ $i }}][description]" maxlength="100" rows="3"
                                                            class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-base focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                                                            placeholder="Tuliskan deskripsi maksimal 100 karakter...">{{ $imgDesc }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                            @endforeach

                            <label id="province-upload-box"
                                class="cursor-pointer flex flex-col items-center justify-center aspect-video border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary hover:bg-primary/5 transition-all group">
                                <svg class="w-8 h-8 text-gray-300 group-hover:text-primary transition-colors" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span
                                    class="text-xs font-bold text-gray-400 group-hover:text-primary mt-2 transition-colors">Tambah
                                    Gambar</span>
                                <input type="file" name="new_images[]" multiple class="hidden"
                                    onchange="previewNewImages(this)">
                            </label>
                        </div>
                    </div>
                </div>
        </div>

        <div class="mt-10 pt-8 border-t border-gray-100 flex justify-end">
            <button type="submit"
                class="bg-primary hover:bg-dark text-white px-10 py-4 rounded-2xl font-bold transition-all shadow-xl shadow-primary/20 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
        </form>
    </div>
    </div>

    <!-- Modal Konfirmasi Hapus Gambar -->
    <x-admin.delete-modal id="delete-image-modal" action="js" title="Hapus Gambar" message="Apakah Anda yakin ingin menghapus gambar dokumentasi ini?" />

    <script>
        function adjustExistingCard(img) {
            const card = img.closest('.contents-existing');
            const wrapper = img.closest('.image-wrapper');
            const formWrapper = card.querySelector('.form-wrapper');
            const isPortrait = img.naturalHeight > img.naturalWidth;

            if (isPortrait) {
                card.className = "bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden shadow-sm relative group contents-existing col-span-2 flex flex-col sm:flex-row items-stretch";
                wrapper.className = "image-wrapper relative bg-gray-100 shrink-0 sm:w-1/3 aspect-[3/4] sm:aspect-auto";
                img.className = "w-full h-full object-cover sm:absolute sm:inset-0";
                if(formWrapper) formWrapper.className = "form-wrapper w-full sm:w-2/3 p-5 space-y-4";
            } else {
                card.className = "bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden shadow-sm relative group contents-existing col-span-1 flex flex-col";
                wrapper.className = "image-wrapper relative bg-gray-100 shrink-0 aspect-video";
                img.className = "w-full h-full object-cover";
                if(formWrapper) formWrapper.className = "form-wrapper p-5 space-y-4";
            }
            card.classList.remove('opacity-0');
        }

        function previewNewImages(input) {
            const container = document.getElementById('province-preview-container');
            const uploadBox = document.getElementById('province-upload-box');

            if (input.files && input.files.length > 0) {
                input.style.display = 'none';
                input.classList.remove('hidden');

                const batchDiv = document.createElement('div');
                batchDiv.className = 'contents';
                batchDiv.appendChild(input);

                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const imgObj = new Image();
                        imgObj.onload = function() {
                            const isPortrait = imgObj.naturalHeight > imgObj.naturalWidth;
                            const div = document.createElement('div');
                            
                            if (isPortrait) {
                                div.className = 'bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden shadow-sm relative group contents-existing col-span-2 flex flex-col sm:flex-row items-stretch';
                                div.innerHTML = `
                                    <div class="relative bg-gray-100 shrink-0 sm:w-1/3 aspect-[3/4] sm:aspect-auto">
                                        <img src="${e.target.result}" class="w-full h-full object-cover sm:absolute sm:inset-0">
                                        <div class="absolute top-2 left-2 bg-primary text-white text-[10px] px-2 py-1 rounded-full font-bold shadow z-20">BARU</div>
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center z-10">
                                            <button type="button" onclick="window.itemToDelete = this.closest('.contents'); openDeleteModal('delete-image-modal', 'window.itemToDelete.remove()')" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all shadow-lg" title="Hapus Batch Ini">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="w-full sm:w-2/3 p-5 space-y-4">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-600 mb-2">Judul Program</label>
                                            <input type="text" name="new_images_titles[]" class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-base focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Contoh: Bantuan Beras">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-600 mb-2">Deskripsi Singkat</label>
                                            <textarea name="new_images_descriptions[]" maxlength="100" rows="3" class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-base focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Tuliskan deskripsi maksimal 100 karakter..."></textarea>
                                        </div>
                                    </div>
                                `;
                            } else {
                                div.className = 'bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden shadow-sm relative group contents-existing col-span-1 flex flex-col';
                                div.innerHTML = `
                                    <div class="relative bg-gray-100 shrink-0 aspect-video">
                                        <img src="${e.target.result}" class="w-full h-full object-cover">
                                        <div class="absolute top-2 left-2 bg-primary text-white text-[10px] px-2 py-1 rounded-full font-bold shadow">BARU</div>
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center z-10">
                                            <button type="button" onclick="window.itemToDelete = this.closest('.contents'); openDeleteModal('delete-image-modal', 'window.itemToDelete.remove()')" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all shadow-lg" title="Hapus Batch Ini">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="p-5 space-y-4">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-600 mb-2">Judul Program</label>
                                            <input type="text" name="new_images_titles[]" class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-base focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Contoh: Bantuan Beras">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-gray-600 mb-2">Deskripsi Singkat</label>
                                            <textarea name="new_images_descriptions[]" maxlength="100" rows="3" class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-base focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" placeholder="Tuliskan deskripsi maksimal 100 karakter..."></textarea>
                                        </div>
                                    </div>
                                `;
                            }
                            batchDiv.appendChild(div);
                        };
                        imgObj.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                });

                container.insertBefore(batchDiv, uploadBox);

                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'new_images[]';
                newInput.multiple = true;
                newInput.className = 'hidden';
                newInput.onchange = function () { previewNewImages(this); };
                uploadBox.appendChild(newInput);
            }
        }
    </script>
@endsection