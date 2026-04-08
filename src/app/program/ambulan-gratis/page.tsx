"use client";

import Image from "next/image";
import { useEffect, useRef, useState } from "react";

const BADGE_TEXT = "Taman Zakat - Indonesia - taza -";

const HADITH_TEXT = "Jika seseorang meninggal dunia, maka terputuslah amalannya kecuali tiga perkara (yaitu): sedekah jariyah, ilmu yang di manfaatkan, atau do'a anak yang shalih.";

export default function AmbulanGratisPage() {
  const [animateAmbulance, setAnimateAmbulance] = useState(false);
  const [hadithVisible, setHadithVisible] = useState(false);
  const [facilitiesVisible, setFacilitiesVisible] = useState(false);
  const [typedText, setTypedText] = useState("");
  const [isTyping, setIsTyping] = useState(false);
  const hadithRef = useRef<HTMLElement>(null);
  const facilitiesRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const timer = setTimeout(() => {
      setAnimateAmbulance(true);
    }, 100);
    return () => clearTimeout(timer);
  }, []);

  // IntersectionObserver for hadith typing effect
  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !hadithVisible) {
          setHadithVisible(true);
        }
      },
      { threshold: 0.5 }
    );

    if (hadithRef.current) {
      observer.observe(hadithRef.current);
    }

    return () => observer.disconnect();
  }, [hadithVisible]);

  // IntersectionObserver for facilities entrance animation
  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !facilitiesVisible) {
          setFacilitiesVisible(true);
        }
      },
      { threshold: 0.5 }
    );

    if (facilitiesRef.current) {
      observer.observe(facilitiesRef.current);
    }

    return () => observer.disconnect();
  }, [facilitiesVisible]);

  // Typing effect
  useEffect(() => {
    if (!hadithVisible) return;

    setIsTyping(true);
    let i = 0;

    const interval = setInterval(() => {
      if (i < HADITH_TEXT.length) {
        setTypedText(HADITH_TEXT.slice(0, i + 1));
        i++;
      } else {
        clearInterval(interval);
        setIsTyping(false);
      }
    }, 40);

    return () => clearInterval(interval);
  }, [hadithVisible]);

  return (
    <section className="min-h-screen w-full bg-white overflow-x-hidden">
      {/* Ambulance drive-in animation */}
      <style dangerouslySetInnerHTML={{ __html: `
        @keyframes ambulanceDriveIn {
          0% {
            transform: translateX(-150%) scale(0.4);
            opacity: 0;
          }
          10% {
            opacity: 1;
          }
          100% {
            transform: translateX(0) scale(1);
            opacity: 1;
          }
        }
        .ambulance-animate {
          animation: ambulanceDriveIn 1.4s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        .ambulance-hidden {
          transform: translateX(-150%) scale(0.4);
          opacity: 0;
        }

        @keyframes speedLine {
          0% {
            transform: scaleX(0);
            opacity: 0;
          }
          30% {
            transform: scaleX(1);
            opacity: 0.8;
          }
          70% {
            transform: scaleX(0.6);
            opacity: 0.6;
          }
          100% {
            transform: scaleX(0);
            opacity: 0;
          }
        }
        .speed-line {
          position: absolute;
          height: 3px;
          border-radius: 4px;
          background: rgb(93, 166, 48);
          opacity: 0;
          pointer-events: none;
          transform-origin: right center;
        }
        .speed-line-animate {
          animation: speedLine 1.0s ease-out forwards;
        }

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
          /* Fall 1: accelerating down */
          12%  { transform: translateX(400px) translateY(-60px); }
          18%  { transform: translateX(340px) translateY(-20px); }
          24%  { transform: translateX(280px) translateY(0); }
          /* Bounce 1: arc up then down */
          28%  { transform: translateX(250px) translateY(-20px); }
          32%  { transform: translateX(220px) translateY(-42px); }
          36%  { transform: translateX(190px) translateY(-48px); }
          40%  { transform: translateX(160px) translateY(-42px); }
          44%  { transform: translateX(135px) translateY(-20px); }
          48%  { transform: translateX(110px) translateY(0); }
          /* Bounce 2: smaller arc */
          51%  { transform: translateX(95px) translateY(-10px); }
          54%  { transform: translateX(80px) translateY(-22px); }
          57%  { transform: translateX(65px) translateY(-24px); }
          60%  { transform: translateX(52px) translateY(-22px); }
          63%  { transform: translateX(40px) translateY(-10px); }
          66%  { transform: translateX(30px) translateY(0); }
          /* Bounce 3: small arc */
          70%  { transform: translateX(22px) translateY(-8px); }
          74%  { transform: translateX(15px) translateY(-10px); }
          78%  { transform: translateX(10px) translateY(-8px); }
          82%  { transform: translateX(5px) translateY(0); }
          /* Bounce 4: tiny */
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

        .facility-circle {
          opacity: 0;
          transform: translateY(40px);
          transition: opacity 1.2s cubic-bezier(0.16, 1, 0.3, 1), transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .facility-visible {
          opacity: 1;
          transform: translateY(0);
        }
      `}} />

      {/* ==================== HERO: AMBULANCE + CARD ==================== */}
      <section className="relative w-full overflow-x-clip">

        {/* Background: top half cream, bottom half green */}
        <div
          className="w-full"
          style={{ background: "linear-gradient(to bottom, #F0E6DA 50%, #A8D87B 50%)" }}
        >
          <div className="mx-auto flex w-full max-w-7xl flex-col md:flex-row items-stretch">
            {/* LEFT: Ambulance image */}
            <div className="relative w-full md:w-[55%] flex items-center overflow-visible">

              <div className="relative w-full h-full flex items-center justify-center px-4 py-8 md:py-12 md:pl-8 md:pr-4">
                {/* Speed lines - wind effect */}
                {animateAmbulance && (
                  <>
                    <span className="speed-line speed-line-animate" style={{ width: '200px', height: '4px', top: '25%', left: '-10%', animationDelay: '0.3s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '260px', height: '3px', top: '35%', left: '-15%', animationDelay: '0.15s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '180px', height: '4px', top: '45%', left: '-5%', animationDelay: '0.4s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '300px', height: '3px', top: '50%', left: '-20%', animationDelay: '0.1s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '220px', height: '4px', top: '60%', left: '-8%', animationDelay: '0.25s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '160px', height: '3px', top: '70%', left: '-3%', animationDelay: '0.35s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '240px', height: '3px', top: '42%', left: '-12%', animationDelay: '0.2s' }} />
                    <span className="speed-line speed-line-animate" style={{ width: '140px', height: '4px', top: '55%', left: '0%', animationDelay: '0.45s' }} />
                  </>
                )}
                <Image
                  src="/images/gambardetaile/ambulance-removebg.svg"
                  alt="Ambulan Gratis Taman Zakat"
                  width={700}
                  height={420}
                  className={`h-auto w-full max-w-[600px] object-contain ${
                    animateAmbulance ? "ambulance-animate" : "ambulance-hidden"
                  }`}
                  priority
                />
              </div>
            </div>

            {/* RIGHT: Card with badge, title, CTA, icons */}
            <div className="w-full md:w-[45%] flex items-center justify-center px-4 py-8 md:py-12 md:pr-8 md:pl-4">
              <div className="relative w-full max-w-md bg-[#FFFFFF] rounded-md">
                {/* Taza Badge - top left corner */}
                <div className={`absolute -top-5 -left-5 md:-top-6 md:-left-6 z-20 ${animateAmbulance ? 'badge-bounce' : 'opacity-0'}`}>
                  <div className="relative h-[56px] w-[56px] md:h-[68px] md:w-[68px]">
                    <div
                      aria-hidden
                      className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]"
                    />
                    <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#7FC248]">
                      <svg
                        viewBox="0 0 300 300"
                        aria-hidden
                        className="absolute inset-0 h-full w-full fill-black"
                      >
                        <defs>
                          <path
                            id="ambulan-badge-path"
                            d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224"
                          />
                        </defs>
                        <text fontSize="30" fontWeight="500" className="font-newsreader">
                          <textPath
                            href="#ambulan-badge-path"
                            startOffset="50%"
                            textAnchor="middle"
                            textLength="680"
                            lengthAdjust="spacing"
                          >
                            {BADGE_TEXT}
                          </textPath>
                        </text>
                      </svg>

                      <div className="relative z-10 flex h-[26px] w-[26px] items-center justify-center rounded-full border-[2px] border-black bg-[#7FC248] md:h-[32px] md:w-[32px]">
                        <Image
                          src="/images/icon/hitam logo taza 1.svg"
                          alt="Logo Taza hitam"
                          width={26}
                          height={30}
                          className="h-[18px] w-auto md:h-[22px]"
                        />
                      </div>
                    </div>
                  </div>
                </div>

                {/* Upper content area with padding */}
                <div className="px-6 pt-8 pb-6 md:px-8 md:pt-10 md:pb-6">
                  {/* Title */}
                  <h1 className="mt-4 font-newsreader text-lg font-bold leading-tight text-black md:text-xl">
                    Salurankan Sedekahmu Untuk Layanan Ambulan Gratis
                  </h1>

                  {/* Description */}
                  <p className="mt-3 text-sm leading-relaxed text-zinc-700 md:text-base">
                    Bantu Kami Memberikan Fasilitas Kesehatan Layak &amp; Gratis Kepada Warga Yang Membutuhkan
                  </p>

                  {/* Donasi Button */}
                  <div className="relative inline-block mt-6">
                    <div
                      aria-hidden
                      className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
                    />
                    <a
                      href="#donasi"
                      className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
                    >
                      <div className="relative rounded-sm bg-[#7FC248] px-4 py-2 md:px-5 md:py-2.5">
                        <div className="relative z-10 inline-flex items-center gap-2 text-sm font-semibold font-newsreader text-white md:text-base">
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

                {/* Bottom icons: flush with card bottom */}
                <div className="rounded-b-md bg-[#FAF3F0]/60 px-4 py-4">
                  <div className="flex items-start justify-around">
                    {/* Amal Jariyah */}
                    <div className="flex flex-col items-center">
                      <Image
                        src="/images/icon/amal-jariah.svg"
                        alt="Amal Jariyah"
                        width={40}
                        height={34}
                        className="h-8 w-auto"
                      />
                      <span className="mt-1.5 text-center text-xs font-medium text-zinc-700">
                        Amal Jariyah
                      </span>
                    </div>

                    {/* Investasi Dunia & Akhirat */}
                    <div className="flex flex-col items-center">
                      <Image
                        src="/images/icon/investasi-dunia.svg"
                        alt="Investasi Dunia & Akhirat"
                        width={40}
                        height={40}
                        className="h-8 w-auto"
                      />
                      <span className="mt-1.5 text-center text-xs font-medium text-zinc-700">
                        Investasi Dunia<br />& Akhirat
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

      {/* ==================== KUTIPAN HADITS ==================== */}
      <section className="w-full bg-white px-4 py-10 md:py-14" ref={hadithRef}>
        <div className="mx-auto max-w-3xl text-center">
          <h2 className="font-newsreader text-lg font-semibold italic text-[#3a7d1c] md:text-2xl leading-relaxed">
            Rasulullah Shallallahu &apos;alaihi wasallam bersabda:
          </h2>
          <blockquote className="relative mt-4 font-newsreader text-base italic leading-relaxed text-zinc-700 md:text-lg">
            {/* Invisible text to reserve space and prevent layout shifts */}
            <div className="invisible" aria-hidden="true">
              &ldquo;{HADITH_TEXT}&rdquo; (HR. Muslim)
            </div>
            {/* Actual animated text */}
            <div className="absolute inset-0">
              &ldquo;{typedText}
              {isTyping && <span className="inline-block w-[2px] h-[1em] bg-zinc-700 align-text-bottom ml-[1px] animate-pulse" />}
              {!isTyping && hadithVisible && <span>&rdquo; (HR. Muslim)</span>}
            </div>
          </blockquote>
        </div>
      </section>

      {/* ==================== FASILITAS AMBULANCE GRATIS ==================== */}
      <section className="w-full bg-[#FAF7F0] px-4 py-10 md:py-16">
        <div className="mx-auto max-w-5xl">
          <h2 className="text-center font-newsreader text-xl font-semibold text-black md:text-2xl">
            Fasilitas Ambulance Gratis
          </h2>
          <p className="mx-auto mt-3 max-w-3xl text-center text-sm leading-relaxed text-zinc-600 md:text-base">
            Taman Zakat melalui program infak operasional Ambulance Gratis menyediakan
            layanan kesehatan yang meliputi:
          </p>

          {/* 3 ikon fasilitas */}
          <div className="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-3 md:gap-8" ref={facilitiesRef}>
            {/* Fasilitas 1 */}
            <div className="flex flex-col items-center text-center">
              <div 
                className={`flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-md md:h-24 md:w-24 facility-circle ${facilitiesVisible ? 'facility-visible' : ''}`}
                style={{ transitionDelay: '0.1s' }}
              >
                <Image
                  src="/images/icon/layanan-antar-jemput.svg"
                  alt="Gratis Antar Jemput Pasien"
                  width={48}
                  height={48}
                  className="h-10 w-10 md:h-20 md:w-20"
                />
              </div>
              <h3 className="mt-4 font-newsreader text-base font-semibold text-black md:text-lg">
                Layanan Antar Jemput Pasien Dhuafa
              </h3>
              <p className="mt-1 text-sm text-zinc-600">Pasien/Gratis</p>
            </div>

            {/* Fasilitas 2 */}
            <div className="flex flex-col items-center text-center">
              <div 
                className={`flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-md md:h-24 md:w-24 facility-circle ${facilitiesVisible ? 'facility-visible' : ''}`}
                style={{ transitionDelay: '0.3s' }}
              >
                <Image
                  src="/images/icon/mobil-sehat-keliling.svg"
                  alt="Mobil Sehat Keliling"
                  width={48}
                  height={48}
                  className="h-10 w-10 md:h-20 md:w-20"
                />
              </div>
              <h3 className="mt-4 font-newsreader text-base font-semibold text-black md:text-lg">
                Mobil Sehat Keliling
              </h3>
              <p className="mt-1 text-sm text-zinc-600">Bantuan</p>
            </div>

            {/* Fasilitas 3 */}
            <div className="flex flex-col items-center text-center">
              <div 
                className={`flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-md md:h-24 md:w-24 facility-circle ${facilitiesVisible ? 'facility-visible' : ''}`}
                style={{ transitionDelay: '0.5s' }}
              >
                <Image
                  src="/images/icon/mobil-tanggap-bencana.svg"
                  alt="Mobil Pasien Darurat"
                  width={48}
                  height={48}
                  className="h-10 w-10 md:h-20 md:w-20"
                />
              </div>
              <h3 className="mt-4 font-newsreader text-base font-semibold text-black md:text-lg">
                Mobil Tanggap Bencana
              </h3>
              <p className="mt-1 text-sm text-zinc-600">Darurat/Setting</p>
            </div>
          </div>
        </div>
      </section>

      {/* ==================== VIDEO + DESKRIPSI ==================== */}
      <section className="w-full bg-white px-4 py-10 md:py-16">
        <div className="mx-auto flex w-full max-w-6xl flex-col gap-8 md:flex-row md:items-center md:gap-12">
          {/* Video Placeholder */}
          <div className="w-full md:w-1/2">
            <div className="relative aspect-video w-full overflow-hidden rounded-lg bg-zinc-200 shadow-md">
              {/* Thumbnail dari footage ambulance */}
              <Image
                src="/images/gambardetaile/footage ambulance 1.svg"
                alt="Video Ambulan Gratis Taman Zakat"
                fill
                className="object-cover"
              />
              {/* Play button overlay */}
              <div className="absolute inset-0 flex items-center justify-center bg-black/20">
                <div className="flex h-14 w-14 items-center justify-center rounded-full bg-red-600 shadow-lg transition-transform hover:scale-110 md:h-16 md:w-16">
                  <svg
                    viewBox="0 0 24 24"
                    fill="white"
                    className="ml-1 h-7 w-7 md:h-8 md:w-8"
                  >
                    <path d="M8 5v14l11-7z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>

          {/* Deskripsi */}
          <article className="w-full text-black md:w-1/2">
            <h2 className="font-newsreader text-lg font-semibold leading-tight md:text-2xl">
              Ambulan Gratis Taman Zakat
            </h2>
            <p className="mt-3 text-xs leading-relaxed md:text-base">
              Program layanan ambulan Taman Zakat dimaksudkan dapat mengurangi kemiskinan
              bagi warga serta tidak menyusahkan keluarga/sahabat yang
              taya dan terpuruk dimasa-masa mereka yang
              pertama pada kesulitan.
            </p>
            <a
              href="#donasi"
              className="mt-6 inline-block font-newsreader text-base text-[#3a5f2a] underline decoration-1 underline-offset-4"
            >
              Baca Penuh
            </a>
          </article>
        </div>
      </section>

      {/* ==================== SEBARAN AKSI TAMAN ZAKAT ==================== */}
      <section className="w-full bg-[#1B2A4A] px-4 py-10 md:py-14">
        <div className="mx-auto max-w-5xl">
          <h2 className="text-center font-newsreader text-xl font-semibold italic text-white md:text-2xl">
            Sebaran Aksi Taman Zakat
          </h2>
          <p className="mt-1 text-center font-newsreader text-sm text-white/70 md:text-base">
            Tahun 2020
          </p>

        </div>
      </section>

      {/* ==================== PETA SEBARAN ==================== */}
      <section className="w-full bg-[#E5E9E9] px-4 py-10 md:py-14">
        <div className="mx-auto max-w-5xl">
          <div className="relative aspect-[21/9] w-full overflow-hidden">
            <Image
              src="/images/gambardetaile/map_beasiswa_1-removebg-preview 1.svg"
              alt="Peta Sebaran Aksi Taman Zakat"
              fill
              className="object-contain"
            />
          </div>

          {/* Lihat Detail Link */}
          <div className="mt-6 text-center">
            <a
              href="#"
              className="inline-block font-newsreader text-sm text-zinc-800 underline decoration-1 underline-offset-4 transition-opacity hover:opacity-70 md:text-base"
            >
              Lihat Detail Disini
            </a>
          </div>
        </div>
      </section>

      {/* ==================== GALERI FOTO AMBULANCE ==================== */}
      <section className="w-full bg-white pt-30 pb-0">
        <div className="flex w-full flex-col md:flex-row md:justify-between">
          <figure className="relative w-full md:w-[43%] aspect-[3/2] overflow-hidden rounded-t-md">            <Image
              src="/images/gambardetaile/footage ambulance 1.svg"
              alt="Ambulan Gratis beraksi di lapangan"
              fill
              className="object-cover"
            />
          </figure>
          <figure className="relative w-full md:w-[43%] aspect-[3/2] overflow-hidden rounded-t-md">
            <Image
              src="/images/gambardetaile/footage ambul 2 1.svg"
              alt="Ambulan Gratis melayani masyarakat"
              fill
              className="object-cover"
            />
          </figure>
        </div>
      </section>

      {/* ==================== DONASI AMBULANCE GRATIS (CTA) ==================== */}
      <section
        id="donasi"
        className="w-full bg-[#222520] px-4 py-14 md:py-20"
      >
        <div className="mx-auto max-w-3xl text-center">
          <h2 className="font-newsreader text-xl font-bold uppercase tracking-wider text-white md:text-3xl">
            Donasi Ambulance Gratis
          </h2>
          <p className="mx-auto mt-4 max-w-xl text-sm leading-relaxed text-white/80 md:text-base">
            Ayo ambil bagian untuk Akhirat <br />
            Amal jariyah yang terus mengalir pahalanya
          </p>

          {/* Tombol Donasi */}
          <div className="relative mx-auto mt-8 inline-block">
            <div
              aria-hidden
              className="absolute inset-0 z-20 rounded-sm border-2 border-white border-wiggle"
            />

            <a
              href="#"
              className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
            >
              <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5 md:px-7 md:py-3">
                <div className="relative z-10 inline-flex items-center gap-2 text-base font-semibold font-newsreader text-white md:text-lg">
                  <span>Donasi Disini</span>
                  <Image
                    src="/images/icon/Donation.svg"
                    alt="Ikon donasi"
                    width={20}
                    height={20}
                    className="h-5 w-5"
                  />
                </div>
              </div>
            </a>
          </div>
        </div>
      </section>
    </section>
  );
}
