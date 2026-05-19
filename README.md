# Taman Zakat Indonesia

<p align="center">
  <img src="public/images/icon/logo%20taza%20font%20putih.png" alt="Taman Zakat Logo" width="400">
</p>

Website resmi **Taman Zakat Indonesia** yang berfungsi sebagai platform informasi, edukasi, dan penyaluran donasi bagi masyarakat. Website ini dirancang dengan antarmuka modern yang futuristik, responsif, dan mudah digunakan.

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan stack teknologi modern untuk performa dan pengalaman pengguna yang maksimal:

- **Framework:** [Next.js 16 (App Router)](https://nextjs.org/) dengan **Turbopack** untuk performa development yang super cepat.
- **Library UI:** [React 19](https://reactjs.org/)
- **Styling:** [Tailwind CSS v4](https://tailwindcss.com/) - Engine CSS tercepat dan paling modern saat ini.
- **Animasi:** [Framer Motion](https://www.framer.com/motion/) untuk interaksi yang mulus dan dinamis.
- **Iconography:** [Lucide React](https://lucide.dev/)
- **Typography:** [Poppins](https://fonts.google.com/specimen/Poppins) (Google Fonts)
- **Bahasa:** [TypeScript](https://www.typescriptlang.org/) untuk kode yang lebih aman dan terstruktur.

## Cara Instalasi & Menjalankan Project

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

### 1. Clone Repository
```bash
git clone https://github.com/itzamedia/tamanzakat.git
cd tamanzakat
```

### 2. Instalasi Dependensi
Gunakan npm untuk menginstal semua library yang dibutuhkan:
```bash
npm install
```

### 3. Menjalankan Server Development
Jalankan perintah berikut untuk memulai server development:
```bash
npm run dev
```
Setelah jalan, buka [http://localhost:3000](http://localhost:3000) di browser Anda.

### 4. Build untuk Produksi
Untuk melakukan build produksi:
```bash
npm run build
npm run start
```

## Backend Laravel & Dokumentasi API

Sistem backend dibangun dengan **Laravel**, bertindak ganda sebagai RESTful API (*Headless*) untuk dikonsumsi Frontend Next.js, dan juga menyediakan Panel Admin (*Blade UI*) untuk pengelolaan konten (CMS).

### Menjalankan Server Backend
Buka terminal baru dan jalankan langkah-langkah di bawah ini:
1. Masuk ke direktori backend: `cd backend`
2. Instal dependensi Composer (PHP): `composer install`
3. Siapkan file konfigurasi environment: `cp .env.example .env`
4. Bangkitkan *App Key*: `php artisan key:generate`
5. Lakukan migrasi database beserta data dummy (Seeder): `php artisan migrate --seed`
6. Mulai server backend: `php artisan serve` (Berjalan di `http://127.0.0.1:8000`)

### Daftar Endpoint API

Aplikasi Next.js (`Frontend`) akan selalu melakukan operasi *fetch* ke rute `/api/*` milik server Laravel.

#### 1. API Pengambilan Konten Halaman Dinamis
- **URL**: `GET /api/content/{page_name}`
- **Fungsi**: Memuat kumpulan teks atau konfigurasi untuk merender struktur halaman dari database secara dinamis.

#### 2. API Wilayah / Provinsi
- **URL**: `GET /api/provinces`
- **Fungsi**: Menyuplai data dropdown bagi formulir.

#### 3. API Publikasi (Artikel & Berita)
- **URL**: `GET /api/artikel`, `GET /api/berita`
- **Fungsi**: Mendapatkan daftar artikel atau berita dengan kemampuan *pagination*, pencarian, dan filter kategori.
- **Endpoint Spesifik**: 
  - `GET /api/artikel/home` & `GET /api/berita/home` (Daftar artikel/berita terpilih untuk landing page)
  - `GET /api/artikel/editor-choice` (Daftar artikel Pilihan Editor)
  - `GET /api/artikel/{slug}` & `GET /api/berita/{slug}` (Mengambil detail isi bacaan)
  - `GET /api/artikel/{slug}/related` & `GET /api/berita/{slug}/related` (Mengambil rekomendasi bacaan sejenis)

#### 4. API Formulir Publik (Submission)
- **URL**: `POST /api/permohonan-bantuan`
- **Fungsi**: Mengirim formulir pengajuan bantuan sosial.
- **URL**: `POST /api/konfirmasi-donasi`
- **Fungsi**: Menerima laporan konfirmasi transfer donasi beserta unggahan gambar bukti.
- **URL**: `POST /api/volunteer`
- **Fungsi**: Mendaftarkan akun relawan/volunteer baru.

#### 5. API Data Pendukung (Dinamis)
- **URL**: `GET /api/rekening`
- **Fungsi**: Memuat informasi daftar rekening bank resmi milik lembaga.
- **URL**: `GET /api/mitra`
- **Fungsi**: Memuat daftar mitra yang bekerja sama secara struktural.

### Manajemen Hak Akses Admin (Roles)
Sistem di `/admin` membagi sesi user menjadi 3 tingkatan kontrol (*Role*):
- ** Dev Admin (`dev`)**: Punya kendali penuh terhadap sistem dan panel kendali akun.
- ** Markom Admin (`markom`)**: Hak akses eksklusif untuk mengubah tampilan serta teks Landing Page.
- ** Program Admin (`program`)**: Hak akses untuk memantau formulir pendaftaran relawan dan aliran donasi.

## License
Hak Cipta &copy; 2026 **Taman Zakat Indonesia**. Dikembangkan oleh tim web Developer Zamedia. Seluruh hak cipta dilindungi undang-undang.
