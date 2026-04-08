"use client";

import Image from "next/image";
import Link from "next/link";
import { useState, useEffect } from "react";

export default function WakafPage() {
  const [cycle, setCycle] = useState(0);

  useEffect(() => {
    const timer = setInterval(() => {
      setCycle((prev) => prev + 1);
    }, 10000);
    return () => clearInterval(timer);
  }, []);

  const collageImages = [
    '/images/gambardetaile/pak pantau 1.svg',
    '/images/gambardetaile/maspion 1.svg',
    '/images/gambardetaile/bangunan 1.svg'
  ];

  return (
    <div className="w-full flex flex-col bg-white overflow-x-hidden">
      <style dangerouslySetInnerHTML={{ __html: `
        @keyframes borderWiggle {
          0%   { transform: translateX(-4px) rotate(-2deg); }
          50%  { transform: translateX(-4px) rotate(2deg); }
          100% { transform: translateX(-4px) rotate(-2deg); }
        }
        .border-wiggle {
          animation: borderWiggle 2.5s ease-in-out infinite;
          transform-origin: center center;
        }
        @keyframes floating {
          0% { transform: translateY(0px); }
          50% { transform: translateY(-15px); }
          100% { transform: translateY(0px); }
        }
        .animate-floating-0 { animation: floating 8s ease-in-out infinite; }
        .animate-floating-1 { animation: floating 8s ease-in-out infinite 2.5s; }
        .animate-floating-2 { animation: floating 8s ease-in-out infinite 5s; }
      `}} />
      {/* 1. Hero Section */}
      <section className="w-full flex flex-col md:flex-row min-h-[450px] md:min-h-[500px]">
        {/* Left Half: Image */}
        <div className="w-full md:w-1/2 relative min-h-[300px] md:min-h-full">
          <div 
            className="absolute inset-0 bg-zinc-300 bg-cover bg-center" 
            style={{ backgroundImage: `url('/images/gambardetaile/maspion 1.svg')` }} 
          />
        </div>
        
        {/* Right Half: Content */}
        <div className="w-full md:w-1/2 bg-[#222520] flex items-center justify-center p-8 sm:p-12 md:p-16 lg:p-24">
          <div className="max-w-[480px] text-center flex flex-col items-center">
            <h1 className="text-3xl md:text-4xl lg:text-[40px] font-bold text-white font-[var(--font-newsreader)] tracking-wide mb-6">
              Wakaf Umum
            </h1>
            <p className="text-[14px] md:text-[15px] text-zinc-300 leading-relaxed mb-6 lg:mb-10">
              Bergabunglah sebagai Donatur Rutin Bulanan Taman Zakat, dan jadilah bagian dari keluarga besar yang menghadirkan manfaat berkelanjutan melalui Wakaf Al-Qur'an, Ambulance Gratis, Wakaf Omah Qur'an, dan berbagai program kebaikan lainnya.
            </p>
            
            <div className="relative inline-block">
              <div
                aria-hidden
                className="absolute inset-0 z-20 rounded-sm border-2 border-white border-wiggle"
              />
              <a
                href="#"
                className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
              >
                <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5">
                  <div className="relative z-10 inline-flex items-center gap-2 text-sm font-semibold font-[var(--font-newsreader)] text-white md:text-base">
                    <span>Donasi Disini</span>
                    <Image
                      src="/images/icon/Donation.svg"
                      alt="Ikon donasi"
                      width={18}
                      height={18}
                      className="h-[18px] w-[18px]"
                    />
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* 2. Siapa Saja Penerima Manfaat Section */}
      <section className="w-full bg-[#FAF7F2] py-20 px-4 md:px-8">
        <div className="max-w-[1000px] mx-auto flex flex-col items-center">
          <h2 className="text-3xl md:text-4xl text-[#222520] font-bold font-[var(--font-newsreader)] text-center mb-4">
            Siapa Saja Penerima Manfaat
          </h2>
          <p className="text-[#222520] text-center text-[15px] md:text-[17px] max-w-2xl mb-14 font-medium">
            Kepedulian Anda menghadirkan manfaat nyata bagi mereka yang membutuhkan dan layak mendapatkan dukungan.
          </p>

          <div className="w-full flex flex-col items-center gap-6 md:gap-10">
            {/* Top Row: 3 cards */}
            <div className="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-10">
              {[
                { title: "Kaum Muslimin", img: "/images/gambardetaile/taja 1.svg" },
                { title: "Keluarga Prasejahtera", img: "/images/gambardetaile/prase 1.svg" },
                { title: "Santri", img: "/images/gambardetaile/santri 1.svg" }
              ].map((item, i) => (
                <div key={i} className="relative w-full aspect-[4/3] bg-zinc-300 overflow-hidden group shadow-md hover:shadow-xl transition-shadow cursor-pointer">
                  <div className="absolute inset-0 bg-cover bg-center z-0 transition-transform duration-500 group-hover:scale-105" style={{ backgroundImage: `url('${item.img}')` }} />
                  <div className="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors z-10" />
                  <div className="absolute inset-0 flex items-center justify-center z-20 p-4">
                    <h3 className="text-white text-[19px] md:text-xl font-bold tracking-wide text-center drop-shadow-md">
                      {item.title}
                    </h3>
                  </div>
                </div>
              ))}
            </div>
            
            {/* Bottom Row: 1 card centered */}
            <div className="w-full sm:w-[48%] md:w-[31.33%] relative aspect-[4/3] bg-zinc-300 overflow-hidden group shadow-md hover:shadow-xl transition-shadow cursor-pointer">
              <div className="absolute inset-0 bg-cover bg-center z-0 transition-transform duration-500 group-hover:scale-105" style={{ backgroundImage: `url('/images/gambardetaile/rsz_dhuafa-taman-zakat-1 2.svg')` }} />
              <div className="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors z-10" />
              <div className="absolute inset-0 flex items-center justify-center z-20 p-4">
                <h3 className="text-white text-[19px] md:text-xl font-bold tracking-wide text-center drop-shadow-md">
                  Dhuafa
                </h3>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 3. Dari Amanah Menjadi Manfaat Section */}
      <section className="w-full bg-[#F8EEDB] py-20 px-4 md:px-8">
        <div className="max-w-[1100px] mx-auto flex flex-col lg:flex-row items-center justify-between gap-16 lg:gap-8">
          
          {/* Left Text Content */}
          <div className="w-full lg:w-[45%] flex flex-col items-center lg:items-start text-center lg:text-left text-[#222520] z-20">
            <h2 className="text-3xl md:text-[38px] leading-[1.2] font-bold font-[var(--font-newsreader)] mb-4 lg:pr-10">
              Dari Amanah Menjadi Manfaat
            </h2>
            <p className="text-[16px] md:text-[18px] mb-8 leading-relaxed max-w-sm font-medium">
              Amanah Anda kami jaga, dan kami pastikan sampai menjadi manfaat nyata.
            </p>
            
            <div className="relative inline-block mt-2">
              <div
                aria-hidden
                className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
              />
              <a
                href="#"
                className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
              >
                <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5">
                  <div className="relative z-10 inline-flex items-center gap-2 text-sm font-semibold font-[var(--font-newsreader)] text-white md:text-base">
                    <span>Donasi Disini</span>
                    <Image
                      src="/images/icon/Donation.svg"
                      alt="Ikon donasi"
                      width={18}
                      height={18}
                      className="h-[18px] w-[18px]"
                    />
                  </div>
                </div>
              </a>
            </div>
          </div>

          {/* Right Collage Content */}
          <div className="w-full lg:w-[50%] relative h-[550px] sm:h-[650px] lg:h-[750px] mt-10 lg:mt-0 pb-10">
            {collageImages.map((img, i) => {
              const pos = (i + cycle) % 3;
              
              let posClasses = "";
              if (pos === 0) {
                // Top (Posisi atas, di kiri, sedikit lebih besar dari sebelumnya)
                posClasses = "top-0 left-0 w-[65%] sm:w-[70%] lg:w-[65%]";
              } else if (pos === 1) {
                // Middle (Posisi tengah, merapat maksimal ke kanan)
                posClasses = "top-[33%] left-[35%] sm:left-[30%] lg:left-[35%] w-[65%] sm:w-[70%] lg:w-[65%]";
              } else {
                // Bottom (Posisi bawah, terbesar, di sentral ke kanan)
                posClasses = "top-[66%] left-[15%] sm:left-[15%] lg:left-[20%] w-[80%] sm:w-[85%] lg:w-[80%]";
              }

              return (
                <div 
                  key={i}
                  // Menggunakan custom transition agar z-index atau properti lain tak sengaja teranimasi setengah-setengah
                  className={`absolute transition-[top,left,width] duration-[2500ms] ease-in-out transform-gpu ${posClasses} z-20`}
                  style={{ willChange: 'top, left, width' }}
                >
                  <div 
                    className={`w-full aspect-video bg-zinc-300 bg-cover bg-center rounded-sm shadow-xl animate-floating-${i}`}
                    style={{ backgroundImage: `url('${img}')`, WebkitBackfaceVisibility: 'hidden', WebkitTransform: 'translate3d(0,0,0)' }}
                  />
                </div>
              );
            })}
          </div>

        </div>
      </section>
    </div>
  );
}
