"use client";

import { useState } from "react";

type Article = {
  id: number;
  category: string;
  date: string;
  title: string;
  excerpt: string;
  tier: "hero" | "highlight" | "regular";
};

const articles: Article[] = [
  // Hero — 1 artikel paling featured
  {
    id: 1,
    category: "Kemanusiaan",
    date: "16 Apr 2026",
    tier: "hero",
    title:
      "Perkuat Pengelolaan Huntara di Aceh Tamiang, Langkah Bersama Jaga Kehidupan Penyintas",
    excerpt:
      "Banjir melanda sejumlah wilayah di Aceh Tamiang dan mengubah kehidupan banyak keluarga. Akibatnya, sebagian warga terpaksa tinggal di hunian sementara (huntara) sambil menata kembali kehidupan secara bertahap bersama para relawan.",
  },
  // Highlight — 2 artikel populer
  {
    id: 2,
    category: "Sosial",
    date: "15 Apr 2026",
    tier: "highlight",
    title: "Qurban di Era Digital: Manfaat Lebih Luas hingga Pelosok Negeri",
    excerpt:
      "Berqurban bukan sekadar ibadah tahunan, melainkan juga cara nyata berbagi langsung ke lokasi pelosok yang selama ini sulit dijangkau.",
  },
  {
    id: 3,
    category: "Kesehatan",
    date: "14 Apr 2026",
    tier: "highlight",
    title:
      "Hunian Sementara dan Air Bersih Dukung Warga Aceh Utara Menata Kembali",
    excerpt:
      "Banjir yang melanda wilayah Sumatera pada akhir 2025 membawa dampak serius bagi ribuan warga yang kini mulai bangkit.",
  },
  // Regular — berita biasa
  {
    id: 4,
    category: "Pendidikan",
    date: "13 Apr 2026",
    tier: "regular",
    title: "Beasiswa untuk 200 Anak Tidak Mampu di Jawa Timur Resmi Dibuka",
    excerpt:
      "Program beasiswa tahunan kembali hadir menyasar anak-anak dari keluarga kurang mampu di berbagai kabupaten.",
  },
  {
    id: 5,
    category: "Ekonomi",
    date: "12 Apr 2026",
    tier: "regular",
    title: "Pelatihan Wirausaha Perempuan Desa Hasilkan 50 UMKM Baru",
    excerpt:
      "Melalui program pemberdayaan ekonomi, perempuan di pedesaan kini mampu mandiri dengan usaha kecil yang berkelanjutan.",
  },
  {
    id: 6,
    category: "Dakwah",
    date: "11 Apr 2026",
    tier: "regular",
    title: "Kajian Ramadan di 30 Titik Wilayah 3T Berhasil Menjangkau Ribuan Jamaah",
    excerpt:
      "Tim dakwah berhasil menyelenggarakan kajian intensif selama Ramadan di wilayah terdepan, terluar, dan tertinggal.",
  },
  {
    id: 7,
    category: "Kemanusiaan",
    date: "10 Apr 2026",
    tier: "regular",
    title: "Distribusi Sembako Darurat Menjangkau 1.200 Keluarga Terdampak Longsor",
    excerpt:
      "Respon cepat tim lapangan memastikan bantuan pangan tiba dalam 24 jam pasca bencana tanah longsor di Sulawesi.",
  },
  {
    id: 8,
    category: "Kesehatan",
    date: "9 Apr 2026",
    tier: "regular",
    title: "Posyandu Keliling Layani 800 Balita di Daerah Terpencil Kalimantan",
    excerpt:
      "Layanan kesehatan bergerak menjadi solusi bagi masyarakat yang tinggal jauh dari fasilitas kesehatan terdekat.",
  },
  {
    id: 9,
    category: "Sosial",
    date: "8 Apr 2026",
    tier: "regular",
    title: "Akses Protein Belum Merata di 5 Wilayah dengan Konsumsi Daging Terendah",
    excerpt:
      "Pemerataan gizi masih menjadi pekerjaan rumah besar bagi Indonesia, khususnya soal akses protein hewani di daerah terpencil.",
  },
  {
    id: 10,
    category: "Pendidikan",
    date: "7 Apr 2026",
    tier: "regular",
    title: "Perpustakaan Keliling Hadir di 15 Sekolah Dasar Wilayah Perbatasan",
    excerpt:
      "Inisiatif membawa buku ke pelosok negeri terus berkembang, menghadirkan ribuan judul untuk anak-anak yang haus ilmu.",
  },
  {
    id: 11,
    category: "Dakwah",
    date: "6 Apr 2026",
    tier: "regular",
    title: "Makna Qurban dan Rumah Singgah: Tanggapan Sosial yang Menginspirasi",
    excerpt:
      "Menjelang Iduladha, program qurban berbasis teknologi memperluas jangkauan manfaat hingga ke daerah yang paling membutuhkan.",
  },
  {
    id: 12,
    category: "Ekonomi",
    date: "5 Apr 2026",
    tier: "regular",
    title: "Zakat Produktif Bantu 300 Petani Kecil Tingkatkan Hasil Panen",
    excerpt:
      "Dana zakat yang dikelola secara produktif terbukti mampu meningkatkan kesejahteraan petani kecil secara berkelanjutan.",
  },
];

const CATEGORIES = ["Semua", "Kemanusiaan", "Kesehatan", "Sosial", "Pendidikan", "Ekonomi", "Dakwah"];

function CategoryBadge({ label }: { label: string }) {
  return (
    <span className="inline-block bg-[#7FC248]/10 text-[#7FC248] text-xs font-semibold px-2.5 py-0.5 rounded-full">
      {label}
    </span>
  );
}

function ArrowButton({ small = false }: { small?: boolean }) {
  const size = small ? "w-6 h-6 text-sm" : "w-8 h-8 text-lg";
  return (
    <button
      className={`${size} rounded-full bg-[#7FC248] text-white flex items-center justify-center leading-none hover:bg-[#5DA630] transition-colors flex-shrink-0`}
    >
      ›
    </button>
  );
}

// ── Kartu hero (full width, landscape) ──────────────────────────────────────
function HeroCard({ article }: { article: Article }) {
  return (
    <div className="flex flex-col md:flex-row rounded-2xl overflow-hidden border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300 bg-white cursor-pointer group">
      {/* Gambar */}
      <div className="w-full md:w-1/2 h-56 md:h-80 bg-gray-300 flex-shrink-0 relative overflow-hidden">
        <div className="absolute inset-0 bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
          <span className="text-gray-500 text-sm font-medium">Gambar Artikel</span>
        </div>
        <div className="absolute top-4 left-4">
          <span className="bg-[#7FC248] text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
            Trending
          </span>
        </div>
      </div>
      {/* Konten */}
      <div className="flex-1 p-6 md:p-8 flex flex-col justify-between">
        <div>
          <div className="flex items-center justify-between mb-3">
            <CategoryBadge label={article.category} />
            <span className="text-gray-400 text-sm">{article.date}</span>
          </div>
          <h2 className="text-gray-800 font-bold text-xl md:text-2xl leading-snug mb-4 group-hover:text-[#7FC248] transition-colors duration-200">
            {article.title}
          </h2>
          <p className="text-gray-500 text-sm leading-relaxed line-clamp-3">
            {article.excerpt}
          </p>
        </div>
        <div className="flex items-center justify-between mt-6">
          <span className="text-xs text-gray-400 font-medium uppercase tracking-widest">
            Baca selengkapnya
          </span>
          <ArrowButton />
        </div>
      </div>
    </div>
  );
}

// ── Kartu highlight (portrait, medium) ──────────────────────────────────────
function HighlightCard({ article }: { article: Article }) {
  return (
    <div className="flex flex-row rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 bg-white cursor-pointer group h-full">
      {/* Gambar kiri */}
      <div className="w-36 flex-shrink-0 bg-gray-300 relative overflow-hidden">
        <div className="absolute inset-0 bg-gradient-to-br from-gray-300 to-gray-400" />
      </div>
      {/* Konten kanan */}
      <div className="flex-1 p-4 flex flex-col justify-between min-w-0">
        <div>
          <div className="flex items-center justify-between mb-2">
            <CategoryBadge label={article.category} />
            <span className="text-gray-400 text-xs ml-2 flex-shrink-0">{article.date}</span>
          </div>
          <h3 className="text-gray-800 font-bold text-sm leading-snug mb-2 group-hover:text-[#7FC248] transition-colors duration-200 line-clamp-2">
            {article.title}
          </h3>
          <p className="text-gray-500 text-xs leading-relaxed line-clamp-2">
            {article.excerpt}
          </p>
        </div>
        <div className="flex justify-end mt-3">
          <ArrowButton small />
        </div>
      </div>
    </div>
  );
}

// ── Kartu regular (portrait, kecil) ─────────────────────────────────────────
function RegularCard({ article }: { article: Article }) {
  return (
    <div className="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:border-[#7FC248]/30 hover:scale-[1.02] transition-all duration-300 cursor-pointer group flex flex-col">
      {/* Gambar */}
      <div className="h-36 bg-gradient-to-br from-gray-200 to-gray-300 flex-shrink-0 relative">
        <div className="absolute inset-0 flex items-center justify-center">
          <span className="text-gray-400 text-xs">Gambar</span>
        </div>
      </div>
      {/* Konten */}
      <div className="p-3 flex flex-col flex-1">
        <div className="flex items-center justify-between mb-2">
          <CategoryBadge label={article.category} />
          <span className="text-gray-400 text-xs">{article.date}</span>
        </div>
        <h4 className="text-gray-800 font-bold text-sm leading-snug mb-2 group-hover:text-[#7FC248] transition-colors duration-200 line-clamp-2 flex-1">
          {article.title}
        </h4>
        <p className="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-3">
          {article.excerpt}
        </p>
        <div className="flex justify-end">
          <ArrowButton small />
        </div>
      </div>
    </div>
  );
}

// ── Halaman utama ─────────────────────────────────────────────────────────
export default function NewsPage() {
  const [query, setQuery] = useState("");
  const [activeCategory, setActiveCategory] = useState("Semua");

  const filtered = articles.filter((a) => {
    const matchCat = activeCategory === "Semua" || a.category === activeCategory;
    const q = query.toLowerCase();
    const matchQ = !q || a.title.toLowerCase().includes(q) || a.excerpt.toLowerCase().includes(q);
    return matchCat && matchQ;
  });

  const hero       = filtered.filter((a) => a.tier === "hero");
  const highlights = filtered.filter((a) => a.tier === "highlight");
  const regulars   = filtered.filter((a) => a.tier === "regular");

  const hasPopular = hero.length > 0 || highlights.length > 0;

  return (
    <div className="min-h-screen bg-[#F5FCF0]">

      {/* ── Hero banner ──────────────────────────────────────── */}
      <div className="w-full bg-[#1e5b3a] py-14 px-4">
        <div className="max-w-4xl mx-auto text-center">
          <p className="text-[#7FC248] text-sm font-semibold uppercase tracking-widest mb-2">
            Tetap Terhubung
          </p>
          <h1 className="text-white font-bold text-3xl md:text-4xl mb-3">
            Berita &amp; Kabar Terbaru
          </h1>
          <p className="text-gray-400 text-sm mb-8">
            Ikuti perkembangan program, aksi, dan dampak nyata yang kami hadirkan di lapangan.
          </p>

          {/* Search bar */}
          <div className="relative max-w-xl mx-auto">
            <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
              </svg>
            </span>
            <input
              type="text"
              value={query}
              onChange={(e) => setQuery(e.target.value)}
              placeholder="Cari berita…"
              className="w-full pl-10 pr-4 py-3 rounded-full bg-white text-gray-800 text-sm placeholder-gray-400 outline-none shadow-md focus:ring-2 focus:ring-[#7FC248]/50 transition"
            />
            {query && (
              <button
                onClick={() => setQuery("")}
                className="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
              >
                ✕
              </button>
            )}
          </div>
        </div>
      </div>

      {/* ── Filter kategori ──────────────────────────────────── */}
      <div className="sticky top-16 z-30 bg-white border-b border-gray-100 shadow-sm">
        <div className="max-w-6xl mx-auto px-4 py-3 flex gap-2 overflow-x-auto scrollbar-hide">
          {CATEGORIES.map((cat) => (
            <button
              key={cat}
              onClick={() => setActiveCategory(cat)}
              className={`flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition-all duration-200 ${
                activeCategory === cat
                  ? "bg-[#7FC248] text-white shadow-sm"
                  : "bg-gray-100 text-gray-600 hover:bg-gray-200"
              }`}
            >
              {cat}
            </button>
          ))}
        </div>
      </div>

      {/* ── Konten utama ─────────────────────────────────────── */}
      <div className="max-w-6xl mx-auto px-4 py-10">

        {filtered.length === 0 ? (
          <div className="text-center py-20">
            <p className="text-gray-400 text-lg">Tidak ada berita yang cocok dengan pencarian.</p>
            <button
              onClick={() => { setQuery(""); setActiveCategory("Semua"); }}
              className="mt-4 text-[#7FC248] text-sm font-medium hover:underline"
            >
              Reset filter
            </button>
          </div>
        ) : (
          <>
            {/* ── Berita Populer ─────────────────────────────── */}
            {hasPopular && (
              <section className="mb-12">
                <div className="flex items-center gap-3 mb-6">
                  <span className="w-1 h-6 bg-[#7FC248] rounded-full" />
                  <h2 className="text-gray-800 font-bold text-xl">Berita Populer</h2>
                </div>

                {/* Hero card */}
                {hero.length > 0 && (
                  <div className="mb-5">
                    <HeroCard article={hero[0]} />
                  </div>
                )}

                {/* 2 highlight cards */}
                {highlights.length > 0 && (
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {highlights.map((a) => (
                      <HighlightCard key={a.id} article={a} />
                    ))}
                  </div>
                )}
              </section>
            )}

            {/* ── Berita Lainnya ─────────────────────────────── */}
            {regulars.length > 0 && (
              <section>
                <div className="flex items-center gap-3 mb-6">
                  <span className="w-1 h-6 bg-[#7FC248] rounded-full" />
                  <h2 className="text-gray-800 font-bold text-xl">Berita Lainnya</h2>
                </div>

                <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                  {regulars.map((a) => (
                    <RegularCard key={a.id} article={a} />
                  ))}
                </div>
              </section>
            )}
          </>
        )}
      </div>
    </div>
  );
}
