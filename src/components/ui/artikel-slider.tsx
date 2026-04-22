"use client";

import React, { useEffect, useRef } from "react";
import Image from "next/image";

interface Artikel {
  id: number;
  category: string;
  title: string;
  date: string;
  excerpt: string;
}

const originalData: Artikel[] = [
  {
    id: 1,
    category: "ARTIKEL",
    title: "Daging Kurban Boleh Dicuci? Baca Dulu Dulu",
    date: "13 Jul 2024",
    excerpt: "Bolehkah daging kurban dicuci sebelum dimasak? Simak penjelasannya lebih lengkap di sini. Daging kurban merupakan salah satu momen istimewa yang paling ditunggu-tunggu setiap setahun sekali. Bagi umat muslim...",
  },
  {
    id: 2,
    category: "ARTIKEL",
    title: "Tips Mengelola Zakat Mal Agar Lebih Berkah",
    date: "15 Jul 2024",
    excerpt: "Zakat mal adalah salah satu kewajiban bagi umat muslim yang telah memenuhi nisab. Bagaimana cara mengelolanya agar memberikan dampak maksimal bagi umat? Simak tips lengkapnya di sini...",
  },
  {
    id: 3,
    category: "BERITA",
    title: "Taman Zakat Salurkan Bantuan Untuk Palestina",
    date: "18 Jul 2024",
    excerpt: "Sebagai bentuk kepedulian terhadap sesama, Taman Zakat terus konsisten menyalurkan bantuan kemanusiaan. Kali ini bantuan difokuskan untuk kebutuhan pangan dan medis di Palestina...",
  },
  {
    id: 4,
    category: "EDUKASI",
    title: "Pentingnya Pendidikan Al-Qur'an Sejak Dini",
    date: "20 Jul 2024",
    excerpt: "Pendidikan Al-Qur'an merupakan pondasi dasar dalam membangun karakter generasi yang religius dan berakhlak mulia. Taman Zakat mendukung penuh program tahfidz di berbagai wilayah...",
  },
];

// Standard Infinite Buffer: [Set1 (Prefix), Set2 (Middle/Main), Set3 (Suffix)]
// This ensures we always have content to the left and right.
const displayData = [...originalData, ...originalData, ...originalData];
const originalLength = originalData.length;

export default function ArtikelSlider() {
  const scrollRef = useRef<HTMLDivElement>(null);
  const isAutoScrolling = useRef(true);
  const isJumping = useRef(false);

  // Precision Positioning & Resize Handling
  useEffect(() => {
    const handleInitialPosition = () => {
      if (scrollRef.current) {
        const container = scrollRef.current;
        const cards = container.querySelectorAll('.artikel-card-container');
        const targetCard = cards[originalLength] as HTMLElement; // Start at the middle set
        if (targetCard) {
          container.scrollLeft = targetCard.offsetLeft - container.offsetLeft;
        }
      }
    };

    const timer = setTimeout(handleInitialPosition, 100);
    window.addEventListener('resize', handleInitialPosition);
    return () => {
      clearTimeout(timer);
      window.removeEventListener('resize', handleInitialPosition);
    };
  }, []);

  // Auto-slide logic (Constant Right Direction)
  useEffect(() => {
    const slideInterval = setInterval(() => {
      if (isAutoScrolling.current && scrollRef.current && !isJumping.current) {
        const container = scrollRef.current;
        const cards = container.querySelectorAll('.artikel-card-container');
        const cardWidth = (cards[0] as HTMLElement)?.offsetWidth || 0;
        const gap = 24; // Tailwind gap-6 = 24px
        container.scrollBy({ left: cardWidth + gap, behavior: "smooth" });
      }
    }, 10000);

    return () => clearInterval(slideInterval);
  }, []);

  const handleScroll = (e: React.UIEvent<HTMLDivElement>) => {
    if (isJumping.current) return;

    const container = e.currentTarget;
    const cards = container.querySelectorAll('.artikel-card-container');
    if (cards.length < originalLength * 3) return;

    // Get precise pixel positions for the sets
    const firstCardMiddle = cards[originalLength] as HTMLElement;
    const firstCardSuffix = cards[originalLength * 2] as HTMLElement;
    
    if (!firstCardMiddle || !firstCardSuffix) return;

    const cycleDistance = firstCardSuffix.offsetLeft - firstCardMiddle.offsetLeft;
    const middleStart = firstCardMiddle.offsetLeft - container.offsetLeft;
    const middleEnd = firstCardSuffix.offsetLeft - container.offsetLeft;

    const scrollLeft = container.scrollLeft;

    // Teleportation Logic
    // If we drift too far left or right from the middle set, 
    // teleport instantly (behavior: 'auto') to the equivalent spot in the main set.
    if (scrollLeft >= middleEnd) {
      isJumping.current = true;
      container.style.scrollBehavior = 'auto';
      container.scrollLeft = scrollLeft - cycleDistance;
      container.style.scrollBehavior = 'smooth';
      setTimeout(() => (isJumping.current = false), 50);
    } else if (scrollLeft <= middleStart - 10) {
      isJumping.current = true;
      container.style.scrollBehavior = 'auto';
      container.scrollLeft = scrollLeft + cycleDistance;
      container.style.scrollBehavior = 'smooth';
      setTimeout(() => (isJumping.current = false), 50);
    }
  };

  return (
    <div className="w-full relative overflow-hidden group">
      {/* Scrollable Area - Seamless Full Bleed */}
      <div 
        ref={scrollRef}
        onScroll={handleScroll}
        onMouseEnter={() => (isAutoScrolling.current = false)}
        onMouseLeave={() => (isAutoScrolling.current = true)}
        onTouchStart={() => (isAutoScrolling.current = false)}
        onTouchEnd={() => (isAutoScrolling.current = true)}
        className="flex overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar gap-6 py-10 px-4 md:px-[max(1rem,calc((100vw-1152px)/2+1rem))]"
        style={{
          msOverflowStyle: 'none',
          scrollbarWidth: 'none',
        }}
      >
        <style jsx>{`
          .no-scrollbar::-webkit-scrollbar {
            display: none;
          }
        `}</style>
        
        {displayData.map((artikel, index) => (
          <div 
            key={`${artikel.id}-${index}`} 
            className="artikel-card-container w-[85vw] md:w-[480px] lg:w-[540px] flex-shrink-0 snap-start"
          >
            <div className="bg-white p-5 sm:p-7 rounded-[2rem] shadow-xl hover:shadow-2xl flex gap-6 h-[300px] sm:h-[340px] border border-gray-100 hover:-translate-y-1.5 transition-all duration-700 transform relative overflow-hidden group/card">
              {/* Premium Background Accent */}
              <div className="absolute -bottom-10 -right-10 w-40 h-40 bg-[#7FC248]/5 rounded-full blur-3xl group-hover/card:bg-[#7FC248]/15 transition-colors"></div>
              
              {/* Image & Brand Column */}
              <div className="w-1/2 h-full bg-[#f9fafb] rounded-[1.5rem] flex items-center justify-center relative overflow-hidden flex-shrink-0 border border-gray-50">
                <div className="absolute inset-0 bg-gradient-to-br from-white to-gray-100/30"></div>
                <div className="relative z-10 flex flex-col items-center gap-4 opacity-20 grayscale group-hover/card:grayscale-0 group-hover/card:opacity-40 transition-all duration-1000 scale-90 group-hover/card:scale-105">
                  <Image src="/images/icon/hitam logo taza 1.svg" alt="Taza" width={64} height={64} className="w-14 h-14 md:w-16 md:h-16" />
                  <span className="text-[10px] font-black uppercase tracking-[0.5em] text-center">Taman Zakat</span>
                </div>
              </div>
              
              {/* Content Column */}
              <div className="w-1/2 flex flex-col pt-4 z-10">
                <div className="flex items-center gap-3 mb-5">
                  <div className="h-1.5 w-4 bg-[#7FC248] rounded-full shadow-sm shadow-[#7FC248]/20"></div>
                  <span className="text-[11px] text-[#7FC248] font-black tracking-widest uppercase">
                    {artikel.category}
                  </span>
                </div>
                <h3 className="text-base md:text-xl font-extrabold leading-tight mb-4 text-[#7FC248] line-clamp-2 hover:opacity-80 transition-opacity cursor-pointer">
                  {artikel.title}
                </h3>
                <div className="flex items-center gap-2 mb-5 border-b border-gray-100 pb-3">
                  <p className="text-[11px] text-gray-400 font-bold tracking-wider">
                    {artikel.date}
                  </p>
                </div>
                <div className="relative">
                  <span className="absolute -left-4 -top-2 text-3xl text-[#7FC248]/10 font-serif">&ldquo;</span>
                  <p className="text-[11px] sm:text-xs text-gray-500 leading-relaxed line-clamp-4 font-semibold italic">
                    {artikel.excerpt}
                  </p>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
