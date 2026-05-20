"use client";

import { useState, useEffect } from "react";
import Link from "next/link";

const CATEGORIES = ["Semua", "Aksi Taman Zakat", "Report Program", "Annual Report"] as const;
type TabCategory = typeof CATEGORIES[number];

export default function BeritaTabs() {
  const [activeTab, setActiveTab] = useState<TabCategory>("Semua");
  const [newsData, setNewsData] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchNews = async () => {
      try {
        const apiUrl = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`;
        const response = await fetch(`${apiUrl}/berita/home`);
        if (response.ok) {
          const data = await response.json();
          setNewsData(data);
        }
      } catch (error) {
        console.error("Gagal mengambil data berita:", error);
      } finally {
        setLoading(false);
      }
    };
    fetchNews();
  }, []);

  const backendUrl = (`${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`).replace('/api', '');

  // Filter berita berdasarkan kategori aktif
  const filteredNews = activeTab === "Semua" ? newsData : newsData.filter((article: any) => article.kategori === activeTab);

  const mainArticle = filteredNews.length > 0 ? filteredNews[0] : null;
  const subArticles = filteredNews.length > 1 ? filteredNews.slice(1, 3) : [];
  const sideArticles = filteredNews.length > 3 ? filteredNews.slice(3, 7) : [];

  const hasContent = filteredNews.length > 0;

  return (
    <section className="mt-20">
      <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div className="relative flex items-center justify-center mb-4">
          {/* Line Behind Title */}
          <div className="absolute left-0 bottom-1/2 right-0 h-[2px] bg-[#97D769] -z-10"></div>

          <div className="bg-white px-2">
            <h2 className="rounded-sm border border-[#97D769] bg-white px-8 py-2 text-2xl sm:text-3xl font-bold text-black text-center shadow-sm">
              Berita <span className="text-[#97D769] font-light">Taman Zakat</span>
            </h2>
          </div>
        </div>

        {/* Tabs Navigation */}
        <div className="border-y border-[#97D769] py-3 mb-8">
          <ul className="flex flex-wrap items-center justify-center gap-6 sm:gap-14 text-sm sm:text-base font-medium">
            {CATEGORIES.map((tab) => (
              <li
                key={tab}
                onClick={() => setActiveTab(tab)}
                className={`cursor-pointer transition-colors ${activeTab === tab
                    ? "text-[#71C935] font-bold"
                    : "text-[#3B7A1C] hover:text-[#71C935]"
                  }`}
              >
                {tab}
              </li>
            ))}
          </ul>
        </div>

        {/* Content Area */}
        {loading ? (
          <div className="flex justify-center items-center py-20">
            <div className="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-[#7FC248]"></div>
          </div>
        ) : !hasContent ? (
          <div className="flex flex-col items-center justify-center py-16 text-center">
            <svg className="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <p className="text-gray-400 text-lg font-medium mb-1">Belum ada berita</p>
            <p className="text-gray-300 text-sm">Berita dengan kategori <span className="font-semibold">&quot;{activeTab}&quot;</span> belum tersedia.</p>
          </div>
        ) : (
          <div className="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-6 animate-in fade-in slide-in-from-bottom-2 duration-500 ease-in-out" key={activeTab}>
            {/* Main Grid (Images) */}
            <div className="space-y-4 flex flex-col">
              <Link href={`/berita/${mainArticle!.slug}`} className="block h-[300px] sm:h-[400px] rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm overflow-hidden relative group">
                <img src={`${backendUrl}/storage/${mainArticle!.thumbnail}`} alt={mainArticle!.judul} className="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6">
                  <h3 className="text-white text-xl sm:text-2xl font-bold line-clamp-2">{mainArticle!.judul}</h3>
                </div>
              </Link>

              {subArticles.length > 0 && (
                <div className="grid grid-cols-2 gap-4 flex-1">
                  {subArticles.map((article: any, idx: number) => (
                    <Link href={`/berita/${article.slug}`} key={idx} className="block h-32 sm:h-44 rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm overflow-hidden relative group">
                      <img src={`${backendUrl}/storage/${article.thumbnail}`} alt={article.judul} className="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                      <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-3">
                        <h3 className="text-white text-sm sm:text-base font-bold line-clamp-2">{article.judul}</h3>
                      </div>
                    </Link>
                  ))}
                </div>
              )}
            </div>

            {/* List Grid (Side Articles) */}
            {sideArticles.length > 0 && (
              <div className="flex flex-col gap-4">
                {sideArticles.map((article: any, id: number) => (
                  <Link href={`/berita/${article.slug}`} key={id} className="grid grid-cols-[100px_1fr] sm:grid-cols-[140px_1fr] items-start gap-4 flex-1 transition-transform hover:-translate-y-1 duration-300">
                    <div className="h-full min-h-[90px] sm:min-h-[110px] w-full rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm overflow-hidden relative">
                      <img src={`${backendUrl}/storage/${article.thumbnail}`} alt={article.judul} className="absolute inset-0 w-full h-full object-cover" />
                    </div>
                    <div className="pt-2 flex flex-col h-full bg-white rounded-lg border border-[#D1D1D1] shadow-sm px-4 py-3 justify-center">
                      <p className="text-xs sm:text-sm font-bold text-black break-words leading-relaxed line-clamp-3">
                        {article.judul}
                      </p>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </div>
        )}

        <div className="mt-8 mb-4">
          <Link
            href="/berita"
            className="inline-flex w-fit items-center text-white bg-[#97D769] px-10 py-2 rounded-md font-medium text-sm shadow-sm hover:bg-[#7FC248] transition-colors"
          >
            Lihat Lebih Banyak Berita
          </Link>
        </div>
      </div>
    </section>
  );
}
