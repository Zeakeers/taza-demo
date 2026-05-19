"use client";

import React, { useEffect, useRef, useState } from "react";
import Image from "next/image";
import Link from "next/link";

interface ArtikelAPI {
  id: number;
  judul: string;
  slug: string;
  kategori: string;
  thumbnail: string;
  konten: string;
  created_at: string;
}

export default function ArtikelSlider() {
  const scrollRef = useRef<HTMLDivElement>(null);
  const isAutoScrolling = useRef(true);
  const isJumping = useRef(false);
  const [data, setData] = useState<ArtikelAPI[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function fetchArtikel() {
      try {
        const res = await fetch("http://127.0.0.1:8000/api/artikel/home");
        const json = await res.json();
        setData(json);
      } catch (error) {
        console.error("Failed to fetch artikel", error);
      } finally {
        setLoading(false);
      }
    }
    fetchArtikel();
  }, []);

  // Calculate sets for seamless infinite scroll
  // We want each "set" to be wide enough to cover the screen so teleportation is invisible.
  // Assuming a screen is max 2000px and a card is ~500px, 5 cards is ~2500px.
  const originalLength = data.length;
  const setSizeMultiplier = originalLength > 0 ? Math.ceil(5 / originalLength) : 1;
  const setSize = originalLength * setSizeMultiplier;
  
  // We need 3 sets: Prefix, Middle, Suffix to allow infinite scrolling in both directions
  const displayData = originalLength > 0 ? Array(setSizeMultiplier * 3).fill(data).flat() : [];

  // Precision Positioning & Resize Handling
  useEffect(() => {
    if (originalLength === 0) return;
    const handleInitialPosition = () => {
      if (scrollRef.current) {
        const container = scrollRef.current;
        const cards = container.querySelectorAll('.artikel-card-container');
        // Start at the first card of the Middle set
        const targetCard = cards[setSize] as HTMLElement; 
        if (targetCard) {
          const scrollPaddingLeft = parseFloat(window.getComputedStyle(container).scrollPaddingLeft) || 0;
          container.style.scrollBehavior = 'auto';
          container.scrollLeft = targetCard.offsetLeft - container.offsetLeft - scrollPaddingLeft;
          container.style.scrollBehavior = 'smooth';
        }
      }
    };

    const timer = setTimeout(handleInitialPosition, 100);
    // Remove window resize listener to prevent accidental resets which look like refreshing
    return () => {
      clearTimeout(timer);
    };
  }, [originalLength, setSize]);

  // Auto-slide logic (Step by step with exact snap points)
  useEffect(() => {
    if (originalLength === 0) return;
    const slideInterval = setInterval(() => {
      if (isAutoScrolling.current && scrollRef.current && !isJumping.current) {
        const container = scrollRef.current;
        const cards = container.querySelectorAll('.artikel-card-container');
        if (cards.length > 0) {
          const currentScroll = container.scrollLeft;
          const scrollPaddingLeft = parseFloat(window.getComputedStyle(container).scrollPaddingLeft) || 0;
          
          let nextCard = null;
          for (let i = 0; i < cards.length; i++) {
            const snapPoint = (cards[i] as HTMLElement).offsetLeft - container.offsetLeft - scrollPaddingLeft;
            // Find the first card that is significantly to the right of our current scroll position
            if (snapPoint > currentScroll + 10) {
              nextCard = cards[i] as HTMLElement;
              break;
            }
          }
          
          if (nextCard) {
            const targetScroll = nextCard.offsetLeft - container.offsetLeft - scrollPaddingLeft;
            container.scrollTo({ left: targetScroll, behavior: "smooth" });
          }
        }
      }
    }, 4000); // Pause for 4 seconds before next slide

    return () => clearInterval(slideInterval);
  }, [originalLength]);

  const handleScroll = (e: React.UIEvent<HTMLDivElement>) => {
    if (isJumping.current || originalLength === 0) return;

    const container = e.currentTarget;
    const cards = container.querySelectorAll('.artikel-card-container');
    if (cards.length < setSize * 3) return;

    const firstCardMiddle = cards[setSize] as HTMLElement;
    const firstCardSuffix = cards[setSize * 2] as HTMLElement;
    
    if (!firstCardMiddle || !firstCardSuffix) return;

    const scrollPaddingLeft = parseFloat(window.getComputedStyle(container).scrollPaddingLeft) || 0;

    const cycleDistance = firstCardSuffix.offsetLeft - firstCardMiddle.offsetLeft;
    const middleStart = firstCardMiddle.offsetLeft - container.offsetLeft - scrollPaddingLeft;
    const middleEnd = firstCardSuffix.offsetLeft - container.offsetLeft - scrollPaddingLeft;

    const scrollLeft = container.scrollLeft;

    // Teleportation Logic to keep it infinitely looping
    if (scrollLeft >= middleEnd) {
      isJumping.current = true;
      container.style.scrollBehavior = 'auto';
      container.scrollLeft = scrollLeft - cycleDistance;
      void container.offsetWidth; // Force reflow
      container.style.scrollBehavior = 'smooth';
      setTimeout(() => (isJumping.current = false), 50);
    } else if (scrollLeft <= middleStart - 100) {
      isJumping.current = true;
      container.style.scrollBehavior = 'auto';
      container.scrollLeft = scrollLeft + cycleDistance;
      void container.offsetWidth; // Force reflow
      container.style.scrollBehavior = 'smooth';
      setTimeout(() => (isJumping.current = false), 50);
    }
  };

  if (loading) {
    return (
      <div className="w-full flex justify-center py-20">
        <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-[#7FC248]"></div>
      </div>
    );
  }

  if (data.length === 0) {
    return null;
  }

  return (
    <div className="w-full relative overflow-hidden group py-10">
      {/* Scrollable Area - Seamless Full Bleed */}
      <div 
        ref={scrollRef}
        onScroll={handleScroll}
        onMouseEnter={() => (isAutoScrolling.current = false)}
        onMouseLeave={() => (isAutoScrolling.current = true)}
        onTouchStart={() => (isAutoScrolling.current = false)}
        onTouchEnd={() => (isAutoScrolling.current = true)}
        onTouchCancel={() => (isAutoScrolling.current = true)}
        className="flex overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar gap-6 py-10 px-8 md:px-[max(1rem,calc((100vw-1152px)/2+1rem))] scroll-pl-8 md:scroll-pl-[max(1rem,calc((100vw-1152px)/2+1rem))]"
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
        
        {displayData.map((artikel, index) => {
          const formattedDate = new Date(artikel.created_at).toLocaleDateString("id-ID", {
            day: "numeric",
            month: "short",
            year: "numeric",
          });

          return (
            <div 
              key={`${artikel.id}-${index}`} 
              className="artikel-card-container w-[85vw] md:w-[480px] lg:w-[540px] flex-shrink-0 snap-start"
            >
              <Link href={`/artikel/${artikel.slug}`} className="group/card block bg-white p-4 sm:p-7 rounded-[2rem] shadow-xl hover:shadow-2xl h-auto sm:h-[340px] border border-gray-100 hover:-translate-y-1.5 transition-all duration-700 relative overflow-hidden w-full">
                {/* Premium Background Accent */}
                <div className="absolute -bottom-10 -right-10 w-40 h-40 bg-[#7FC248]/5 rounded-full blur-3xl group-hover/card:bg-[#7FC248]/15 transition-colors"></div>
                
                <div className="flex flex-col sm:flex-row h-full w-full gap-4 sm:gap-6">
                  {/* Image Column */}
                  <div className="w-full sm:w-1/2 h-44 sm:h-full rounded-[1.5rem] relative overflow-hidden flex-shrink-0 border border-gray-50 bg-gray-100">
                    <img 
                      src={`http://127.0.0.1:8000/storage/${artikel.thumbnail}`} 
                      alt={artikel.judul} 
                      className="w-full h-full object-cover group-hover/card:scale-105 transition-transform duration-700"
                    />
                  </div>
                  
                  {/* Content Column */}
                  <div className="w-full sm:w-1/2 flex flex-col pt-1 sm:pt-4 z-10 flex-1">
                    <div className="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-5">
                      <div className="h-1.5 w-4 bg-[#7FC248] rounded-full shadow-sm shadow-[#7FC248]/20"></div>
                      <span className="text-[10px] sm:text-[11px] text-[#7FC248] font-black tracking-widest uppercase truncate max-w-full">
                        {artikel.kategori}
                      </span>
                    </div>
                    <h3 className="text-[15px] sm:text-xl font-extrabold leading-tight mb-2 sm:mb-4 text-[#7FC248] line-clamp-2 hover:opacity-80 transition-opacity cursor-pointer">
                      {artikel.judul}
                    </h3>
                    <div className="flex items-center gap-2 mb-3 sm:mb-5 border-b border-gray-100 pb-2 sm:pb-3">
                      <p className="text-[10px] sm:text-[11px] text-gray-400 font-bold tracking-wider">
                        {formattedDate}
                      </p>
                    </div>
                    <div className="relative flex-1">
                      <span className="absolute -left-3 sm:-left-4 -top-1 sm:-top-2 text-2xl sm:text-3xl text-[#7FC248]/10 font-serif">&ldquo;</span>
                      <p className="text-[11px] sm:text-xs text-gray-500 leading-relaxed line-clamp-3 sm:line-clamp-4 font-semibold italic" dangerouslySetInnerHTML={{ __html: artikel.konten.replace(/<[^>]*>?/gm, '').substring(0, 100) + "..." }}>
                      </p>
                    </div>
                  </div>
                </div>
              </Link>
            </div>
          );
        })}
      </div>
    </div>
  );
}
