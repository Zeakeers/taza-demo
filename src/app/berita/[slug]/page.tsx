"use client";

import { useEffect, useState } from "react";
import { useParams, useRouter } from "next/navigation";
import Link from "next/link";
import { ArrowLeft, Calendar, Share2, Link as LinkIcon } from "lucide-react";

type Berita = {
  id: number;
  judul: string;
  slug: string;
  kategori: string;
  thumbnail: string;
  konten: string;
  tags?: string;
  created_at: string;
};

export default function BeritaDetailPage() {
  const params = useParams();
  const router = useRouter();
  const [berita, setBerita] = useState<Berita | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  const slug = params?.slug as string;

  useEffect(() => {
    async function fetchBerita() {
      try {
        const res = await fetch(`http://127.0.0.1:8000/api/berita/${slug}`);
        if (!res.ok) {
          if (res.status === 404) {
            setError("Berita tidak ditemukan.");
          } else {
            setError("Gagal memuat berita.");
          }
          setLoading(false);
          return;
        }
        const data = await res.json();
        setBerita(data);
      } catch (err) {
        setError("Terjadi kesalahan sistem.");
      } finally {
        setLoading(false);
      }
    }
    fetchBerita();
  }, [slug]);

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-white">
        <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#7FC248]"></div>
      </div>
    );
  }

  if (error || !berita) {
    return (
      <div className="min-h-screen flex flex-col items-center justify-center bg-gray-50">
        <h2 className="text-2xl font-bold text-gray-800 mb-4">{error || "Berita tidak ditemukan"}</h2>
        <button onClick={() => router.back()} className="px-6 py-2 bg-[#7FC248] text-white rounded-full font-medium hover:bg-[#68a03a] transition-colors">
          Kembali
        </button>
      </div>
    );
  }

  const formattedDate = new Date(berita.created_at).toLocaleDateString("id-ID", {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  });

  return (
    <main className="min-h-screen bg-[#FDFDFD] font-poppins pb-20">
      {/* ── Navbar Spacer / Header Area ──────────────────────── */}
      <div className="w-full h-24 bg-white border-b border-gray-100"></div>

      {/* ── Content Area ──────────────────────── */}
      <article className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12">
        {/* Breadcrumb & Back */}
        <div className="flex items-center gap-4 mb-8">
          <button 
            onClick={() => router.back()}
            className="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-600 hover:bg-[#7FC248] hover:text-white transition-all"
          >
            <ArrowLeft className="w-5 h-5" />
          </button>
          <div className="flex items-center text-sm font-medium text-gray-500">
            <Link href="/" className="hover:text-[#7FC248] transition-colors">Home</Link>
            <span className="mx-2">/</span>
            <Link href="/berita" className="hover:text-[#7FC248] transition-colors">Berita</Link>
            <span className="mx-2">/</span>
            <span className="text-gray-900 truncate max-w-[200px] md:max-w-xs">{berita.judul}</span>
          </div>
        </div>

        {/* Title Section */}
        <header className="mb-8">
          <div className="inline-block px-3 py-1 mb-4 text-xs font-bold text-[#7FC248] bg-[#7FC248]/10 rounded-full">
            {berita.kategori || "Artikel"}
          </div>
          <h1 className="text-3xl md:text-5xl font-bold text-gray-900 leading-tight md:leading-[1.1] mb-6">
            {berita.judul}
          </h1>
          
          <div className="flex flex-col sm:flex-row sm:items-center justify-between py-4 border-y border-gray-100 gap-4">
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-full bg-[#7FC248] flex items-center justify-center text-white font-bold text-lg">
                TZ
              </div>
              <div>
                <p className="text-sm font-semibold text-gray-900">Redaksi Taman Zakat</p>
                <div className="flex items-center text-xs text-gray-500 gap-2 mt-0.5">
                  <Calendar className="w-3.5 h-3.5" />
                  <span>{formattedDate}</span>
                </div>
              </div>
            </div>

            {/* Social Share */}
            <div className="flex items-center gap-2">
              <span className="text-xs font-semibold text-gray-400 mr-2 uppercase tracking-wider">Bagikan</span>
              <button className="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors">
                <LinkIcon className="w-4 h-4" />
              </button>
            </div>
          </div>
        </header>

        {/* Hero Image */}
        <figure className="mb-12 relative w-full aspect-[16/9] md:aspect-[2/1] rounded-2xl overflow-hidden shadow-lg bg-gray-100 group">
          <img
            src={`http://127.0.0.1:8000/storage/${berita.thumbnail}`}
            alt={berita.judul}
            className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out"
          />
        </figure>

        {/* Article Body */}
        <div className="max-w-3xl mx-auto">
          <div 
            className="prose prose-lg max-w-none text-gray-700
              [&>p]:mb-6 [&>p]:leading-relaxed
              [&>h2]:text-2xl [&>h2]:font-bold [&>h2]:text-gray-900 [&>h2]:mt-10 [&>h2]:mb-4
              [&>h3]:text-xl [&>h3]:font-bold [&>h3]:text-gray-900 [&>h3]:mt-8 [&>h3]:mb-3
              [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:mb-6 [&>ul>li]:mb-2
              [&>ol]:list-decimal [&>ol]:pl-5 [&>ol]:mb-6 [&>ol>li]:mb-2
              [&>blockquote]:border-l-4 [&>blockquote]:border-[#7FC248] [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-gray-600 [&>blockquote]:my-8 [&>blockquote]:bg-gray-50 [&>blockquote]:py-3 [&>blockquote]:pr-4 [&>blockquote]:rounded-r-lg
              [&>img]:w-full [&>img]:rounded-xl [&>img]:my-8 [&>img]:shadow-md [&>img]:mx-auto
              [&>figure]:my-8 [&>figure>img]:rounded-xl [&>figure>img]:w-full [&>figure>img]:shadow-md
              [&>a]:text-[#7FC248] [&>a]:underline [&>a]:font-medium hover:[&>a]:text-[#68a03a]"
            dangerouslySetInnerHTML={{ __html: berita.konten }}
          />

          {/* Tags / Footer Article */}
          <div className="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div className="flex flex-wrap gap-2">
              {berita.tags ? (
                berita.tags.split(',').map((tag, index) => (
                  <span key={index} className="px-4 py-1.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-full hover:bg-gray-200 cursor-pointer transition-colors">
                    #{tag.trim()}
                  </span>
                ))
              ) : (
                <span className="px-4 py-1.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-full hover:bg-gray-200 cursor-pointer transition-colors">#BeritaTerkini</span>
              )}
            </div>
            
            <button className="flex items-center gap-2 text-[#7FC248] font-bold hover:text-[#68a03a] transition-colors">
              <Share2 className="w-5 h-5" />
              <span>Bagikan Berita</span>
            </button>
          </div>
        </div>
      </article>
      
      {/* ── Read More Section (Static for now to match UI) ──────────────────────── */}
      <section className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 pt-12 border-t-2 border-gray-100">
        <h3 className="text-2xl font-bold text-gray-900 mb-8">Berita Terkait</h3>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Dummy Related Card 1 */}
          <Link href="/berita" className="group flex flex-col sm:flex-row gap-4 bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div className="w-full sm:w-32 h-24 bg-gray-200 rounded-xl flex-shrink-0 relative overflow-hidden">
               <div className="absolute inset-0 bg-gradient-to-br from-[#7FC248]/20 to-[#7FC248]/40" />
            </div>
            <div className="flex flex-col justify-center">
              <p className="text-xs text-[#7FC248] font-bold uppercase tracking-wider mb-1">Sosial</p>
              <h4 className="font-bold text-gray-900 group-hover:text-[#7FC248] transition-colors line-clamp-2">Qurban di Era Digital: Manfaat Lebih Luas hingga Pelosok Negeri</h4>
            </div>
          </Link>
          
          {/* Dummy Related Card 2 */}
          <Link href="/berita" className="group flex flex-col sm:flex-row gap-4 bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-all">
            <div className="w-full sm:w-32 h-24 bg-gray-200 rounded-xl flex-shrink-0 relative overflow-hidden">
              <div className="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-blue-600/20" />
            </div>
            <div className="flex flex-col justify-center">
              <p className="text-xs text-blue-500 font-bold uppercase tracking-wider mb-1">Kemanusiaan</p>
              <h4 className="font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">Perkuat Pengelolaan Huntara di Aceh Tamiang, Langkah Bersama</h4>
            </div>
          </Link>
        </div>
      </section>
    </main>
  );
}
