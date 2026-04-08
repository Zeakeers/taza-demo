"use client";

import { useState, useEffect } from "react";
import Image from "next/image";

const images = [
  "/images/gambardetaile/hero home 1.svg",
  "/images/gambardetaile/hero home 2.svg",
  "/images/gambardetaile/hero home 3.svg",
  "/images/gambardetaile/hero home 4.svg",
  "/images/gambardetaile/hero home 5.svg",
];

export default function HeroSliderHome() {
  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentIndex((prevIndex) => (prevIndex + 1) % images.length);
    }, 8000);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="relative w-full aspect-[2/1] md:aspect-[21/9] lg:aspect-[3/1] xl:aspect-[10/3] bg-gradient-to-r from-white to-[#F4Fdf0] overflow-hidden flex items-center justify-center">
      {images.map((img, index) => (
        <div
          key={index}
          className={`absolute top-0 left-0 w-full h-full transition-opacity duration-1000 ease-in-out ${
            index === currentIndex ? "opacity-100 z-10" : "opacity-0 z-0"
          }`}
        >
          <Image
            src={img}
            alt={`Hero Home ${index + 1}`}
            fill
            className="object-contain md:object-cover"
            priority={index === 0}
          />
        </div>
      ))}
      
      {/* Slider Indicators */}
      <div className="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2 z-20">
        {images.map((_, index) => (
          <button
            key={index}
            onClick={() => setCurrentIndex(index)}
            className={`h-2 w-8 rounded-full transition-all duration-300 ${
              index === currentIndex ? "bg-[#7FC248]" : "bg-white/50 hover:bg-white/80"
            }`}
            aria-label={`Go to slide ${index + 1}`}
          />
        ))}
      </div>
    </div>
  );
}
