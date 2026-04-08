"use client";

import Image from "next/image";
import { useEffect, useState, useRef } from "react";

const BADGE_TEXT = "Taman Zakat - Indonesia - taza -";

export default function BidangKemanusiaanPage() {
  const [animateBadge, setAnimateBadge] = useState(false);

  useEffect(() => {
    const timer = setTimeout(() => {
      setAnimateBadge(true);
    }, 100);
    return () => clearTimeout(timer);
  }, []);

  const sliderRef = useRef<HTMLDivElement>(null);
  const [isDown, setIsDown] = useState(false);
  const [startX, setStartX] = useState(0);
  const [scrollLeft, setScrollLeft] = useState(0);

  const handleMouseDown = (e: React.MouseEvent) => {
    if (!sliderRef.current) return;
    setIsDown(true);
    setStartX(e.pageX - sliderRef.current.offsetLeft);
    setScrollLeft(sliderRef.current.scrollLeft);
  };

  const handleMouseLeave = () => {
    setIsDown(false);
  };

  const handleMouseUp = () => {
    setIsDown(false);
  };

  const handleMouseMove = (e: React.MouseEvent) => {
    if (!isDown || !sliderRef.current) return;
    e.preventDefault();
    const x = e.pageX - sliderRef.current.offsetLeft;
    const walk = (x - startX) * 2; // Kecepatan scroll
    sliderRef.current.scrollLeft = scrollLeft - walk;
  };

  return (
    <main className="min-h-screen w-full bg-white overflow-x-hidden">
      
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

        @keyframes badgeBounce {
          0%   { transform: translateX(500px) translateY(-80px); opacity: 0; }
          5%   { opacity: 1; }
          12%  { transform: translateX(400px) translateY(-60px); }
          18%  { transform: translateX(340px) translateY(-20px); }
          24%  { transform: translateX(280px) translateY(0); }
          28%  { transform: translateX(250px) translateY(-20px); }
          32%  { transform: translateX(220px) translateY(-42px); }
          36%  { transform: translateX(190px) translateY(-48px); }
          40%  { transform: translateX(160px) translateY(-42px); }
          44%  { transform: translateX(135px) translateY(-20px); }
          48%  { transform: translateX(110px) translateY(0); }
          51%  { transform: translateX(95px) translateY(-10px); }
          54%  { transform: translateX(80px) translateY(-22px); }
          57%  { transform: translateX(65px) translateY(-24px); }
          60%  { transform: translateX(52px) translateY(-22px); }
          63%  { transform: translateX(40px) translateY(-10px); }
          66%  { transform: translateX(30px) translateY(0); }
          70%  { transform: translateX(22px) translateY(-8px); }
          74%  { transform: translateX(15px) translateY(-10px); }
          78%  { transform: translateX(10px) translateY(-8px); }
          82%  { transform: translateX(5px) translateY(0); }
          86%  { transform: translateX(3px) translateY(-3px); }
          90%  { transform: translateX(2px) translateY(-4px); }
          94%  { transform: translateX(1px) translateY(-3px); }
          97%  { transform: translateX(0) translateY(0); }
          100% { transform: translateX(0) translateY(0); opacity: 1; }
        }
        .badge-bounce {
          animation: badgeBounce 1.8s linear forwards;
          animation-delay: 1.5s;
          opacity: 0;
        }
      `}} />

      {/* ===================== HERO SECTION ===================== */}
      <section className="relative w-full flex items-end md:items-center min-h-[500px] md:min-h-[600px] pt-48 pb-10 md:py-24">
         {/* BACKGROUND IMAGE FILL */}
         <div className="absolute inset-0 z-0 bg-[#eef5e9]">
            <Image 
               src="/images/gambardetaile/hero bidang kemanusian.svg" 
               alt="Background Bidang Kemanusiaan" 
               fill 
               className="object-cover object-[15%_center] md:object-center opacity-80"
               priority
            />
         </div>

         <div className="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 md:px-12 flex justify-center md:justify-end">
            {/* CARD RIGHT */}
            <div className="bg-white rounded-2xl md:rounded-md w-full sm:max-w-[420px] p-5 sm:p-6 md:p-8 lg:p-10 relative border border-green-50 shadow-[15px_-10px_30px_rgba(127,194,72,0.25)] md:shadow-[25px_-15px_40px_rgba(127,194,72,0.25)] mt-12 md:mt-0">
               {/* Badge Taza (Top Left corner) */}
               <div className={`absolute -top-6 -left-3 md:-top-12 md:-left-12 z-20 ${animateBadge ? 'badge-bounce' : 'opacity-0'}`}>
                 <div className="relative h-[70px] w-[70px] md:h-[100px] md:w-[100px]">
                   <div aria-hidden className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]" />
                   <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#8cc63f]">
                     <svg viewBox="0 0 300 300" aria-hidden className="absolute inset-0 h-full w-full fill-black transform -rotate-12">
                       <defs>
                         <path id="kemanusiaan-badge-path" d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224" />
                       </defs>
                       <text fontSize="28" fontWeight="500" className="font-newsreader">
                         <textPath href="#kemanusiaan-badge-path" startOffset="50%" textAnchor="middle" textLength="680" lengthAdjust="spacing">
                           {BADGE_TEXT}
                         </textPath>
                       </text>
                     </svg>
                     <div className="relative z-10 flex h-[30px] w-[30px] md:h-[45px] md:w-[45px] items-center justify-center rounded-full border-[2px] border-black bg-[#8cc63f]">
                       <Image src="/images/icon/hitam logo taza 1.svg" alt="Logo Taza" width={36} height={36} className="h-[18px] w-auto md:h-[28px]" />
                     </div>
                   </div>
                 </div>
               </div>
               
               <h1 className="text-[26px] md:text-[32px] font-newsreader font-bold text-black mb-5 mt-4 ml-6 md:ml-8 text-left drop-shadow-sm">
                 Bidang <span className="text-[#8cc63f]">Kemanusiaan</span>
               </h1>

               <ul className="space-y-3 md:space-y-4 mb-8 md:mb-10 ml-2 md:ml-8">
                 {[
                   "Peduli Palestina",
                   "Pembangunan Sumur Bor",
                   "Peduli Bencana Alam"
                 ].map((item, idx) => (
                   <li key={idx} className="flex items-center gap-3 md:gap-4">
                     <div className="w-[24px] h-[24px] md:w-[32px] md:h-[32px] rounded-full bg-[#1e5b3a] flex items-center justify-center flex-shrink-0 relative overflow-hidden shadow-sm">
                       <svg className="w-3.5 h-3.5 md:w-5 md:h-5 text-white stroke-white stroke-[4]" fill="none" viewBox="0 0 24 24" strokeLinecap="square" strokeLinejoin="miter">
                          <polyline points="5 12 10 17 22 2"></polyline>
                       </svg>
                     </div>
                     <span className="text-zinc-800 font-semibold text-[15px] md:text-[20px]">{item}</span>
                   </li>
                 ))}
               </ul>

               <div className="flex justify-center mt-6 mb-2 w-full">
                 <div className="relative inline-block">
                   <div aria-hidden className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle" />
                   <a href="#donasi" className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5">
                     <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5 md:px-6 md:py-3">
                       <div className="relative z-10 inline-flex items-center gap-2 text-[15px] font-semibold font-newsreader text-white md:text-[18px]">
                         <span>Donasi Sekarang</span>
                       </div>
                     </div>
                   </a>
                 </div>
               </div>
            </div>
         </div>
      </section>

      {/* ===================== HEADER TEXT ===================== */}
      <section className="w-full pt-16 pb-12 px-4 md:px-12 bg-white flex justify-center text-center">
         <div className="max-w-4xl w-full">
            <h2 className="text-2xl md:text-3xl font-newsreader font-bold text-black mb-6">Program Kemanusiaan</h2>
            <p className="text-zinc-800 text-sm md:text-lg leading-relaxed max-w-4xl font-medium mx-auto">
              Program Kemanusiaan Taman Zakat adalah inisiatif yang bertujuan untuk meringankan beban penderitaan sesama saat menghadapi krisis bencana, peperangan, dan darurat air. Melalui program ini, pendistribusian langsung menyentuh titik terpelik baik di Palestina, penyediaan air bersih di daerah krisis, dan tanggap darurat bencana lokal.
            </p>
         </div>
      </section>

      {/* ===================== BLACK BANNER PLACEHOLDER ===================== */}
      <section className="w-full bg-[#323232] pt-8 pb-6 border-y-8 border-[#3A3D40]">
        <div className="w-full text-center">
           <h3 className="text-white text-xl md:text-2xl font-newsreader mb-8">
             Program Kemanusiaan - Taman Zakat
           </h3>
            <div 
              ref={sliderRef}
              onMouseDown={handleMouseDown}
              onMouseLeave={handleMouseLeave}
              onMouseUp={handleMouseUp}
              onMouseMove={handleMouseMove}
              className={`flex gap-4 md:gap-6 overflow-x-auto justify-start lg:justify-center px-4 md:px-12 pb-4 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] ${isDown ? 'cursor-grabbing' : 'cursor-grab'}`}
            >
             {[
               { title: "Peduli Palestina", image: "/images/gambardetaile/santri 1.svg" },
               { title: "Pembangunan Sumur Bor", image: "/images/gambardetaile/footage ambul 2 1.svg" },
               { title: "Peduli Bencana Alam", image: "/images/gambardetaile/bidang kemanusian.svg" },
             ].map((program, i) => (
                <div key={i} className={`relative min-w-[220px] md:min-w-[280px] h-[180px] md:h-[220px] bg-[#d9d9d9] rounded-lg shrink-0 flex items-center justify-center shadow-lg transition-transform ${isDown ? '' : 'hover:scale-[1.02]'} overflow-hidden group select-none`}>
                   {/* Kontainer untuk Image */}
                   <Image 
                     src={program.image}
                     alt={program.title}
                     fill
                     className="object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"
                   />
                   {/* Teks Overlay */}
                   <div className="absolute inset-0 flex items-center p-4 justify-center bg-black/40 group-hover:bg-black/60 transition-colors duration-300">
                     <p className="text-white font-medium text-base md:text-xl drop-shadow-md z-10 text-center">{program.title}</p>
                   </div>
                </div>
             ))}
           </div>
           
           <hr className="border-t border-zinc-500 mt-6 mb-4 mx-4 md:mx-12" />
           <p className="text-zinc-300 text-sm md:text-base">
             Berikut Program - Program Kami
           </p>
        </div>
      </section>
      
      {/* ===================== PROGRAM ===================== */}
      <section className="relative w-full py-20 md:py-32 bg-[#faf7f0] overflow-hidden md:overflow-visible">
         {/* Background Strip Tengah */}
         <div className="absolute top-1/2 -translate-y-1/2 left-0 w-full h-[60%] md:h-[45%] bg-[#F8EED3] z-0 shadow-sm border-y border-[#F8EED3]/80"></div>

         <div className="relative z-10 max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-10 px-6 md:px-12">
           <div className="w-full md:w-1/2 md:pr-10 py-4 md:py-8 text-center md:text-left">
              <h2 className="text-2xl md:text-4xl font-newsreader font-bold text-black mb-4">Program Kemanusiaan</h2>
              <p className="text-zinc-800 text-sm md:text-lg leading-relaxed font-medium">
                Program Kemanusiaan Taman Zakat hadir sebagai bentuk dedikasi aksi solidaritas untuk saudara kita yang tertimpa musibah, baik krisis lokal maupun berskala internasional. Bantuan tersalurkan secara cepat, transparan, dan terarah untuk memutus penderitaan secepat mungkin.
              </p>
           </div>
           
           <div className="w-full md:w-1/2 relative h-[400px] md:h-[600px] flex justify-center md:justify-end">
             <div className="relative w-full h-full max-w-[660px] hover:scale-[1.03] transition-transform duration-500 select-none">
                <Image 
                  src="/images/gambardetaile/program kemanusiaan.svg" 
                  alt="Collage Kemanusiaan" 
                  fill 
                  className="object-contain object-center md:object-right drop-shadow-2xl scale-110 md:scale-125 pointer-events-none" 
                />
             </div>
           </div>
         </div>
      </section>

      {/* ===================== ALTERNATING PROGRAM LIST ===================== */}

      {/* 1. Peduli Palestina */}
      <section className="w-full py-16 px-4 md:px-12 bg-[#FAEDCD]">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 flex justify-center md:justify-end">
            <div className="relative w-[90%] md:w-full max-w-[400px] aspect-[4/3] mt-6 md:mt-0">
              <div className="absolute -top-3 -left-3 md:-top-4 md:-left-4 w-[65%] h-[98%] bg-[#FAEDCD] rounded-xl shadow-[-12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              {/* Icon Percantik 1 */}
              <div className="absolute -top-5 left-4 md:left-6 z-20 w-[24px] md:w-[28px] h-[55px] md:h-[65px]">
                 <Image src="/images/icon/penjepit kertas.svg" alt="Penjepit Kertas" fill className="object-contain" />
              </div>

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden border-[1.5px] border-[#D5D5D5]/40">
                <Image
                  src="/images/gambardetaile/santri 1.svg"
                  alt="Peduli Palestina"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
          <div className="w-full md:w-1/2 flex flex-col justify-center items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Peduli Palestina
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Tunjukkan kepedulian Anda terhadap saudara di Palestina dengan mengirimkan bantuan makanan, obat-obatan, dan pemulihan tempat perlindungan. Sedikit dari kita sangat berarti bagi perjuangan mereka.
              </p>
              <div className="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                <div className="relative inline-block">
                  <div
                    aria-hidden
                    className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
                  />
                  <a
                    href="#donasi"
                    className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
                  >
                    <div className="relative rounded-sm bg-[#7FC248] px-4 py-2 md:px-5 md:py-2.5">
                      <div className="relative z-10 inline-flex items-center gap-2 text-[15px] font-semibold font-newsreader text-white">
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
                <button className="bg-transparent border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
                  Lihat Detail Program
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 2. Pembangunan Sumur Bor */}
      <section className="w-full py-16 px-4 md:px-12 bg-white">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 order-2 md:order-1 flex flex-col items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Pembangunan Sumur Bor
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Berbagai pelosok daerah tengah mengalami kekeringan ekstrem. Bersama kami, alirkan sedekah jariyah Anda untuk pembangunan sumur bor yang menyediakan akses air bersih menyeluruh untuk keseharian warga.
              </p>
              <div className="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                <button className="bg-transparent border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
                  Lihat Detail Program
                </button>
                <div className="relative inline-block">
                  <div
                    aria-hidden
                    className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
                  />
                  <a
                    href="#donasi"
                    className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
                  >
                    <div className="relative rounded-sm bg-[#7FC248] px-4 py-2 md:px-5 md:py-2.5">
                      <div className="relative z-10 inline-flex items-center gap-2 text-[15px] font-semibold font-newsreader text-white">
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
          </div>
          <div className="w-full md:w-1/2 order-1 md:order-2 flex justify-center md:justify-start">
            <div className="relative w-[90%] md:w-full max-w-[400px] aspect-[4/3] mt-6 md:mt-0">
              <div className="absolute -top-3 -right-3 md:-top-4 md:-right-4 w-[65%] h-[98%] bg-[#FFFFFF] rounded-xl shadow-[12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              {/* Icon Percantik 2 (Pushpin) */}
              <div className="absolute -top-[25px] right-[25%] z-20 w-[45px] h-[50px] md:w-[50px] md:h-[55px] drop-shadow-md">
                 <Image src="/images/icon/pin paku.svg" alt="Pin Paku" fill className="object-contain" />
              </div>

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden border-[1.5px] border-[#D5D5D5]/40">
                <Image
                  src="/images/gambardetaile/footage ambul 2 1.svg"
                  alt="Pembangunan Sumur Bor"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 3. Peduli Bencana Alam */}
      <section className="w-full py-16 px-4 md:px-12 bg-[#FAEDCD]">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 flex justify-center md:justify-end">
            <div className="relative w-[90%] md:w-full max-w-[400px] aspect-[4/3] mt-6 md:mt-0">
              <div className="absolute -top-3 -left-3 md:-top-4 md:-left-4 w-[65%] h-[98%] bg-[#FAEDCD] rounded-xl shadow-[-12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              {/* Icon Percantik 3 */}
              <div className="absolute -top-[14px] md:-top-[18px] left-[20%] z-20 w-[14px] md:w-[16px] h-[35px] md:h-[45px]">
                 <Image src="/images/icon/penjepit majalah.svg" alt="Clip" fill className="object-contain" />
              </div>
              <div className="absolute -top-[14px] md:-top-[18px] right-[20%] z-20 w-[14px] md:w-[16px] h-[35px] md:h-[45px]">
                 <Image src="/images/icon/penjepit majalah.svg" alt="Clip" fill className="object-contain" />
              </div>

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden border-[1.5px] border-[#D5D5D5]/40">
                <Image
                  src="/images/gambardetaile/bidang kemanusian.svg"
                  alt="Peduli Bencana Alam"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
          <div className="w-full md:w-1/2 flex flex-col justify-center items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Peduli Bencana Alam
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                 Tanggapan sigap dalam menyalurkan bantuan kepada korban bencana alam di tanah air, mulai dari posko evakuasi, penyediaan obat-obatan hingga sandang pangan untuk memulihkan duka para penyintas.
              </p>
              <div className="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                <div className="relative inline-block">
                  <div
                    aria-hidden
                    className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
                  />
                  <a
                    href="#donasi"
                    className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
                  >
                    <div className="relative rounded-sm bg-[#7FC248] px-4 py-2 md:px-5 md:py-2.5">
                      <div className="relative z-10 inline-flex items-center gap-2 text-[15px] font-semibold font-newsreader text-white">
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
                <button className="bg-transparent border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
                  Lihat Detail Program
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ===================== DARI AMANAH MENJADI MANFAAT (COLLAGE VERTICAL 1-2-1) ===================== */}
      <section className="w-full relative bg-[#FEFDF9] py-16 md:py-24 overflow-visible mt-8 md:mt-16">
        
        {/* Dark Background Strip - Extends full width left to right, bounded fixed height */}
        <div className="absolute top-1/2 -translate-y-1/2 left-0 w-full h-[350px] md:h-[380px] bg-[#313131] z-0 shadow-lg" />

        <div className="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 md:gap-4 pl-4 md:pl-12 pr-0 relative z-10">
          
          {/* Text Block */}
          <div className="w-full md:w-[45%] lg:w-[40%] text-left py-12 md:py-0 px-2 md:px-0 z-20">
             <h2 className="text-white text-3xl md:text-3xl lg:text-4xl font-newsreader font-bold mb-4 leading-tight drop-shadow-sm">
               Dari Amanah Menjadi Manfaat
             </h2>
             <p className="text-zinc-200 text-[15px] md:text-lg mb-8 leading-relaxed max-w-sm font-medium">
               Amanah Anda kami jaga, dan kami pastikan sampai menjadi manfaat nyata.
             </p>
             <div className="relative inline-block">
               <div
                 aria-hidden
                 className="absolute inset-0 z-20 rounded-sm border-[1.5px] border-white/60 border-wiggle"
               />
               <a
                 href="#donasi"
                 className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
               >
                 <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5 md:px-6 md:py-3 shadow-md hover:bg-[#6CAE3D] transition-colors">
                   <div className="relative z-10 inline-flex items-center gap-2 text-[15px] md:text-[16px] font-semibold font-newsreader text-white">
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

          {/* Collage Block Using Flex To Prevent Full Overlap - 4 IMAGES TOTAL (1-2-1 format) */}
          <div className="w-full md:w-[55%] lg:w-[60%] flex flex-col gap-6 md:gap-2 mt-8 md:mt-0 items-end overflow-visible z-10 lg:pr-12 md:pr-4">
             
             {/* 1. Top Row: 1 Wide Image */}
             <div className="w-[85%] sm:w-[60%] md:w-[65%] lg:w-[58%] aspect-[16/10] rounded-sm border-[4px] md:border-[6px] border-white bg-white shadow-xl z-50 rotate-[-1deg] transition-transform hover:scale-[1.03] hover:z-[60] ml-auto">
               <div className="relative w-full h-full overflow-hidden">
                 <Image src="/images/gambardetaile/bidang pendidikan.svg" alt="Image 1" fill className="object-cover object-top" />
               </div>
             </div>

             {/* 2. Middle Row: 2 Square/Landscape Images */}
             <div className="flex flex-row justify-end items-center gap-2 md:gap-4 w-full md:w-[95%] lg:w-[85%] mt-[-10px] md:mt-[-25px]">
               {/* Left */}
               <div className="w-[48%] md:w-[50%] lg:w-[48%] aspect-[4/3] rounded-sm border-[4px] md:border-[6px] border-white bg-white shadow-lg z-20 rotate-[-3deg] transition-transform hover:scale-[1.03] hover:z-[60]">
                  <div className="relative w-full h-full overflow-hidden">
                    <Image src="/images/gambardetaile/santri 1.svg" alt="Image 2" fill className="object-cover" />
                  </div>
               </div>
               {/* Right */}
               <div className="w-[45%] md:w-[45%] lg:w-[42%] aspect-[4/3] rounded-sm border-[4px] md:border-[6px] border-white bg-white shadow-lg z-40 rotate-[2deg] transition-transform hover:scale-[1.03] hover:z-[60] mt-4 md:mt-8">
                  <div className="relative w-full h-full overflow-hidden">
                    <Image src="/images/gambardetaile/Yatim-Beasiswa-Sekolah-Yatimn 1.svg" alt="Image 3" fill className="object-cover" />
                  </div>
               </div>
             </div>

             {/* 3. Bottom Row: 1 Wide Image */}
             <div className="w-[85%] sm:w-[60%] md:w-[65%] lg:w-[58%] aspect-[16/10] rounded-sm border-[4px] md:border-[6px] border-white bg-white shadow-2xl z-50 rotate-[1deg] transition-transform hover:scale-[1.03] hover:z-[60] mr-auto md:mr-8 ml-auto mt-[-10px] md:mt-[-25px]">
               <div className="relative w-full h-full overflow-hidden">
                 <Image src="/images/gambardetaile/bidang kemanusian.svg" alt="Image 4" fill className="object-cover object-center" />
               </div>
             </div>

          </div>
        </div>
      </section>

    </main>
  );
}
