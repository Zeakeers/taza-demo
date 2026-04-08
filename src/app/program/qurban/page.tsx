"use client";

import Image from "next/image";
import Link from "next/link";
import { useEffect, useState } from "react";

const BADGE_TEXT = "Taman Zakat - Indonesia - taza -";

export default function QurbanPage() {
  const [animateHero, setAnimateHero] = useState(false);
  const [anim, setAnim] = useState({
    cardX: -150,
    cardDura: 0,
    goatX: -150,
    goatDura: 0,
    goatImg: '/images/kambing/jalan1.png',
    goatFlip: -1,
    goatVisible: false,
  });

  useEffect(() => {
    let isMounted = true;
    const update = (patch: any) => {
      if (isMounted) setAnim((prev) => ({ ...prev, ...patch }));
    };
    const delay = (ms: number) => new Promise(res => setTimeout(res, ms));

    const runAnimation = async () => {
      // 1. Initialize offscreen left
      update({ cardX: -120, goatX: -140, goatVisible: true });
      await delay(500);

      const walkTimers = new Set<NodeJS.Timeout>();
      const startWalk = (speed = 120) => {
        const timer = setInterval(() => {
          if (!isMounted) return;
          setAnim(p => ({
            ...p,
            goatImg: p.goatImg.includes('jalan1') ? '/images/kambing/jalan 2.png' : '/images/kambing/jalan1.png'
          }));
        }, speed);
        walkTimers.add(timer);
      };
      const stopWalk = () => {
        walkTimers.forEach(clearInterval);
        walkTimers.clear();
      };

      // 2. Goat runs into screen pushing the card
      startWalk(120);
      update({ cardX: -70, goatX: -70, cardDura: 1.5, goatDura: 1.5 });
      await delay(1500);
      stopWalk();

      // 3. Push 1
      update({ goatImg: '/images/kambing/sundul 1.png' });
      await delay(150);
      update({ goatImg: '/images/kambing/sundul 2.png' });
      update({ cardX: -40, cardDura: 0.4 }); // Card jumps away
      await delay(300);

      // Chase 1
      startWalk(80);
      update({ goatX: -40, goatDura: 0.5 }); // Goat runs to catch it
      await delay(500);
      stopWalk();

      // 4. Push 2
      update({ goatImg: '/images/kambing/sundul 1.png' });
      await delay(150);
      update({ goatImg: '/images/kambing/sundul 2.png' });
      update({ cardX: -15, cardDura: 0.35 });
      await delay(250);

      // Chase 2
      startWalk(80);
      update({ goatX: -15, goatDura: 0.45 });
      await delay(450);
      stopWalk();

      // 5. Push 3 (Final)
      update({ goatImg: '/images/kambing/sundul 1.png' });
      await delay(150);
      update({ goatImg: '/images/kambing/sundul 2.png' });
      update({ cardX: 0, cardDura: 0.3 }); // Card lands at target!
      
      // Trigger badge bounce roughly on impact
      setTimeout(() => { if (isMounted) setAnimateHero(true); }, 100);

      await delay(400);

      // Goat stops
      update({ goatImg: '/images/kambing/jalan1.png' });
      await delay(800);

      // 6. Goat looks back
      update({ goatFlip: 1 });
      await delay(400);

      // 7. Goat walks back completely offscreen
      startWalk(120);
      update({ goatX: -150, goatDura: 3.0 });
      await delay(3000);
      stopWalk();

      update({ goatVisible: false });
    };

    runAnimation();

    return () => { isMounted = false; };
  }, []);

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
          animation-delay: 0.5s;
          opacity: 0;
        }
      `}} />

      {/* 1. Hero Section */}
      <section className="relative w-full overflow-hidden min-h-[450px] md:min-h-[550px] flex items-center">
        {/* Background Image full width */}
        <div className="absolute inset-0 z-0 bg-zinc-200">
          <Image
            src="/images/gambardetaile/hero qurban.png"
            alt="Hero Qurban"
            fill
            className="object-cover object-center md:object-left"
            priority
          />
        </div>

        {/* Kambing Container Full Height: Sembunyikan di Mobile */}
        <div className="hidden md:flex absolute inset-0 z-20 mx-auto w-full max-w-7xl px-4 md:px-8 justify-center md:justify-end pointer-events-none">
          <div className="w-full md:w-[460px] h-full relative">
            {anim.goatVisible && (
               <div 
                 className="absolute bottom-0 left-0 w-[180px] h-[200px] md:w-[300px] md:h-[340px]"
                 style={{
                   transform: `translateX(calc(-100% + ${anim.goatX}vw)) scaleX(${anim.goatFlip})`,
                   transition: `transform ${anim.goatDura}s linear`,
                 }}
               >
                 <img src={anim.goatImg} alt="Kambing" className="w-full h-full object-contain object-bottom" />
               </div>
            )}
          </div>
        </div>

        {/* Content Box on Right */}
        <div className="relative z-10 mx-auto flex w-full max-w-7xl px-4 py-8 md:px-8 justify-center md:justify-end items-center h-full mt-10 md:mt-0">
          <div className="w-full md:w-[460px] relative mt-4 md:mt-0">
            
            {/* Kotak Donasi (Card) yang didorong */}
            <div 
              className="w-full bg-white rounded-md shadow-2xl relative max-md:!transform-none max-md:!transition-none"
              style={{
                transform: `translateX(${anim.cardX}vw)`,
                transition: `transform ${anim.cardDura}s cubic-bezier(0.2, 0.8, 0.2, 1)`,
              }}
            >
              {/* Taza Badge */}
            <div className={`absolute -top-6 -left-6 md:-top-7 md:-left-7 z-20 ${animateHero ? 'badge-bounce' : 'opacity-0'}`}>
              <div className="relative h-[60px] w-[60px] md:h-[68px] md:w-[68px]">
                <div aria-hidden className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]" />
                <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#7FC248]">
                  <svg viewBox="0 0 300 300" aria-hidden className="absolute inset-0 h-full w-full fill-black">
                    <defs>
                      <path id="qurban-badge-path" d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224" />
                    </defs>
                    <text fontSize="30" fontWeight="500" className="font-[var(--font-newsreader)]">
                      <textPath href="#qurban-badge-path" startOffset="50%" textAnchor="middle" textLength="680" lengthAdjust="spacing">
                        {BADGE_TEXT}
                      </textPath>
                    </text>
                  </svg>
                  <div className="relative z-10 flex h-[28px] w-[28px] md:h-[32px] md:w-[32px] items-center justify-center rounded-full border-[2px] border-black bg-[#7FC248]">
                    <Image src="/images/icon/hitam logo taza 1.svg" alt="Logo Taza hitam" width={26} height={30} className="h-[20px] w-auto md:h-[22px]" />
                  </div>
                </div>
              </div>
            </div>

            {/* Content area */}
            <div className="px-6 pt-10 pb-6 md:px-8 text-center">
              <h1 className="font-[var(--font-newsreader)] text-[22px] md:text-2xl font-bold leading-tight text-black">
                Salurkan Sedekahmu Untuk Layanan Ambulan Gratis
              </h1>
              <p className="mt-4 text-[14px] md:text-[15px] leading-relaxed text-zinc-700">
                Bantu Kami Memberikan Fasilitas Kesehatan Layak &amp; Gratis Kepada Warga Yang Membutuhkan
              </p>
              
              <div className="relative inline-block mt-7 mb-2">
                <div aria-hidden className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle" />
                <a href="#donasi" className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5">
                  <div className="relative rounded-sm bg-[#7FC248] px-5 py-2 md:px-6 md:py-2.5">
                    <div className="relative z-10 inline-flex items-center gap-2 font-semibold font-[var(--font-newsreader)] text-white text-[15px] md:text-[16px]">
                      <span>Donasi Disini</span>
                      <Image src="/images/icon/Donation.svg" alt="Ikon donasi" width={18} height={18} className="h-[18px] w-[18px]" />
                    </div>
                  </div>
                </a>
              </div>
            </div>

            {/* Bottom icons */}
            <div className="rounded-b-md bg-[#FAF3F0]/60 px-4 py-4 border-t border-zinc-100">
              <div className="flex items-center justify-around">
                <div className="flex flex-col items-center">
                  <Image src="/images/icon/amal-jariah.svg" alt="Amal Jariyah" width={32} height={32} className="h-8 w-auto md:h-9" />
                  <span className="mt-2 text-center text-xs font-medium text-zinc-700">
                    Amal Jariyah
                  </span>
                </div>
                <div className="flex flex-col items-center">
                  <Image src="/images/icon/investasi-dunia.svg" alt="Investasi Dunia & Akhirat" width={32} height={32} className="h-8 w-auto md:h-9" />
                  <span className="mt-2 text-center text-xs font-medium text-zinc-700">
                    Investasi Dunia<br />&amp; Akhirat
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </section>

      {/* 2. Benefits Section */}
      <section className="w-full bg-white px-4 py-16 md:py-24">
        <div className="mx-auto max-w-5xl flex flex-col items-center">
          <h2 className="text-2xl md:text-[32px] font-bold font-[var(--font-newsreader)] text-[#222520] mb-4 text-center">
            Amanah Qurban Anda, Nyata Manfaatnya
          </h2>
          <p className="text-[14px] md:text-[16px] text-zinc-700 text-center max-w-4xl leading-relaxed mb-14 md:mb-20 px-2 md:px-8">
            Bagaimana Anda tahu sedekah qurban Anda benar-benar sampai kepada yang membutuhkan? Kami memastikan setiap amanah tersalurkan dengan transparan, terdokumentasi, dan memberi dampak nyata bagi mereka yang jarang merasakan nikmatnya daging qurban.
          </p>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-8 w-full px-2">
            {/* Item 1 */}
            <div className="flex flex-col items-center text-center">
              <div className="h-[80px] w-[80px] md:h-[90px] md:w-[90px] mb-6 flex items-center justify-center">
                <div className="w-[60px] h-[60px] bg-[#e0c29a]" style={{ WebkitMaskImage: 'url("/images/icon/Successful Delivery.svg")', WebkitMaskSize: 'contain', WebkitMaskRepeat: 'no-repeat', WebkitMaskPosition: 'center', maskImage: 'url("/images/icon/Successful Delivery.svg")', maskSize: 'contain', maskRepeat: 'no-repeat', maskPosition: 'center' }}></div>
              </div>
              <h3 className="text-[17px] md:text-xl font-bold font-sans text-black mb-3">Tersalurkan Sepenuhnya</h3>
              <p className="text-[13px] md:text-[14px] text-zinc-600 leading-relaxed max-w-[280px]">
                Sedekah qurban Anda disalurkan langsung kepada masyarakat dhuafa, pelosok desa, dan wilayah minim pequrban
              </p>
            </div>
            {/* Item 2 */}
            <div className="flex flex-col items-center text-center">
              <div className="h-[80px] w-[80px] md:h-[90px] md:w-[90px] mb-6 flex items-center justify-center">
                <div className="w-[60px] h-[60px] bg-[#e0c29a]" style={{ WebkitMaskImage: 'url("/images/icon/Check File.svg")', WebkitMaskSize: 'contain', WebkitMaskRepeat: 'no-repeat', WebkitMaskPosition: 'center', maskImage: 'url("/images/icon/Check File.svg")', maskSize: 'contain', maskRepeat: 'no-repeat', maskPosition: 'center' }}></div>
              </div>
              <h3 className="text-[17px] md:text-xl font-bold font-sans text-black mb-3">Transparan &amp; Terbukti</h3>
              <p className="text-[13px] md:text-[14px] text-zinc-600 leading-relaxed max-w-[280px]">
                Anda akan menerima dokumentasi berupa foto, laporan, dan cerita penyaluran
              </p>
            </div>
            {/* Item 3 */}
            <div className="flex flex-col items-center text-center">
              <div className="h-[80px] w-[80px] md:h-[90px] md:w-[90px] mb-6 flex items-center justify-center">
                <div className="w-[60px] h-[60px] bg-[#e0c29a]" style={{ WebkitMaskImage: 'url("/images/icon/Worldwide Location.svg")', WebkitMaskSize: 'contain', WebkitMaskRepeat: 'no-repeat', WebkitMaskPosition: 'center', maskImage: 'url("/images/icon/Worldwide Location.svg")', maskSize: 'contain', maskRepeat: 'no-repeat', maskPosition: 'center' }}></div>
              </div>
              <h3 className="text-[17px] md:text-xl font-bold font-sans text-black mb-3">Berdampak Luas &amp; Bermakna</h3>
              <p className="text-[13px] md:text-[14px] text-zinc-600 leading-relaxed max-w-[280px]">
                Sedekah qurban Anda menghadirkan senyum, menguatkan ukhuwah, dan menjadi seutas kebaikan yang terus mengalir
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* 3. Grid Program Section */}
      <section className="w-full bg-white px-4 pb-20 md:pb-28">
        <div className="mx-auto max-w-[1000px]">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-x-12 md:gap-y-10">
            {/* Card 1 */}
            <div className="relative w-full aspect-[4/3] group overflow-hidden">
              <div className="absolute inset-0 z-0">
                <Image src="/images/gambardetaile/qurban pelosok desa 1.png" alt="Qurban pelosok desa 1" fill className="object-cover rounded-sm transition-transform duration-500 group-hover:scale-105" />
              </div>
              {/* Box Info */}
              <div className="absolute bottom-4 left-4 right-8 bg-white/95 backdrop-blur-sm px-6 py-4 rounded-sm shadow-md z-10 transition-all duration-300 transform group-hover:-translate-y-1">
                <h3 className="text-[17px] md:text-lg font-[var(--font-newsreader)] text-black mb-2 flex items-center justify-between font-bold">
                  Qurban Mudah &amp; Terjangkau <span className="text-xl ml-2">&rarr;</span>
                </h3>
                <p className="text-[12px] md:text-[13px] text-zinc-600 leading-relaxed">
                  Qurban terbaik dengan harga terjangkau, tetap sesuai syariat untuk saudara yang membutuhkan
                </p>
              </div>
            </div>

            {/* Card 2 */}
            <div className="relative w-full aspect-[4/3] group overflow-hidden">
              <div className="absolute inset-0 z-0">
                <Image src="/images/gambardetaile/qurban pelosok desa 2.png" alt="Qurban pelosok desa 2" fill className="object-cover rounded-sm transition-transform duration-500 group-hover:scale-105" />
              </div>
              {/* Box Info */}
              <div className="absolute bottom-4 left-4 right-8 bg-white/95 backdrop-blur-sm px-6 py-4 rounded-sm shadow-md z-10 transition-all duration-300 transform group-hover:-translate-y-1">
                <h3 className="text-[17px] md:text-lg font-[var(--font-newsreader)] text-black mb-2 flex items-center justify-between font-bold">
                  Qurban Terbaik Pilihan Anda <span className="text-xl ml-2">&rarr;</span>
                </h3>
                <p className="text-[12px] md:text-[13px] text-zinc-600 leading-relaxed">
                  Qurban berkualitas tinggi. Wujudkan qurban istimewa dengan niat yang lebih luas.
                </p>
              </div>
            </div>

            {/* Card 3 */}
            <div className="relative w-full aspect-[4/3] group overflow-hidden">
              <div className="absolute inset-0 z-0">
                <Image src="/images/gambardetaile/qurban indonesia timur.png" alt="Qurban Indonesia Timur" fill className="object-cover rounded-sm transition-transform duration-500 group-hover:scale-105" />
              </div>
              {/* Box Info */}
              <div className="absolute bottom-4 left-4 right-8 bg-white/95 backdrop-blur-sm px-6 py-4 rounded-sm shadow-md z-10 transition-all duration-300 transform group-hover:-translate-y-1">
                <h3 className="text-[17px] md:text-lg font-[var(--font-newsreader)] text-black mb-2 flex items-center justify-between font-bold">
                  Sebar Qurban Hingga Pelosok <span className="text-xl ml-2">&rarr;</span>
                </h3>
                <p className="text-[12px] md:text-[13px] text-zinc-600 leading-relaxed">
                  Salurkan qurban Anda ke wilayah minim perkotaan di Indonesia Timur
                </p>
              </div>
            </div>

            {/* Card 4 */}
            <div className="relative w-full aspect-[4/3] group overflow-hidden">
              <div className="absolute inset-0 z-0">
                <Image src="/images/gambardetaile/qurban palestina.png" alt="Qurban Palestina" fill className="object-cover rounded-sm transition-transform duration-500 group-hover:scale-105" />
              </div>
              {/* Box Info */}
              <div className="absolute bottom-4 left-4 right-8 bg-white/95 backdrop-blur-sm px-6 py-4 rounded-sm shadow-md z-10 transition-all duration-300 transform group-hover:-translate-y-1">
                <h3 className="text-[17px] md:text-lg font-[var(--font-newsreader)] text-black mb-2 flex items-center justify-between font-bold">
                  Harapan untuk Palestina <span className="text-xl ml-2">&rarr;</span>
                </h3>
                <p className="text-[12px] md:text-[13px] text-zinc-600 leading-relaxed">
                  Qurban Anda menjadi penguat dan penghibur bagi saudara kita di Palestina
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
