"use client";

import { useState, useEffect } from "react";
import Image from "next/image";
import Link from "next/link";

type TabCategories = "Aksi Taman Zakat" | "Report Program" | "Annual Report" | "Artikel";

const dummyContents: Record<TabCategories, { mainImage: string, subImages: string[], sideCards: string[] }> = {
  "Aksi Taman Zakat": {
    mainImage: "",
    subImages: ["", ""],
    sideCards: [
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit.\\nSed do eiusmod tempor incididunt ut labore.",
      "Ut enim ad minim veniam, quis nostrud exercitation ullamco\\nlaboris nisi ut aliquip ex ea commodo consequat.",
      "Duis aute irure dolor in reprehenderit in voluptate\\nvelit esse cillum dolore eu fugiat nulla pariatur.",
      "Excepteur sint occaecat cupidatat non proident,\\nsunt in culpa qui officia deserunt mollit anim id est laborum.",
    ]
  },
  "Report Program": {
    mainImage: "",
    subImages: ["", ""],
    sideCards: [
      "Curabitur pretium tincidunt lacus. Nulla gravida orci a odio.\\nNullam varius, turpis et commodo pharetra.",
      "Est eros bibendum elit, nec luctus magna felis sollicitudin mauris.\\nInteger in mauris eu nibh euismod gravida.",
      "Duis ac tellus et risus vulputate vehicula. Donec lobortis\\nrisus a elit. Etiam tempor. Ut ullamcorper.",
      "Ligula a dictum consequat, lectus risus luctus ipsum,\\nvestibulum tempor mauris tellus ut erat.",
    ]
  },
  "Annual Report": {
    mainImage: "",
    subImages: ["", ""],
    sideCards: [
      "Aenean auctor wisi et urna. Aliquam erat volutpat.\\nMaecenas viverra augue tempor ipsum. Aenean auctor wisi.",
      "Dignissim in, mollis mattis, ullamcorper in, adipiscing id, tortor.\\nDonec id libero euismod sapien fringilla.",
      "Phasellus in felis. Donec semper sapien a libero.\\nNam dui. Aenean eu libero. Nullam scelerisque id, molestie in.",
      "Quisque cursus, metus vitae pharetra auctor, sem massa\\nmattis sem, at interdum magna augue eget diam.",
    ]
  },
  "Artikel": {
    mainImage: "",
    subImages: ["", ""],
    sideCards: [
      "Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.\\nNunc rhoncus diam magna augue.",
      "Pellentesque habitant morbi tristique senectus et netus\\net malesuada fames ac turpis egestas.",
      "Aliquam dui mi, vulputate nec, tristique id, ullamcorper id, sed.\\nInteger sem turpis, id sem, rhoncus.",
      "Fusce sagittis, libero non molestie mollis, magna orci ultrices dolor,\\nat vulputate neque nulla lacinia eros.",
    ]
  }
};

export default function BeritaTabs() {
  const [activeTab, setActiveTab] = useState<TabCategories>("Aksi Taman Zakat");
  const [newsData, setNewsData] = useState<any[]>([]);

  useEffect(() => {
    // Fetch berita untuk Home
    const fetchNews = async () => {
      try {
        const apiUrl = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';
        const response = await fetch(`${apiUrl}/berita/home`);
        if (response.ok) {
          const data = await response.json();
          setNewsData(data);
        }
      } catch (error) {
        console.error("Gagal mengambil data berita:", error);
      }
    };
    fetchNews();
  }, []);

  const dummyContent = dummyContents[activeTab];

  // Map API data ke layout
  // Jika newsData ada, kita gunakan newsData. Jika tidak, gunakan dummy.
  // Layout butuh: 1 main image, 2 sub images, 4 side cards
  
  const mainArticle = newsData.length > 0 ? newsData[0] : null;
  const subArticles = newsData.length > 1 ? newsData.slice(1, 3) : [];
  const sideArticles = newsData.length > 3 ? newsData.slice(3, 7) : [];
  
  const backendUrl = (process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api').replace('/api', '');

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
            {(Object.keys(dummyContents) as TabCategories[]).map((tab) => (
              <li 
                key={tab}
                onClick={() => setActiveTab(tab)}
                className={`cursor-pointer transition-colors ${
                  activeTab === tab 
                  ? "text-[#71C935] font-bold" 
                  : "text-[#3B7A1C] hover:text-[#71C935]"
                }`}
              >
                {tab}
              </li>
            ))}
          </ul>
        </div>

        {/* Content Area Rendering */}
        <div className="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-6 animate-in fade-in slide-in-from-bottom-2 duration-500 ease-in-out" key={activeTab}>
          {/* Main Grid (Images) */}
          <div className="space-y-4 flex flex-col">
            <Link href={mainArticle ? `/berita/${mainArticle.slug}` : '#'} className="block h-[300px] sm:h-[400px] rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm flex items-center justify-center overflow-hidden relative group">
              {mainArticle ? (
                <>
                  <img src={`${backendUrl}/storage/${mainArticle.thumbnail}`} alt={mainArticle.judul} className="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6">
                    <h3 className="text-white text-xl sm:text-2xl font-bold line-clamp-2">{mainArticle.judul}</h3>
                  </div>
                </>
              ) : dummyContent.mainImage ? (
                <Image src={dummyContent.mainImage} alt="Main Article" fill className="object-cover" />
              ) : (
                <span className="text-gray-400 font-medium tracking-wide">Gambar Utama ({activeTab})</span>
              )}
            </Link>
            
            <div className="grid grid-cols-2 gap-4 flex-1">
              {subArticles.length > 0 ? subArticles.map((article: any, idx: number) => (
                <Link href={`/berita/${article.slug}`} key={idx} className="block h-32 sm:h-44 rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm flex items-center justify-center overflow-hidden relative group">
                  <img src={`${backendUrl}/storage/${article.thumbnail}`} alt={article.judul} className="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                  <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-3">
                    <h3 className="text-white text-sm sm:text-base font-bold line-clamp-2">{article.judul}</h3>
                  </div>
                </Link>
              )) : dummyContent.subImages.map((img, idx) => (
                <div key={idx} className="h-32 sm:h-44 rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm flex items-center justify-center overflow-hidden relative">
                   {img ? (
                     <Image src={img} alt={`Sub image ${idx}`} fill className="object-cover" />
                   ) : (
                     <span className="text-sm text-gray-400">Gambar {idx+1}</span>
                   )}
                </div>
              ))}
            </div>
          </div>

          {/* List Grid (Articles) */}
          <div className="flex flex-col gap-4">
            {sideArticles.length > 0 ? sideArticles.map((article: any, id: number) => (
              <Link href={`/berita/${article.slug}`} key={id} className="grid grid-cols-[100px_1fr] sm:grid-cols-[140px_1fr] items-start gap-4 flex-1 transition-transform hover:-translate-y-1 duration-300">
                <div className="h-full min-h-[90px] sm:min-h-[110px] w-full rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm flex items-center justify-center overflow-hidden relative">
                   <img src={`${backendUrl}/storage/${article.thumbnail}`} alt={article.judul} className="absolute inset-0 w-full h-full object-cover" />
                </div>
                <div className="pt-2 flex flex-col h-full bg-white rounded-lg border border-[#D1D1D1] shadow-sm px-4 py-3 justify-center">
                  <p className="text-xs sm:text-sm font-bold text-black break-words leading-relaxed line-clamp-3">
                    {article.judul}
                  </p>
                </div>
              </Link>
            )) : dummyContent.sideCards.map((title, id) => (
              <article key={id} className="grid grid-cols-[100px_1fr] sm:grid-cols-[140px_1fr] items-start gap-4 flex-1 transition-transform hover:-translate-y-1 duration-300">
                <div className="h-full min-h-[90px] sm:min-h-[110px] w-full rounded-lg border border-[#D1D1D1] bg-[#F9F9F9] shadow-sm flex items-center justify-center overflow-hidden relative">
                   <span className="text-xs text-gray-400">Thumbnail</span>
                </div>
                <div className="pt-2 flex flex-col h-full bg-white rounded-lg border border-[#D1D1D1] shadow-sm px-4 py-3 justify-center">
                  <p className="text-xs font-mono text-black break-words leading-relaxed whitespace-pre-wrap font-bold">
                    {title}
                  </p>
                </div>
              </article>
            ))}
          </div>
        </div>

        <div className="mt-8 mb-4">
          <a
            href="#"
            className="inline-flex w-fit items-center text-white bg-[#97D769] px-10 py-2 rounded-md font-medium text-sm shadow-sm hover:bg-[#7FC248] transition-colors"
          >
            Lihat Lebih Banyak Berita
          </a>
        </div>
      </div>
    </section>
  );
}
