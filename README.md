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

### 🚀 Menjalankan Server Backend
Buka terminal baru dan jalankan langkah-langkah di bawah ini:
1. Masuk ke direktori backend: `cd backend`
2. Instal dependensi Composer (PHP): `composer install`
3. Siapkan file konfigurasi environment: `cp .env.example .env`
4. Bangkitkan *App Key*: `php artisan key:generate`
5. Lakukan migrasi database beserta data dummy (Seeder): `php artisan migrate --seed`
6. Mulai server backend: `php artisan serve` (Berjalan di `http://127.0.0.1:8000`)

### 🔌 Daftar Endpoint API

Aplikasi Next.js (`Frontend`) akan selalu melakukan operasi *fetch* ke rute `/api/*` milik server Laravel.

#### 1. API Pengambilan Konten Halaman Dinamis
- **URL**: `GET /api/content/{page_name}`
- **Fungsi**: Memuat kumpulan teks atau konfigurasi untuk merender struktur halaman dari database secara dinamis.
- **Contoh Response**:
  ```json
  {
    "hero_title": "Sedekah Membawa Berkah",
    "hero_subtitle": "Mari mulai berdonasi."
  }
  ```

#### 2. API Wilayah / Provinsi
- **URL**: `GET /api/provinces`
- **Fungsi**: Menyuplai data dropdown bagi formulir (seperti Form Permohonan Tambahan, Pendaftaran Relawan, dll).
- **Contoh Response**:
  ```json
  [
    { "id": 1, "name": "ACEH" },
    { "id": 2, "name": "SUMATERA UTARA" }
  ]
  ```

### 👥 Manajemen Hak Akses Admin (Roles)
Sistem di `/admin` membagi sesi user menjadi 3 tingkatan kontrol (*Role*):
- **🛠️ Dev Admin (`dev`)**: Punya kendali penuh terhadap sistem dan panel kendali akun.
- **✏️ Markom Admin (`markom`)**: Hak akses eksklusif untuk mengubah tampilan serta teks Landing Page.
- **📋 Program Admin (`program`)**: Hak akses untuk memantau formulir pendaftaran relawan dan aliran donasi.

## License
Hak Cipta &copy; 2026 **Taman Zakat Indonesia**. Seluruh hak cipta dilindungi undang-undang.
