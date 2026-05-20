"use client";

import { useState, useEffect } from "react";
import Link from "next/link";

type BeritaAPI = {
  id: number;
  judul: string;
  slug: string;
  kategori: string;
  thumbnail: string;
  konten: string;
  is_popular: boolean;
  tags?: string;
  created_at: string;
};

// Map backend to frontend Article structure
type Article = {
  id: number;
  slug: string;
  category: string;
  date: string;
  title: string;
  excerpt: string;
  tags: string;
  tier: "hero" | "highlight" | "regular";
  thumbnailUrl: string;
};

const CATEGORIES = ["Semua", "Aksi Taman Zakat", "Report Program", "Annual Report"];
const ITEMS_PER_PAGE = 8;

function CategoryBadge({ label }: { label: string }) {
  return (
    <span className="inline-block bg-[#7FC248]/10 text-[#7FC248] text-xs font-semibold px-2.5 py-0.5 rounded-full">
      {label}
    </span>
  );
}

function ArrowButton({ small = false }: { small?: boolean }) {
  const size = small ? "w-6 h-6" : "w-8 h-8";
  const iconSize = small ? "w-3 h-3" : "w-4 h-4";
  return (
    <button
      className={`${size} rounded-full bg-[#7FC248] text-white flex items-center justify-center hover:bg-[#5DA630] transition-colors flex-shrink-0`}
    >
      <svg className={iconSize} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2.5} strokeLinecap="round" strokeLinejoin="round">
        <path d="M9 18l6-6-6-6" />
      </svg>
    </button>
  );
}

// ── Kartu hero (full width, landscape) ──────────────────────────────────────
function HeroCard({ article }: { article: Article }) {
  return (
    <Link href={`/berita/${article.slug}`}>
      <div className="flex flex-col md:flex-row rounded-2xl overflow-hidden border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-300 bg-white cursor-pointer group">
        {/* Gambar */}
        <div className="w-full md:w-1/2 h-56 md:h-80 bg-gray-100 flex-shrink-0 relative overflow-hidden">
          <img
            src={article.thumbnailUrl}
            alt={article.title}
            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
          />
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
    </Link>
  );
}

// ── Kartu highlight (portrait, medium) ──────────────────────────────────────
function HighlightCard({ article }: { article: Article }) {
  return (
    <Link href={`/berita/${article.slug}`} className="block h-full">
      <div className="flex flex-row rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 bg-white cursor-pointer group h-full">
        {/* Gambar kiri */}
        <div className="w-36 flex-shrink-0 bg-gray-100 relative overflow-hidden">
          <img
            src={article.thumbnailUrl}
            alt={article.title}
            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
          />
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
    </Link>
  );
}

// ── Kartu regular (portrait, kecil) ─────────────────────────────────────────
function RegularCard({ article }: { article: Article }) {
  return (
    <Link href={`/berita/${article.slug}`} className="block h-full">
      <div className="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:border-[#7FC248]/30 hover:scale-[1.02] transition-all duration-300 cursor-pointer group flex flex-col h-full">
        {/* Gambar */}
        <div className="h-36 bg-gray-100 flex-shrink-0 relative overflow-hidden">
          <img
            src={article.thumbnailUrl}
            alt={article.title}
            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
          />
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
    </Link>
  );
}

// ── Halaman utama ─────────────────────────────────────────────────────────
export default function NewsPage() {
  const [articles, setArticles] = useState<Article[]>([]);
  const [loading, setLoading] = useState(true);
  const [query, setQuery] = useState("");
  const [activeCategory, setActiveCategory] = useState("Semua");
  const [currentPage, setCurrentPage] = useState(1);

  useEffect(() => {
    async function fetchBerita() {
      try {
        const res = await fetch(`${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}/berita`);
        const data: BeritaAPI[] = await res.json();
        
        let popularCount = 0;
        
        const mappedData: Article[] = data.map((b) => {
          // Strip HTML tags for excerpt
          const strippedKonten = b.konten.replace(/<[^>]+>/g, "");
          const excerpt = strippedKonten.substring(0, 100) + "...";
          
          let tier: "hero" | "highlight" | "regular" = "regular";
          
          if (b.is_popular) {
             if (popularCount === 0) {
                 tier = "hero";
             } else if (popularCount <= 2) {
                 tier = "highlight";
             }
             popularCount++;
          }
          
          return {
            id: b.id,
            slug: b.slug,
            category: b.kategori || "Artikel",
            date: new Date(b.created_at).toLocaleDateString("id-ID", {
              day: "numeric",
              month: "short",
              year: "numeric"
            }),
            title: b.judul,
            excerpt: excerpt,
            tags: b.tags || "",
            tier: tier,
            thumbnailUrl: `/storage/${b.thumbnail}`
          };
        });
        
        setArticles(mappedData);
      } catch (error) {
        console.error("Failed to fetch berita", error);
      } finally {
        setLoading(false);
      }
    }
    fetchBerita();
  }, []);

  useEffect(() => {
    setCurrentPage(1);
  }, [query, activeCategory]);

  const filtered = articles.filter((a) => {
    const matchCat = activeCategory === "Semua" || a.category === activeCategory;
    const q = query.toLowerCase();
    const matchQ = !q || a.title.toLowerCase().includes(q) || a.category.toLowerCase().includes(q) || a.tags.toLowerCase().includes(q);
    return matchCat && matchQ;
  });

  const hero       = filtered.filter((a) => a.tier === "hero");
  const highlights = filtered.filter((a) => a.tier === "highlight");
  const regulars   = filtered.filter((a) => a.tier === "regular");

  const totalPages = Math.max(1, Math.ceil(regulars.length / ITEMS_PER_PAGE));
  const paginatedRegulars = regulars.slice(
    (currentPage - 1) * ITEMS_PER_PAGE,
    currentPage * ITEMS_PER_PAGE
  );

  const hasPopular = hero.length > 0 || highlights.length > 0;

  return (
    <div className="min-h-screen bg-[#F5FCF0]">

      {/* ── Hero banner ──────────────────────────────────────── */}
      <div className="w-full relative py-14 px-4 overflow-hidden">
        {/* Background image dummy */}
        <img
          src="https://picsum.photos/seed/berita-taza/1600/500"
          alt=""
          aria-hidden
          className="absolute inset-0 w-full h-full object-cover"
        />
        {/* Overlay hijau gelap */}
        <div className="absolute inset-0 bg-[#1e5b3a]/85" />

        <div className="relative z-10 max-w-4xl mx-auto text-center">
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
        
        {loading ? (
            <div className="flex justify-center items-center py-20">
                <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#7FC248]"></div>
            </div>
        ) : filtered.length === 0 ? (
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
                  {paginatedRegulars.map((a) => (
                    <RegularCard key={a.id} article={a} />
                  ))}
                </div>

                {/* Pagination */}
                {totalPages > 1 && (
                  <div className="flex items-center justify-center gap-2 mt-8">
                    <button
                      onClick={() => setCurrentPage((p) => Math.max(1, p - 1))}
                      disabled={currentPage === 1}
                      className="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#7FC248] hover:text-[#7FC248] disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                    >
                      <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2.5} strokeLinecap="round" strokeLinejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                      </svg>
                    </button>

                    {Array.from({ length: totalPages }, (_, i) => i + 1).map((page) => (
                      <button
                        key={page}
                        onClick={() => setCurrentPage(page)}
                        className={`w-8 h-8 rounded-full text-sm font-medium transition-colors ${
                          page === currentPage
                            ? "bg-[#7FC248] text-white shadow-sm"
                            : "border border-gray-300 text-gray-600 hover:border-[#7FC248] hover:text-[#7FC248]"
                        }`}
                      >
                        {page}
                      </button>
                    ))}

                    <button
                      onClick={() => setCurrentPage((p) => Math.min(totalPages, p + 1))}
                      disabled={currentPage === totalPages}
                      className="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:border-[#7FC248] hover:text-[#7FC248] disabled:opacity-30 disabled:cursor-not-allowed transition-colors"
                    >
                      <svg className="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth={2.5} strokeLinecap="round" strokeLinejoin="round">
                        <path d="M9 18l6-6-6-6" />
                      </svg>
                    </button>
                  </div>
                )}
              </section>
            )}
          </>
        )}
      </div>
    </div>
  );
}
