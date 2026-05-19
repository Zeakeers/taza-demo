"use client";

import { useEffect, useState } from "react";
import { useParams, useRouter } from "next/navigation";
import Link from "next/link";
import { ArrowLeft, Calendar, Share2, Link as LinkIcon, Check } from "lucide-react";

// Aesthetic Social Icons
const WhatsappIcon = () => (
  <svg viewBox="0 0 24 24" fill="currentColor" className="w-5 h-5 text-[#25D366] drop-shadow-sm">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
  </svg>
);

const FacebookIcon = () => (
  <svg viewBox="0 0 24 24" fill="currentColor" className="w-5 h-5 text-[#1877F2] drop-shadow-sm">
    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
  </svg>
);

const TwitterIcon = () => (
  <svg viewBox="0 0 24 24" fill="currentColor" className="w-5 h-5 text-gray-800 drop-shadow-sm">
    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
  </svg>
);

const InstagramIcon = () => (
  <svg viewBox="0 0 24 24" fill="currentColor" className="w-5 h-5 text-[#E1306C] drop-shadow-sm">
    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
  </svg>
);

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
  const [related, setRelated] = useState<Berita[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [copied, setCopied] = useState(false);
  const [showShareMenu, setShowShareMenu] = useState(false);

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

        // Fetch related berita
        try {
          const resRelated = await fetch(`http://127.0.0.1:8000/api/berita/${slug}/related`);
          if (resRelated.ok) {
            const dataRelated = await resRelated.json();
            setRelated(dataRelated);
          }
        } catch (err) {
          console.error("Gagal memuat berita terkait", err);
        }
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

  const handleCopyLink = async () => {
    try {
      await navigator.clipboard.writeText(window.location.href);
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch (err) {
      console.error("Gagal menyalin link: ", err);
    }
  };


  const shareUrl = typeof window !== 'undefined' ? encodeURIComponent(window.location.href) : '';
  const shareTitle = berita ? encodeURIComponent(berita.judul) : '';

  return (
    <main className="min-h-screen bg-[#FDFDFD] font-poppins pb-20 overflow-x-hidden">
      {/* ── Content Area ──────────────────────── */}
      <article className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12">
        {/* Breadcrumb & Back */}
        <div className="flex items-center gap-4 mb-8">
          <button 
            onClick={() => router.back()}
            className="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-600 hover:bg-[#7FC248] hover:text-white transition-all"
          >
            <ArrowLeft className="w-5 h-5" />
          </button>
          <div className="flex flex-wrap items-center text-sm font-medium text-gray-500 gap-y-1 min-w-0">
            <Link href="/" className="hover:text-[#7FC248] transition-colors shrink-0">Home</Link>
            <span className="mx-1 sm:mx-2 shrink-0">/</span>
            <Link href="/berita" className="hover:text-[#7FC248] transition-colors shrink-0">Berita</Link>
            <span className="mx-1 sm:mx-2 shrink-0">/</span>
            <span className="text-gray-900 truncate max-w-[120px] sm:max-w-[200px] md:max-w-xs">{berita.judul}</span>
          </div>
        </div>

        {/* Title Section */}
        <header className="mb-8">
          <div className="inline-block px-3 py-1 mb-4 text-xs font-bold text-[#7FC248] bg-[#7FC248]/10 rounded-full">
            {berita.kategori || "Artikel"}
          </div>
          <h1 className="text-2xl sm:text-3xl md:text-5xl font-bold text-gray-900 leading-snug sm:leading-tight md:leading-[1.1] mb-6 break-words">
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
              <div className="relative flex flex-col items-center">
                {copied && (
                  <div className="absolute -top-8 bg-[#7FC248] text-white text-[10px] font-medium px-2 py-1 rounded shadow-md whitespace-nowrap transition-all">
                    Tersalin!
                    <div className="absolute -bottom-1 left-1/2 -translate-x-1/2 border-t-4 border-t-[#7FC248] border-x-4 border-x-transparent"></div>
                  </div>
                )}
                <button 
                  onClick={handleCopyLink}
                  className="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors"
                  title="Salin Link"
                >
                  <LinkIcon className="w-4 h-4" />
                </button>
              </div>
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
            
            <div className="relative">
              <button 
                onClick={() => setShowShareMenu(!showShareMenu)}
                className="flex items-center gap-2 text-[#7FC248] font-bold hover:text-[#68a03a] transition-colors"
              >
                <Share2 className="w-5 h-5" />
                <span>Bagikan Berita</span>
              </button>

              {showShareMenu && (
                <div className="absolute bottom-full mb-3 right-0 bg-white border border-gray-100 rounded-2xl shadow-xl p-2.5 flex flex-col gap-1 w-56 z-10 transition-all origin-bottom-right">
                  <div className="px-3 py-2 mb-1 border-b border-gray-50">
                    <p className="text-xs font-bold text-gray-500 uppercase tracking-wider">Bagikan ke</p>
                  </div>
                  
                  <a href={`https://api.whatsapp.com/send?text=Baca berita menarik ini: ${shareTitle} - ${shareUrl}`} target="_blank" rel="noopener noreferrer" className="flex items-center gap-3 px-3 py-2.5 hover:bg-[#25D366]/10 hover:text-[#25D366] rounded-xl text-sm font-semibold text-gray-700 transition-colors group">
                    <WhatsappIcon />
                    WhatsApp
                  </a>
                  
                  <a href={`https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`} target="_blank" rel="noopener noreferrer" className="flex items-center gap-3 px-3 py-2.5 hover:bg-[#1877F2]/10 hover:text-[#1877F2] rounded-xl text-sm font-semibold text-gray-700 transition-colors group">
                    <FacebookIcon />
                    Facebook
                  </a>
                  
                  <a href={`https://twitter.com/intent/tweet?url=${shareUrl}&text=Baca berita menarik ini: ${shareTitle}`} target="_blank" rel="noopener noreferrer" className="flex items-center gap-3 px-3 py-2.5 hover:bg-gray-100 hover:text-gray-900 rounded-xl text-sm font-semibold text-gray-700 transition-colors group">
                    <TwitterIcon />
                    Twitter / X
                  </a>
                  
                  <button onClick={() => { handleCopyLink(); setShowShareMenu(false); window.open('https://www.instagram.com/', '_blank'); }} className="flex items-center gap-3 px-3 py-2.5 hover:bg-[#E1306C]/10 hover:text-[#E1306C] rounded-xl text-sm font-semibold text-gray-700 transition-colors group w-full text-left">
                    <InstagramIcon />
                    Instagram
                  </button>
                  
                  <div className="h-px bg-gray-100 my-1"></div>
                  
                  <button onClick={() => { handleCopyLink(); setShowShareMenu(false); }} className="flex items-center gap-3 px-3 py-2.5 hover:bg-[#7FC248]/10 hover:text-[#7FC248] rounded-xl text-sm font-semibold text-gray-700 transition-colors group w-full text-left">
                    {copied ? <Check className="w-5 h-5 text-[#7FC248]" /> : <LinkIcon className="w-5 h-5 text-gray-400 group-hover:text-[#7FC248]" />}
                    {copied ? "Berhasil Disalin!" : "Salin Tautan"}
                  </button>
                </div>
              )}
            </div>
          </div>
        </div>
      </article>
      
      {/* ── Read More Section ──────────────────────── */}
      {related.length > 0 && (
        <section className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 pt-12 border-t-2 border-gray-100">
          <h3 className="text-2xl font-bold text-gray-900 mb-8">Berita Terkait</h3>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {related.map((item) => (
              <Link key={item.id} href={`/berita/${item.slug}`} className="group flex flex-col sm:flex-row gap-4 bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-all">
                <div className="w-full aspect-[16/9] sm:aspect-auto sm:w-32 sm:h-24 bg-gray-200 rounded-xl flex-shrink-0 relative overflow-hidden">
                  <img src={`http://127.0.0.1:8000/storage/${item.thumbnail}`} alt={item.judul} className="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                </div>
                <div className="flex flex-col justify-center">
                  <p className="text-xs text-[#7FC248] font-bold uppercase tracking-wider mb-1">{item.kategori}</p>
                  <h4 className="font-bold text-gray-900 group-hover:text-[#7FC248] transition-colors line-clamp-2">{item.judul}</h4>
                </div>
              </Link>
            ))}
          </div>
        </section>
      )}
    </main>
  );
}
