@extends('layouts.admin')

@section('header', 'Edit Map Provinsi')

@section('content')
    <div class="space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.home.edit', ['tab' => 'stats']) }}"
                class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-500 hover:bg-primary hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-dark">Edit Provinsi: {{ $province->name }}</h1>
                <p class="text-gray-500 mt-1">Kelola data penyebaran dan dokumentasi aksi kebaikan.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] p-4 sm:p-10 shadow-xl border border-white relative overflow-hidden">
            <form action="{{ route('admin.provinces.update', $province->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
                    <div class="xl:col-span-2 space-y-6">
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <label class="flex items-center gap-4 cursor-pointer">
                                <input type="checkbox" name="is_active" class="peer sr-only" {{ $province->is_active ? 'checked' : '' }}>
                                <div
                                    class="relative w-14 h-8 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-1 after:left-1 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary">
                                </div>
                                <div>
                                    <span class="font-bold text-dark text-lg">Aktifkan Wilayah Ini di Map</span>
                                    <p class="text-sm text-gray-500 mt-1">Jika aktif, provinsi akan ditandai warna Hijau Tua
                                        di Map Utama.</p>
                                </div>
                            </label>
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Total Penerima Manfaat <span
                                    class="text-xs text-gray-400 font-normal ml-2">(Contoh: 18,200)</span></label>
                            <input type="text" name="beneficiaries" value="{{ $province->beneficiaries }}"
                                class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none font-bold text-xl">
                        </div>

                        <div>
                            <label class="block font-bold mb-2">Total Dana Disalurkan <span
                                    class="text-xs text-gray-400 font-normal ml-2">(Contoh: Rp 1.8M)</span></label>
                            <input type="text" name="funds" value="{{ $province->funds }}"
                                class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary transition-all outline-none font-bold text-xl">
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-primary">Quote / Pesan Harapan</label>
                            <textarea name="quote" rows="3"
                                class="w-full px-6 py-4 rounded-2xl bg-[#7FC248]/5 border border-[#7FC248]/20 focus:bg-white focus:border-primary transition-all outline-none italic font-medium text-dark">{{ $province->quote }}</textarea>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-dark mb-2">Dokumentasi Aksi Nyata</h3>
                        <p class="text-sm text-gray-500 mb-2">Upload gambar-gambar yang menunjukkan bukti penyaluran program
                            di provinsi ini.</p>

                        <div class="grid grid-cols-2 gap-4" id="province-preview-container">
                            @foreach($province->images ?? [] as $img)
                                <div
                                    class="group relative aspect-square bg-gray-100 rounded-2xl overflow-hidden border border-gray-200">
                                    <img src="{{ $img }}" class="w-full h-full object-cover">
                                    <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                        <button type="button" onclick="this.closest('.relative').remove()"
                                            class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                            <label id="province-upload-box"
                                class="cursor-pointer flex flex-col items-center justify-center aspect-square border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary hover:bg-primary/5 transition-all group">
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

    <script>
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
                        const div = document.createElement('div');
                        div.className = 'group relative aspect-square bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 shadow-sm';
                        div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute top-2 left-2 bg-primary text-white text-[10px] px-2 py-1 rounded-full font-bold shadow">BARU</div>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                            <button type="button" onclick="this.closest('.contents').remove()" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all" title="Hapus Batch Ini">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    `;
                        batchDiv.appendChild(div);
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