@extends('layouts.admin')

@section('header', 'Buat Formulir Baru')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.custom-forms.index') }}" class="w-10 h-10 bg-gray-50 hover:bg-primary/10 text-gray-400 hover:text-primary rounded-xl flex items-center justify-center transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-xl lg:text-3xl font-bold text-dark">Buat Formulir Baru</h1>
                <p class="text-gray-400 text-[10px] lg:text-base mt-1">Desain formulir kustom Anda dan bagikan linknya.</p>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.custom-forms.store') }}" method="POST" id="form-builder">
        @csrf

        {{-- Form Info Card --}}
        <div class="bg-white rounded-[2.5rem] p-6 sm:p-8 lg:p-10 shadow-xl border border-white mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-primary/10 text-primary rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h2 class="text-lg font-bold text-dark">Informasi Form</h2>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block font-bold mb-2 text-sm">Judul Formulir <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Formulir Pendaftaran Kegiatan Ramadan" class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none text-base">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-bold mb-2 text-sm">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="3" placeholder="Deskripsikan form ini secara singkat..." class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:border-primary transition-all outline-none text-sm">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Fields Builder --}}
        <div class="bg-white rounded-[2.5rem] p-6 sm:p-8 lg:p-10 shadow-xl border border-white mb-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    </div>
                    <h2 class="text-lg font-bold text-dark">Pertanyaan / Field</h2>
                </div>
                <button type="button" onclick="addField()" class="bg-primary hover:bg-dark text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Field
                </button>
            </div>

            <div id="fields-container" class="space-y-4">
                {{-- Default first field --}}
                <div class="field-item bg-gray-50 border border-gray-100 rounded-2xl p-5 relative group" data-index="0">
                    <div class="flex items-start gap-4">
                        {{-- Drag Handle --}}
                        <div class="mt-3 cursor-move text-gray-300 hover:text-gray-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                        </div>

                        <div class="flex-1 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1.5">Label Pertanyaan <span class="text-red-500">*</span></label>
                                    <input type="text" name="fields[0][label]" required placeholder="Contoh: Nama Lengkap" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary transition-all outline-none text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1.5">Tipe Input</label>
                                    <select name="fields[0][type]" onchange="toggleOptions(this)" class="hidden" data-custom-select>
                                        <option value="text" selected>Teks Singkat</option>
                                        <option value="textarea">Teks Panjang</option>
                                        <option value="email">Email</option>
                                        <option value="number">Angka</option>
                                        <option value="date">Tanggal</option>
                                        <option value="select">Dropdown Pilihan</option>
                                        <option value="radio">Pilihan Ganda (Radio)</option>
                                        <option value="checkbox">Centang (Checkbox)</option>
                                        <option value="file">Upload File</option>
                                    </select>
                                    <div class="custom-select-wrapper" data-for="fields[0][type]">
                                        <div class="custom-select-trigger" onclick="toggleCustomSelect(this)">
                                            <span class="custom-select-text">Teks Singkat</span>
                                            <svg class="custom-select-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                        <div class="custom-select-options hidden"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Options (hidden by default, shown for select/radio/checkbox) --}}
                            <div class="options-wrapper hidden">
                                <label class="block text-xs font-bold text-gray-500 mb-1.5">Opsi Pilihan <span class="text-red-400">(pisahkan dengan koma)</span></label>
                                <input type="text" name="fields[0][options]" placeholder="Opsi 1, Opsi 2, Opsi 3" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary transition-all outline-none text-sm">
                            </div>

                            {{-- Required Toggle --}}
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="fields[0][is_required]" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                </label>
                                <span class="text-sm text-gray-600 font-medium">Wajib diisi</span>
                            </div>
                        </div>

                        {{-- Remove Field --}}
                        <button type="button" onclick="removeField(this)" class="mt-3 text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-xl transition-all opacity-0 group-hover:opacity-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Add Field Button (Alternative) --}}
            <button type="button" onclick="addField()" class="mt-6 flex items-center justify-center w-full gap-2 text-sm font-bold text-primary border-2 border-dashed border-primary/30 rounded-xl py-4 hover:bg-primary/5 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Pertanyaan Baru
            </button>
        </div>

        {{-- Submit --}}
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.custom-forms.index') }}" class="px-8 py-3 rounded-2xl border border-gray-200 text-gray-500 hover:border-dark hover:text-dark font-bold text-sm transition-all">Batal</a>
            <button type="submit" class="bg-primary hover:bg-dark text-white px-10 py-3 rounded-2xl font-bold text-base transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Form
            </button>
        </div>
    </form>
</div>

@if ($errors->any())
    <div class="fixed bottom-6 right-6 bg-red-500 text-white px-6 py-3 rounded-2xl shadow-2xl z-[200] font-semibold text-sm flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Mohon periksa kembali isian form.
    </div>
@endif

<script>
    let fieldCounter = 1;

    function addField() {
        const container = document.getElementById('fields-container');
        const index = fieldCounter++;

        const html = `
            <div class="field-item bg-gray-50 border border-gray-100 rounded-2xl p-5 relative group" data-index="${index}" style="animation: slideUp 0.3s ease-out;">
                <div class="flex items-start gap-4">
                    <div class="mt-3 cursor-move text-gray-300 hover:text-gray-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1.5">Label Pertanyaan <span class="text-red-500">*</span></label>
                                <input type="text" name="fields[${index}][label]" required placeholder="Contoh: No WhatsApp" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary transition-all outline-none text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1.5">Tipe Input</label>
                                <select name="fields[${index}][type]" onchange="toggleOptions(this)" class="hidden" data-custom-select>
                                    <option value="text" selected>Teks Singkat</option>
                                    <option value="textarea">Teks Panjang</option>
                                    <option value="email">Email</option>
                                    <option value="number">Angka</option>
                                    <option value="date">Tanggal</option>
                                    <option value="select">Dropdown Pilihan</option>
                                    <option value="radio">Pilihan Ganda (Radio)</option>
                                    <option value="checkbox">Centang (Checkbox)</option>
                                    <option value="file">Upload File</option>
                                </select>
                                <div class="custom-select-wrapper" data-for="fields[${index}][type]">
                                    <div class="custom-select-trigger" onclick="toggleCustomSelect(this)">
                                        <span class="custom-select-text">Teks Singkat</span>
                                        <svg class="custom-select-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                    <div class="custom-select-options hidden"></div>
                                </div>
                            </div>
                        </div>
                        <div class="options-wrapper hidden">
                            <label class="block text-xs font-bold text-gray-500 mb-1.5">Opsi Pilihan <span class="text-red-400">(pisahkan dengan koma)</span></label>
                            <input type="text" name="fields[${index}][options]" placeholder="Opsi 1, Opsi 2, Opsi 3" class="w-full px-4 py-3 rounded-xl bg-white border border-gray-200 focus:border-primary transition-all outline-none text-sm">
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="fields[${index}][is_required]" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                            <span class="text-sm text-gray-600 font-medium">Wajib diisi</span>
                        </div>
                    </div>
                    <button type="button" onclick="removeField(this)" class="mt-3 text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-xl transition-all opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        // Initialize the new custom select
        const newField = container.querySelector('.field-item:last-child');
        initCustomSelect(newField.querySelector('.custom-select-wrapper'));
    }

    function removeField(btn) {
        const fields = document.querySelectorAll('.field-item');
        if (fields.length <= 1) {
            alert('Form harus memiliki minimal 1 pertanyaan.');
            return;
        }
        btn.closest('.field-item').remove();
    }

    function toggleOptions(select) {
        const wrapper = select.closest('.field-item').querySelector('.options-wrapper');
        const needsOptions = ['select', 'radio', 'checkbox'].includes(select.value);
        wrapper.classList.toggle('hidden', !needsOptions);
    }

    // === Custom Dropdown Logic ===
    function initCustomSelect(wrapper) {
        const selectEl = wrapper.previousElementSibling;
        const optionsContainer = wrapper.querySelector('.custom-select-options');
        optionsContainer.innerHTML = '';

        Array.from(selectEl.options).forEach(opt => {
            const div = document.createElement('div');
            div.className = 'custom-select-option' + (opt.selected ? ' selected' : '');
            div.dataset.value = opt.value;
            div.innerHTML = `<span>${opt.text}</span>`;
            div.addEventListener('click', () => selectCustomOption(wrapper, opt.value, opt.text));
            optionsContainer.appendChild(div);
        });
    }

    function toggleCustomSelect(trigger) {
        const wrapper = trigger.closest('.custom-select-wrapper');
        const options = wrapper.querySelector('.custom-select-options');
        const isOpen = !options.classList.contains('hidden');

        // Close all other open dropdowns first
        document.querySelectorAll('.custom-select-options').forEach(o => o.classList.add('hidden'));
        document.querySelectorAll('.custom-select-trigger').forEach(t => t.classList.remove('active'));

        if (!isOpen) {
            options.classList.remove('hidden');
            trigger.classList.add('active');
        }
    }

    function selectCustomOption(wrapper, value, text) {
        const selectEl = wrapper.previousElementSibling;
        selectEl.value = value;
        selectEl.dispatchEvent(new Event('change'));

        wrapper.querySelector('.custom-select-text').textContent = text;
        wrapper.querySelector('.custom-select-options').classList.add('hidden');
        wrapper.querySelector('.custom-select-trigger').classList.remove('active');

        // Update selected state
        wrapper.querySelectorAll('.custom-select-option').forEach(opt => {
            opt.classList.toggle('selected', opt.dataset.value === value);
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.custom-select-wrapper')) {
            document.querySelectorAll('.custom-select-options').forEach(o => o.classList.add('hidden'));
            document.querySelectorAll('.custom-select-trigger').forEach(t => t.classList.remove('active'));
        }
    });

    // Initialize all custom selects on page load
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.custom-select-wrapper').forEach(w => initCustomSelect(w));
    });
</script>

<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes dropdownOpen {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .custom-select-wrapper {
        position: relative;
    }
    .custom-select-trigger {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        background: #fff;
        border: 1px solid #e5e7eb;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-size: 0.875rem;
        color: #1f2937;
    }
    .custom-select-trigger:hover {
        border-color: #5DA630;
    }
    .custom-select-trigger.active {
        border-color: #5DA630;
        box-shadow: 0 0 0 3px rgba(93, 166, 48, 0.12);
    }
    .custom-select-arrow {
        width: 18px;
        height: 18px;
        color: #9ca3af;
        transition: transform 0.2s;
        flex-shrink: 0;
    }
    .custom-select-trigger.active .custom-select-arrow {
        transform: rotate(180deg);
    }
    .custom-select-options {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 12px 36px rgba(0,0,0,0.12);
        z-index: 50;
        overflow: hidden;
        animation: dropdownOpen 0.2s ease-out;
        max-height: 280px;
        overflow-y: auto;
    }
    .custom-select-options::-webkit-scrollbar { width: 4px; }
    .custom-select-options::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
    .custom-select-option {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.7rem 1rem;
        cursor: pointer;
        font-size: 0.875rem;
        color: #374151;
        transition: background 0.15s;
    }
    .custom-select-option:hover {
        background: #f0fdf4;
    }
    .custom-select-option.selected {
        background: #f0fdf4;
        color: #166534;
        font-weight: 600;
    }
</style>
@endsection
