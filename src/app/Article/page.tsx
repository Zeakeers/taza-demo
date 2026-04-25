"use client";

import { useEffect, useMemo, useState } from "react";

type Category = "Edukasi Zakat" | "Panduan" | "Inspirasi" | "Pengumuman";

type Article = {
  id: number;
  category: Category;
  title: string;
  excerpt: string;
  author: string;
  authorAvatar: string;
  date: string;
  image: string;
  featured?: boolean;
};

const articles: Article[] = [
  {
    id: 1,
    category: "Panduan",
    title: "Panduan Lengkap Menghitung Zakat Mal untuk 2026",
    excerpt:
      "Kami merangkum cara mudah menghitung zakat mal sesuai nisab dan haul terbaru, lengkap dengan contoh perhitungan yang aplikatif.",
    author: "Tim Edukasi Taman Zakat",
    authorAvatar: "https://i.pravatar.cc/80?img=12",
    date: "1 Apr 2026",
    image: "https://picsum.photos/seed/zakat-mal-2026/1200/800",
    featured: true,
  },
  {
    id: 2,
    category: "Edukasi Zakat",
    title: "Mengenal 8 Asnaf: Siapa Saja Penerima Zakat yang Sah?",
    excerpt:
      "Memahami delapan golongan penerima zakat menjadi kunci agar penyaluran tepat sasaran dan bernilai ibadah yang sempurna.",
    author: "Ust. Ahmad Fauzi",
    authorAvatar: "https://i.pravatar.cc/80?img=15",
    date: "28 Mar 2026",
    image: "https://picsum.photos/seed/asnaf-zakat/1000/700",
  },
  {
    id: 3,
    category: "Inspirasi",
    title: "Kisah Pak Sumarno: Dari Penerima Zakat Menjadi Donatur Tetap",
    excerpt:
      "Sebuah perjalanan inspiratif tentang bagaimana zakat produktif mengubah kehidupan keluarga kecil di pedalaman Jawa Tengah.",
    author: "Redaksi Taman Zakat",
    authorAvatar: "https://i.pravatar.cc/80?img=22",
    date: "25 Mar 2026",
    image: "https://picsum.photos/seed/kisah-sumarno/1000/700",
  },
  {
    id: 4,
    category: "Edukasi Zakat",
    title: "Perbedaan Zakat, Infak, dan Sedekah yang Wajib Diketahui",
    excerpt:
      "Tiga istilah ini sering tertukar. Pelajari perbedaannya agar amalan Anda lebih terarah dan sesuai syariat.",
    author: "Ust. Hilmi Rahman",
    authorAvatar: "https://i.pravatar.cc/80?img=33",
    date: "22 Mar 2026",
    image: "https://picsum.photos/seed/zakat-infak-sedekah/1000/700",
  },
  {
    id: 5,
    category: "Pengumuman",
    title: "Laporan Penyaluran Zakat Triwulan I 2026 Resmi Dipublikasi",
    excerpt:
      "Sebagai bentuk transparansi, Taman Zakat merilis laporan penyaluran lengkap tiga bulan pertama tahun ini.",
    author: "Tim Komunikasi",
    authorAvatar: "https://i.pravatar.cc/80?img=45",
    date: "18 Mar 2026",
    image: "https://picsum.photos/seed/laporan-q1/1000/700",
  },
  {
    id: 6,
    category: "Panduan",
    title: "Cara Mudah Membayar Zakat Online Lewat Taman Zakat",
    excerpt:
      "Tutorial langkah demi langkah berdonasi melalui platform digital, lengkap dengan tips memilih program yang tepat.",
    author: "Tim Digital",
    authorAvatar: "https://i.pravatar.cc/80?img=51",
    date: "14 Mar 2026",
    image: "https://picsum.photos/seed/zakat-online/1000/700",
  },
  {
    id: 7,
    category: "Inspirasi",
    title: "Beasiswa Bintang: Membuka Pintu Masa Depan 200 Anak Negeri",
    excerpt:
      "Cerita di balik program beasiswa yang berhasil menjangkau anak-anak berprestasi dari keluarga prasejahtera.",
    author: "Redaksi Taman Zakat",
    authorAvatar: "https://i.pravatar.cc/80?img=60",
    date: "10 Mar 2026",
    image: "https://picsum.photos/seed/beasiswa-bintang/1000/700",
  },
  {
    id: 8,
    category: "Edukasi Zakat",
    title: "Hukum Zakat Profesi Menurut Pandangan Ulama Kontemporer",
    excerpt:
      "Pembahasan mendalam tentang dasar hukum zakat profesi, nisab, dan kadar yang relevan untuk masyarakat modern.",
    author: "Ust. Ahmad Fauzi",
    authorAvatar: "https://i.pravatar.cc/80?img=15",
    date: "5 Mar 2026",
    image: "https://picsum.photos/seed/zakat-profesi/1000/700",
  },
  {
    id: 9,
    category: "Pengumuman",
    title: "Pembukaan Pendaftaran Relawan Ramadhan 2026",
    excerpt:
      "Bergabunglah bersama ratusan relawan kebaikan dalam program istimewa Ramadhan tahun ini di seluruh Indonesia.",
    author: "Tim Relawan",
    authorAvatar: "https://i.pravatar.cc/80?img=68",
    date: "1 Mar 2026",
    image: "https://picsum.photos/seed/relawan-ramadhan/1000/700",
  },
];

const CATEGORIES: ("Semua" | Category)[] = [
  "Semua",
  "Edukasi Zakat",
  "Panduan",
  "Inspirasi",
  "Pengumuman",
];

const CATEGORY_STYLES: Record<Category, { dot: string; text: string; bg: string }> = {
  "Edukasi Zakat": { dot: "bg-[#7FC248]", text: "text-[#3B7A1C]", bg: "bg-[#EAFCDC]" },
  Panduan: { dot: "bg-[#5DA630]", text: "text-[#196135]", bg: "bg-[#E5F4D9]" },
  Inspirasi: { dot: "bg-[#F5A623]", text: "text-[#9A6308]", bg: "bg-[#FFF4DD]" },
  Pengumuman: { dot: "bg-[#3B7A1C]", text: "text-[#1C4A0C]", bg: "bg-[#DFF0CB]" },
};

function CategoryTag({ category }: { category: Category }) {
  const s = CATEGORY_STYLES[category];
  return (
    <span
      className={`inline-flex items-center gap-1.5 ${s.bg} ${s.text} text-[11px] md:text-xs font-semibold px-2.5 py-1 rounded-md`}
    >
      <span className={`w-1.5 h-1.5 rounded-full ${s.dot}`} />
      {category}
    </span>
  );
}

function ArticleCard({ article }: { article: Article }) {
  return (
    <a
      href="#"
      className="group flex flex-col bg-white rounded-2xl border border-gray-100 overflow-hidden hover:border-[#7FC248]/40 hover:shadow-[0_8px_30px_rgba(127,194,72,0.12)] transition-all duration-300"
    >
      <div className="relative w-full h-44 md:h-52 overflow-hidden bg-gray-100">
        <img
          src={article.image}
          alt={article.title}
          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
        />
      </div>
      <div className="flex flex-col p-5 gap-3 flex-1">
        <CategoryTag category={article.category} />
        <h3 className="font-bold text-[#0D2B05] text-base md:text-lg leading-snug line-clamp-2 group-hover:text-[#3B7A1C] transition-colors">
          {article.title}
        </h3>
        <p className="text-gray-500 text-sm leading-relaxed line-clamp-2">
          {article.excerpt}
        </p>
        <div className="flex items-center gap-2 mt-auto pt-3 border-t border-gray-100">
          <span className="text-xs text-gray-400">{article.date}</span>
          <span className="text-gray-300">·</span>
          <span className="text-xs text-gray-500 font-medium">{article.author}</span>
        </div>
      </div>
    </a>
  );
}

export default function ArticlePage() {
  const [query, setQuery] = useState("");
  const [activeCategory, setActiveCategory] = useState<(typeof CATEGORIES)[number]>("Semua");

  useEffect(() => {
    const handleKey = (e: KeyboardEvent) => {
      if ((e.metaKey || e.altKey) && e.key.toLowerCase() === "k") {
        e.preventDefault();
        const input = document.getElementById("article-search") as HTMLInputElement | null;
        input?.focus();
      }
    };
    window.addEventListener("keydown", handleKey);
    return () => window.removeEventListener("keydown", handleKey);
  }, []);

  const filtered = useMemo(() => {
    const q = query.trim().toLowerCase();
    return articles.filter((a) => {
      const matchCat = activeCategory === "Semua" || a.category === activeCategory;
      const matchQuery =
        !q ||
        a.title.toLowerCase().includes(q) ||
        a.excerpt.toLowerCase().includes(q) ||
        a.author.toLowerCase().includes(q);
      return matchCat && matchQuery;
    });
  }, [query, activeCategory]);

  const featured = filtered.find((a) => a.featured) ?? filtered[0];
  const latest = filtered.filter((a) => a.id !== featured?.id);

  return (
    <div className="min-h-screen bg-white">
      {/* ── Hero / Header ───────────────────────────────────────── */}
      <section className="max-w-6xl mx-auto px-4 md:px-6 pt-12 md:pt-20 pb-8">
        <div className="flex items-center gap-2 mb-4">
          <span className="w-1.5 h-1.5 rounded-full bg-[#7FC248]" />
          <span className="text-xs md:text-sm font-semibold uppercase tracking-[0.2em] text-[#3B7A1C]">
            Ruang Baca
          </span>
        </div>
        <h1 className="font-extrabold text-[#0D2B05] text-4xl sm:text-5xl md:text-6xl lg:text-7xl leading-[1.05] tracking-tight">
          Artikel <span className="text-[#7FC248]">Taman Zakat</span>
        </h1>
        <p className="mt-5 text-gray-500 text-sm md:text-base max-w-2xl leading-relaxed">
          Edukasi, panduan praktis, dan kisah inspiratif seputar zakat, infak,
          sedekah, serta program kebaikan yang sedang kami jalankan.
        </p>

        {/* Search + Filter Bar */}
        <div className="mt-8 flex flex-col md:flex-row md:items-center gap-4">
          <div className="relative w-full md:max-w-xs">
            <span className="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
              <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
              </svg>
            </span>
            <input
              id="article-search"
              type="text"
              value={query}
              onChange={(e) => setQuery(e.target.value)}
              placeholder="Cari cepat…"
              className="w-full pl-10 pr-20 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-sm text-gray-700 placeholder-gray-400 outline-none focus:bg-white focus:border-[#7FC248] focus:ring-2 focus:ring-[#7FC248]/20 transition"
            />
            <span className="hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 items-center gap-1 text-[10px] text-gray-400 font-medium">
              <kbd className="px-1.5 py-0.5 rounded border border-gray-200 bg-white">⌘</kbd>
              <span>/</span>
              <kbd className="px-1.5 py-0.5 rounded border border-gray-200 bg-white">alt</kbd>
              <kbd className="px-1.5 py-0.5 rounded border border-gray-200 bg-white">K</kbd>
            </span>
          </div>

          <div className="flex flex-wrap items-center gap-1 md:gap-2 overflow-x-auto">
            {CATEGORIES.map((cat) => (
              <button
                key={cat}
                onClick={() => setActiveCategory(cat)}
                className={`flex-shrink-0 px-4 py-2 rounded-lg text-sm font-medium transition-all ${
                  activeCategory === cat
                    ? "bg-[#EAFCDC] text-[#3B7A1C]"
                    : "text-gray-500 hover:text-[#3B7A1C] hover:bg-gray-50"
                }`}
              >
                {cat}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* ── Empty state ─────────────────────────────────────────── */}
      {filtered.length === 0 && (
        <section className="max-w-6xl mx-auto px-4 md:px-6 py-20 text-center">
          <p className="text-gray-400 text-base">
            Tidak ada artikel yang cocok dengan pencarian Anda.
          </p>
          <button
            onClick={() => {
              setQuery("");
              setActiveCategory("Semua");
            }}
            className="mt-4 text-[#3B7A1C] text-sm font-semibold hover:underline"
          >
            Reset filter
          </button>
        </section>
      )}

      {/* ── Featured ────────────────────────────────────────────── */}
      {featured && (
        <section className="max-w-6xl mx-auto px-4 md:px-6 mt-6 mb-16">
          <div className="flex items-end justify-between mb-6">
            <h2 className="font-bold text-[#0D2B05] text-2xl md:text-3xl tracking-tight">
              Pilihan Editor
            </h2>
            <span className="hidden md:block text-xs text-gray-400 font-medium uppercase tracking-widest">
              Featured
            </span>
          </div>

          <a
            href="#"
            className="group grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10 items-center bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-[0_12px_40px_rgba(13,43,5,0.08)] transition-all duration-500"
          >
            <div className="relative w-full h-64 md:h-80 lg:h-[420px] overflow-hidden bg-gray-100">
              <img
                src={featured.image}
                alt={featured.title}
                className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
              />
            </div>
            <div className="px-6 pb-8 lg:pl-2 lg:pr-10 lg:py-10 flex flex-col gap-5">
              <CategoryTag category={featured.category} />
              <h3 className="font-bold text-[#0D2B05] text-2xl md:text-3xl lg:text-4xl leading-tight tracking-tight group-hover:text-[#3B7A1C] transition-colors">
                {featured.title}
              </h3>

              <div className="flex items-center gap-3">
                <div className="relative w-9 h-9 rounded-full overflow-hidden bg-gray-200 flex-shrink-0">
                  <img
                    src={featured.authorAvatar}
                    alt={featured.author}
                    className="w-full h-full object-cover"
                  />
                </div>
                <div className="flex flex-col">
                  <span className="text-sm text-gray-700">
                    Ditulis oleh <span className="font-semibold text-[#0D2B05]">{featured.author}</span>
                  </span>
                  <span className="text-xs text-gray-400">
                    Dipublikasi {featured.date}
                  </span>
                </div>
              </div>

              <p className="text-gray-500 text-sm md:text-base leading-relaxed">
                {featured.excerpt}
              </p>

              <div className="mt-2">
                <span className="inline-flex items-center gap-2 text-sm font-semibold text-[#3B7A1C] group-hover:gap-3 transition-all">
                  Baca selengkapnya
                  <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2.5} strokeLinecap="round" strokeLinejoin="round">
                    <path d="M5 12h14M13 5l7 7-7 7" />
                  </svg>
                </span>
              </div>
            </div>
          </a>
        </section>
      )}

      {/* ── Latest articles ─────────────────────────────────────── */}
      {latest.length > 0 && (
        <section className="max-w-6xl mx-auto px-4 md:px-6 pb-24">
          <div className="flex items-end justify-between mb-6">
            <h2 className="font-bold text-[#0D2B05] text-2xl md:text-3xl tracking-tight">
              Artikel Terbaru
            </h2>
            <a
              href="#"
              className="hidden md:inline-flex items-center gap-1 text-sm text-[#3B7A1C] font-semibold hover:gap-2 transition-all"
            >
              Lihat semua
              <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2.5} strokeLinecap="round" strokeLinejoin="round">
                <path d="M9 18l6-6-6-6" />
              </svg>
            </a>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
            {latest.map((a) => (
              <ArticleCard key={a.id} article={a} />
            ))}
          </div>
        </section>
      )}
    </div>
  );
}
