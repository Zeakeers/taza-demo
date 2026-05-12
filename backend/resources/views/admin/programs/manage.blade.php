@extends('layouts.admin')

@section('title', 'Manajemen ' . $config['title'])

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $config['title'] }}</h1>
        <p class="text-gray-500 mt-2">Kelola konten dan gambar untuk halaman {{ $config['title'] }}.</p>
    </div>
</div>

<form action="{{ route('admin.program.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-10 pb-32">
    @csrf

    @foreach($config['sections'] as $secKey => $section)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">{{ $section['label'] }}</h2>
        </div>

        @if(isset($section['is_repeater']) && $section['is_repeater'])
            @php 
                $rName = $section['repeater_name']; 
                $items = $data[$rName] ?? [];
                // default to 1 empty item if empty
                if(empty($items)) $items = [[]];
            @endphp
            <div x-data="repeaterHandler({{ json_encode($items) }})" class="space-y-6">
                <template x-for="(item, index) in items" :key="index">
                    <div class="p-6 border border-gray-200 rounded-xl bg-gray-50 relative group">
                        <button type="button" @click="removeItem(index)" class="absolute top-4 right-4 text-red-500 hover:bg-red-50 p-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4" x-text="`Item ${index + 1}`"></h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($section['repeater_fields'] as $field)
                                @php $fName = $field['name']; @endphp
                                <div class="{{ $field['type'] == 'textarea' ? 'col-span-full' : '' }}">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">{{ $field['label'] }}</label>
                                    
                                    @if($field['type'] == 'text')
                                        <input type="text" :name="`{{ $rName }}[${index}][{{ $fName }}]`" x-model="item.{{ $fName }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                                    @elseif($field['type'] == 'textarea')
                                        <textarea :name="`{{ $rName }}[${index}][{{ $fName }}]`" x-model="item.{{ $fName }}" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"></textarea>
                                    @elseif($field['type'] == 'image')
                                        <div class="mt-2">
                                            <!-- Existing Image Preview -->
                                            <template x-if="item.{{ $fName }}">
                                                <div class="relative w-48 aspect-video rounded-xl overflow-hidden border border-gray-200 mb-3 group/img bg-white flex items-center justify-center" :id="`img_container_${index}_{{ $fName }}`">
                                                    <img :src="item.{{ $fName }}" class="max-h-full max-w-full object-contain">
                                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center">
                                                        <button type="button" @click="removeImage(index, '{{ $fName }}')" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600">Hapus</button>
                                                    </div>
                                                </div>
                                            </template>
                                            
                                            <!-- Hidden inputs for existing image state -->
                                            <input type="hidden" :name="`existing_{{ $rName }}_${index}_{{ $fName }}`" :value="item.{{ $fName }}">
                                            <input type="hidden" :name="`remove_{{ $rName }}_${index}_{{ $fName }}`" :id="`remove_${index}_{{ $fName }}`" value="0">
                                            
                                            <!-- File Input -->
                                            <input type="file" :name="`{{ $rName }}[${index}][{{ $fName }}]`" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </template>
                
                <button type="button" @click="addItem()" class="w-full py-4 border-2 border-dashed border-gray-300 rounded-xl text-gray-500 font-bold hover:border-primary hover:text-primary hover:bg-primary/5 transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tambah Item Baru
                </button>
            </div>
            
            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('repeaterHandler', (initialItems) => ({
                        items: initialItems,
                        addItem() {
                            let newItem = {};
                            @foreach($section['repeater_fields'] as $f)
                                newItem.{{ $f['name'] }} = '';
                            @endforeach
                            this.items.push(newItem);
                        },
                        removeItem(index) {
                            if(confirm('Hapus item ini?')) {
                                this.items.splice(index, 1);
                            }
                        },
                        removeImage(index, fieldName) {
                            if(confirm('Hapus gambar ini?')) {
                                document.getElementById(`remove_${index}_${fieldName}`).value = '1';
                                document.getElementById(`img_container_${index}_${fieldName}`).style.display = 'none';
                            }
                        }
                    }))
                })
            </script>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($section['fields'] as $field)
                    @php 
                        $fName = $field['name']; 
                        $val = $data[$fName] ?? '';
                    @endphp
                    <div class="{{ $field['type'] == 'textarea' || $field['type'] == 'multiple_images' ? 'col-span-full' : '' }}">
                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ $field['label'] }}</label>
                        
                        @if($field['type'] == 'text')
                            <input type="text" name="{{ $fName }}" value="{{ $val }}" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        @elseif($field['type'] == 'textarea')
                            <textarea name="{{ $fName }}" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary transition-colors">{{ $val }}</textarea>
                        @elseif($field['type'] == 'image')
                            @if($val)
                                <div class="relative w-48 aspect-video rounded-xl overflow-hidden border border-gray-200 mb-3 group bg-gray-50 flex items-center justify-center">
                                    <img src="{{ $val }}" class="max-h-full max-w-full object-contain">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <button type="button" onclick="removeSingleImage('{{ $fName }}')" class="bg-red-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600">Hapus</button>
                                    </div>
                                </div>
                                <input type="hidden" name="existing_{{ $fName }}" value="{{ $val }}">
                                <input type="hidden" name="remove_{{ $fName }}" id="remove_{{ $fName }}" value="0">
                            @endif
                            <input type="file" name="{{ $fName }}" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors">
                            <script>
                                function removeSingleImage(name) {
                                    if(confirm('Hapus gambar ini?')) {
                                        document.getElementById('remove_' + name).value = '1';
                                        document.getElementById('remove_' + name).previousElementSibling.previousElementSibling.style.display = 'none';
                                    }
                                }
                            </script>
                        @elseif($field['type'] == 'multiple_images')
                            @php $arrImages = is_array($val) ? $val : []; @endphp
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="multi-preview-container-{{ $fName }}">
                                @foreach($arrImages as $idx => $imgUrl)
                                    <div class="group relative aspect-video bg-gray-100 rounded-2xl overflow-hidden border border-gray-200" id="multi_img_{{ $fName }}_{{ $idx }}">
                                        <img src="{{ $imgUrl }}" class="w-full h-full object-cover">
                                        <input type="hidden" name="existing_{{ $fName }}[]" value="{{ $imgUrl }}">
                                        <input type="hidden" name="remove_{{ $fName }}[{{ $idx }}]" id="remove_multi_{{ $fName }}_{{ $idx }}" value="0">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                            <button type="button" onclick="removeMultiImage('{{ $fName }}', {{ $idx }})" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all" title="Hapus Gambar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Upload Box Baru -->
                                <label id="multi-upload-box-{{ $fName }}"
                                    class="cursor-pointer flex flex-col items-center justify-center aspect-video border-2 border-dashed border-gray-300 rounded-2xl hover:border-primary hover:bg-primary/5 transition-all">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span class="text-xs font-bold text-gray-500 mt-2">Tambah Gambar</span>
                                    <input type="file" name="{{ $fName }}[]" multiple class="hidden" onchange="previewMultiImages(this, '{{ $fName }}')">
                                </label>
                            </div>
                            
                            <script>
                                function removeMultiImage(name, idx) {
                                    if(confirm('Hapus gambar ini?')) {
                                        document.getElementById('remove_multi_' + name + '_' + idx).value = '1';
                                        document.getElementById('multi_img_' + name + '_' + idx).style.display = 'none';
                                    }
                                }

                                function previewMultiImages(input, name) {
                                    const container = document.getElementById('multi-preview-container-' + name);
                                    const uploadBox = document.getElementById('multi-upload-box-' + name);

                                    if (input.files && input.files.length > 0) {
                                        input.style.display = 'none';
                                        input.classList.remove('hidden'); 
                                        
                                        const batchDiv = document.createElement('div');
                                        batchDiv.className = 'contents'; 
                                        batchDiv.appendChild(input);

                                        Array.from(input.files).forEach(file => {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                const div = document.createElement('div');
                                                div.className = 'group relative aspect-video bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 shadow-sm';
                                                div.innerHTML = `
                                                    <img src="${e.target.result}" class="w-full h-full object-cover">
                                                    <div class="absolute top-2 left-2 bg-primary text-white text-[10px] px-2 py-1 rounded-full font-bold shadow">BARU</div>
                                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                                        <button type="button" onclick="if(confirm('Batalkan upload gambar ini?')) this.closest('.contents').remove()" class="bg-red-500 text-white p-2 rounded-full hover:scale-110 transition-all" title="Hapus Batch Ini">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
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
                                        newInput.name = name + '[]';
                                        newInput.multiple = true;
                                        newInput.className = 'hidden';
                                        newInput.onchange = function() { previewMultiImages(this, name); };
                                        uploadBox.appendChild(newInput);
                                    }
                                }
                            </script>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @endforeach

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 right-8 z-50">
        <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-primary/30 flex items-center gap-3 transition-transform hover:-translate-y-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
