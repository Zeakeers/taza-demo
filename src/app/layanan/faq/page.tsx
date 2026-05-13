"use client";
import { HelpCircle, Search, ChevronDown } from "lucide-react";
import React, { useEffect, useRef, useState } from "react";

interface FAQData {
  header?: {
    title?: string;
    search_placeholder?: string;
  };
  items?: { question: string; answer: string }[];
  topics?: string[];
}

const defaultFaqList = Array(8).fill({
  question:
    "Saya sudah transfer, tapi status donasi masih 'Belum Dibayar', apa yang harus saya lakukan?",
  answer:
    "Harap tunggu 5-10 menit, pastikan nominal sesuai kode unik, lalu unggah bukti transfer di menu konfirmasi atau hubungi admin WhatsApp",
});

const FAQItem = ({ item }: { item: { question: string; answer: string } }) => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <div className="flex items-start gap-3 font-poppins">
      <HelpCircle
        className="mt-0.5 h-[22px] w-[22px] shrink-0 text-[#a5d65a]"
        strokeWidth={2}
      />
      <div className="flex-1">
        <button
          onClick={() => setIsOpen(!isOpen)}
          className="flex w-fit items-center gap-3 group text-left cursor-pointer focus:outline-none bg-[#8DC63F] text-white px-4 py-2.5 rounded-md transition-transform active:scale-[0.98]"
        >
          <h3 className="text-[15px] font-[600] md:text-base md:leading-snug">
            {item.question}
          </h3>
          <ChevronDown className={`w-5 h-5 text-white transition-transform duration-300 shrink-0 ${isOpen ? 'rotate-180' : ''}`} />
        </button>

        <div className={`grid transition-all duration-300 overflow-hidden ${isOpen ? 'grid-rows-[1fr] opacity-100 mt-3 mb-2' : 'grid-rows-[0fr] opacity-0 mt-0 mb-0'}`}>
          <div className="min-h-0">
            <p className="text-sm text-zinc-600 md:text-[15px] md:leading-relaxed text-left px-1">
              {item.answer}
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

const API_URL = process.env.NEXT_PUBLIC_API_URL || "http://127.0.0.1:8000/api";

export default function FAQPage() {
  const decorRef = useRef<HTMLDivElement>(null);
  const [isVisible, setIsVisible] = useState(false);
  const [faqData, setFaqData] = useState<FAQData | null>(null);
  const [searchQuery, setSearchQuery] = useState("");

  useEffect(() => {
    async function fetchData() {
      try {
        const res = await fetch(`${API_URL}/content/layanan`);
        if (res.ok) {
          const data = await res.json();
          if (data?.faq) {
            setFaqData(data.faq);
          }
        }
      } catch (e) {
        console.error("Failed to fetch FAQ data:", e);
      }
    }
    fetchData();
  }, []);

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true);
          observer.disconnect();
        }
      },
      { threshold: 0.1 }
    );

    if (decorRef.current) {
      observer.observe(decorRef.current);
    }

    return () => observer.disconnect();
  }, []);

  const headerTitle = faqData?.header?.title || "Haloo,ada yang bisa kami bantu?";
  const searchPlaceholder = faqData?.header?.search_placeholder || "Cari bantuan disini ...";
  const faqList = faqData?.items && faqData.items.length > 0 ? faqData.items : defaultFaqList;
  const topics = faqData?.topics && faqData.topics.length > 0 ? faqData.topics : Array(8).fill("Verification");

  // Filter FAQ items based on search
  const filteredFaq = searchQuery
    ? faqList.filter(
      (item) =>
        item.question.toLowerCase().includes(searchQuery.toLowerCase()) ||
        item.answer.toLowerCase().includes(searchQuery.toLowerCase())
    )
    : faqList;

  return (
    <>
      <style>{`
        @keyframes slideInX {
          0% {
            transform: translateX(50vw);
            opacity: 0;
          }
          100% {
            transform: translateX(0);
            opacity: 1;
          }
        }
        .off-screen {
          transform: translateX(50vw);
          opacity: 0;
        }
        .anim-slide-1 {
          animation: slideInX 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0s both;
        }
        .anim-slide-2 {
          animation: slideInX 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0.15s both;
        }
        .anim-slide-3 {
          animation: slideInX 1s cubic-bezier(0.2, 0.8, 0.2, 1) 0.3s both;
        }
      `}</style>
      <main className="w-full bg-white overflow-x-clip">
        {/* Container utama */}
        <div className="mx-auto w-full max-w-[1200px] px-6 py-16 md:px-10 lg:px-12">
          {/* Title & Search */}
          <div className="mb-14">
            <h1 className="mb-8 text-center text-2xl font-bold text-black md:text-[28px]">
              {headerTitle}
            </h1>

            <div className="relative mx-auto max-w-[550px]">
              <input
                type="text"
                placeholder={searchPlaceholder}
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full rounded-full border border-zinc-200 bg-[#FAFAFA] py-3.5 pl-8 pr-16 text-sm font-medium text-zinc-800 outline-none placeholder:text-zinc-400 focus:border-[#7FC248] md:text-base"
              />
              <button
                aria-label="Search"
                className="absolute right-2 top-1/2 flex h-[38px] w-[38px] -translate-y-1/2 items-center justify-center rounded-full bg-[#B2E26E] transition hover:bg-[#a1d15c]"
              >
                <Search className="h-[18px] w-[18px] text-white" strokeWidth={3} />
              </button>
            </div>
          </div>

          {/* Content Layout */}
          <div className="grid grid-cols-1 gap-12 lg:grid-cols-[1.5fr_1fr] lg:gap-16">
            {/* Left Column - FAQ List */}
            <div>
              <h2 className="mb-6 text-lg font-bold text-black md:text-xl">Pencarian terbanyak</h2>
              <div className="flex flex-col gap-6">
                {filteredFaq.length > 0 ? (
                  filteredFaq.map((item, index) => (
                    <FAQItem key={index} item={item} />
                  ))
                ) : (
                  <p className="text-zinc-400 text-sm italic py-4">Tidak ditemukan pertanyaan yang cocok.</p>
                )}
              </div>
            </div>

            {/* Right Column - Popular Topics */}
            <div className="relative w-full lg:translate-x-16 xl:translate-x-28">
              <div ref={decorRef} className="sticky top-[120px] h-fit w-full bg-[#F4F9F2] p-8 md:p-10 pb-10">
                <h3 className="relative z-10 mb-5 text-[17px] font-bold text-zinc-800">
                  Populer Topic
                </h3>
                <ul className="relative z-10 flex flex-col gap-2.5">
                  {topics.map((topic, idx) => (
                    <li key={idx}>
                      <a
                        href="#"
                        className="text-[15px] font-medium text-[#7fb539] transition hover:text-[#5DA630] hover:underline"
                      >
                        {topic}
                      </a>
                    </li>
                  ))}
                </ul>

                <div className="relative z-10 mt-14 border-t border-zinc-200/80 pt-6">
                  <h4 className="font-semibold text-[#8DC63F]">Contact Support</h4>
                  <p className="mt-1 text-[13px] text-zinc-400">24 * 7 help from our support staff</p>
                </div>

                {/* Decorative shapes overflowing to the right screen edge */}
                <div
                  className="absolute left-[55%] md:left-[60%] top-[15%] xl:top-[8%] flex flex-col gap-0 w-[800px] xl:w-[1000px] pointer-events-none z-0 rotate-[-12deg]"
                >
                  <div className={isVisible ? 'anim-slide-1' : 'off-screen'}>
                    <div className="h-[60px] w-full bg-[#89BD43] shadow-[0_4px_10px_rgba(0,0,0,0.05)] translate-x-[40px]"></div>
                  </div>
                  <div className={isVisible ? 'anim-slide-2' : 'off-screen'}>
                    <div className="h-[80px] w-full bg-[#BBE567] shadow-[0_4px_10px_rgba(0,0,0,0.05)]"></div>
                  </div>
                  <div className={isVisible ? 'anim-slide-3' : 'off-screen'}>
                    <div className="h-[85px] w-full border-[1.5px] border-zinc-300 bg-transparent translate-x-[20px]"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </>
  );
}
