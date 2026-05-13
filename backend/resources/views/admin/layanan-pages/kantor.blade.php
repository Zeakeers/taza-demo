@extends('layouts.admin')

@section('header', 'Kantor Pelayanan')

@section('content')
<div class="space-y-8 pb-20">

    @if(session('success'))
    <div id="alert-success" class="bg-primary text-white p-4 rounded-2xl shadow-lg shadow-primary/20 flex items-center justify-between gap-3 animate-bounce">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-white hover:text-gray-200 p-1 bg-white/20 rounded-full hover:bg-white/30 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
    </div>
    @endif

    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-xl lg:text-3xl font-bold text-dark">Kelola Kantor Pelayanan</h1>
            <p class="text-gray-400 text-[10px] lg:text-base mt-1">Kelola daftar kantor pelayanan yang ditampilkan di frontend.</p>
        </div>
    </div>

    @php
        $data = $kantor ? $kantor->content : [
            'header' => [
                'title' => 'Kantor Layanan',
                'description' => 'Bagi anda yang ingin berkonsultasi mengenai Program Taman Zakat dan lainnya, Anda bisa menghubungi kami:',
            ],
            'offices' => [
                [
                    'name' => 'Kantor Pusat',
                    'address' => 'Jl. Wisma Trosobo IV No 33, Kec. Taman, Kab. Sidoarjo – Jawa Timur',
                    'phone' => '031 - 99 787 999',
                    'email' => 'mail@tamanzakat.org',
                    'whatsapp' => '082230099009',
                    'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d369.32459085071827!2d112.64360415494198!3d-7.373014410096162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e34e63a9d993%3A0xf355095502d2e683!2sTaman%20Zakat%20Pusat!5e0!3m2!1sid!2sid!4v1774665427828!5m2!1sid!2sid',
                ],
                [
                    'name' => 'Kantor Cabang Sidoarjo',
                    'address' => 'Taman Zakat Kantor Cabang Sidoarjo, Kec. Taman, Kab. Sidoarjo – Jawa Timur',
                    'phone' => '031 - 99 787 999',
                    'email' => 'mail@tamanzakat.org',
                    'whatsapp' => '082230099009',
                    'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.7908134902405!2d112.6617935!3d-7.377326599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e3006092e95b%3A0xb794ac1846fd4a7b!2sTaman%20Zakat%20Kantor%20Cabang%20Sidoarjo!5e0!3m2!1sid!2sid!4v1776226256516!5m2!1sid!2sid',
                ],
                [
                    'name' => 'Kantor Cabang Surabaya',
                    'address' => 'Graha Tanmiyatul Iman Lt. 3 Jl. Ahmad Yani No.153, Gayungan, Wonocolo, Surabaya, Jawa Timur 60235',
                    'phone' => '031 - 99 787 999',
                    'email' => 'mail@tamanzakat.org',
                    'whatsapp' => '082230099009',
                    'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2170121953236!2d112.72919137584181!3d-7.3295067720868845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb4238d41a77%3A0xd47fd941882891f9!2sGraha%20Tanmiyatul%20Iman!5e0!3m2!1sid!2sid!4v1774665568300!5m2!1sid!2sid',
                ],
                [
                    'name' => 'Kantor Cabang Probolinggo',
                    'address' => 'Komplek Masjid Asshobirin Bengawan Solo Residence C9 Jalan Bengawan Solo Kademangan Kota Probolinggo Jawa Timur',
                    'phone' => '031 - 99 787 999',
                    'email' => 'mail@tamanzakat.org',
                    'whatsapp' => '082230099009',
                    'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1165554745885!2d113.19299687584727!3d-7.777464277163349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ad6947e2d727%3A0x1a6914f11e8b5a5f!2sThe%20Bengawan%20Solo%20Residence!5e0!3m2!1sid!2sid!4v1774665646186!5m2!1sid!2sid',
                ],
            ],
        ];
    @endphp

    <form action="{{ route('admin.layanan-pages.kantor.update') }}" method="POST">
        @csrf

        {{-- Header Section --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-zinc-800">Header Halaman</h2>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20">
                    Simpan Semua
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul</label>
                    <input type="text" name="content[header][title]" value="{{ $data['header']['title'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                    <input type="text" name="content[header][description]" value="{{ $data['header']['description'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                </div>
            </div>
        </div>

        {{-- Office List --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-zinc-800">Daftar Kantor</h2>
                <p class="text-sm text-gray-400">Kelola lokasi kantor beserta informasi kontaknya.</p>
            </div>
            <button type="button" onclick="addOffice()" class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-secondary transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kantor
            </button>
        </div>

        <div id="offices-list" class="space-y-6">
            @foreach($data['offices'] ?? [] as $index => $office)
            <div class="office-item bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative group">
                {{-- Remove Button --}}
                <button type="button" onclick="this.closest('.office-item').remove()" class="absolute -top-0 -right-0 bg-red-500 text-white w-10 h-10 rounded-bl-2xl rounded-tr-3xl flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors z-10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="p-6 bg-gray-50/50 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text" name="content[offices][{{ $index }}][name]" value="{{ $office['name'] ?? '' }}" class="text-lg font-bold text-zinc-800 bg-transparent border-none outline-none flex-1" placeholder="Nama Kantor">
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="content[offices][{{ $index }}][address]" rows="2" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none">{{ $office['address'] ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Telepon</label>
                            <input type="text" name="content[offices][{{ $index }}][phone]" value="{{ $office['phone'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="031 - 99 787 999">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                            <input type="text" name="content[offices][{{ $index }}][email]" value="{{ $office['email'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="mail@tamanzakat.org">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp</label>
                            <input type="text" name="content[offices][{{ $index }}][whatsapp]" value="{{ $office['whatsapp'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="082230099009">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Link Embed Google Maps</label>
                            <input type="text" name="content[offices][{{ $index }}][map_embed]" value="{{ $office['map_embed'] ?? '' }}" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-mono text-xs" placeholder="https://www.google.com/maps/embed?pb=...">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" onclick="addOffice()" class="mt-6 flex items-center justify-center gap-2 w-full py-4 rounded-2xl border-2 border-dashed border-primary/30 text-primary hover:bg-primary/5 transition-colors font-bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kantor Baru
        </button>
    </form>
</div>

<script>
    let officeCount = {{ count($data['offices'] ?? []) }};

    function addOffice() {
        const index = officeCount++;
        const div = document.createElement('div');
        div.className = 'office-item bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative group';
        div.innerHTML = `
            <button type="button" onclick="this.closest('.office-item').remove()" class="absolute -top-0 -right-0 bg-red-500 text-white w-10 h-10 rounded-bl-2xl rounded-tr-3xl flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors z-10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <div class="p-6 bg-gray-50/50 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <input type="text" name="content[offices][${index}][name]" class="text-lg font-bold text-zinc-800 bg-transparent border-none outline-none flex-1" placeholder="Nama Kantor Baru">
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="content[offices][${index}][address]" rows="2" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none" placeholder="Alamat lengkap kantor"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Telepon</label>
                        <input type="text" name="content[offices][${index}][phone]" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="031 - 99 787 999">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="text" name="content[offices][${index}][email]" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="mail@tamanzakat.org">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp</label>
                        <input type="text" name="content[offices][${index}][whatsapp]" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all" placeholder="082230099009">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Link Embed Google Maps</label>
                        <input type="text" name="content[offices][${index}][map_embed]" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-mono text-xs" placeholder="https://www.google.com/maps/embed?pb=...">
                    </div>
                </div>
            </div>
        `;
        document.getElementById('offices-list').appendChild(div);
    }
</script>
@endsection
