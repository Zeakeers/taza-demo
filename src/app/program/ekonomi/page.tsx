"use client";

import Image from "next/image";
import { useEffect, useState } from "react";

const BADGE_TEXT = "Taman Zakat - Indonesia - taza -";

export default function BidangEkonomiPage() {
  const [animateBadge, setAnimateBadge] = useState(false);

  useEffect(() => {
    const timer = setTimeout(() => {
      setAnimateBadge(true);
    }, 100);
    return () => clearTimeout(timer);
  }, []);

  return (
    <main className="min-h-screen w-full bg-white overflow-x-hidden">
      <style
        dangerouslySetInnerHTML={{
          __html: `
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
      `,
        }}
      />

      {/* ===================== HERO SECTION ===================== */}
      <section className="relative w-full flex items-end md:items-center min-h-[500px] md:min-h-[600px] pt-48 pb-10 md:py-24">
        {/* BACKGROUND IMAGE FILL */}
        <div className="absolute inset-0 z-0">
          <Image
            src="/images/gambardetaile/hero halaman ekonomi.svg"
            alt="Background Bidang Ekonomi"
            fill
            className="object-cover object-[15%_center] md:object-center"
            priority
          />
        </div>

        <div className="relative z-10 max-w-7xl mx-auto w-full px-4 sm:px-6 md:px-12 flex justify-center md:justify-end">
          {/* CARD RIGHT */}
          <div className="bg-white rounded-2xl md:rounded-md w-full sm:max-w-[380px] md:max-w-[400px] p-5 sm:p-6 md:p-8 relative border border-green-50 shadow-[15px_-10px_30px_rgba(127,194,72,0.25)] md:shadow-[25px_-15px_40px_rgba(127,194,72,0.25)] mt-10 md:mt-0">
            {/* Badge Taza (Top Left corner) */}
            <div
              className={`absolute -top-6 -left-3 md:-top-12 md:-left-12 z-20 ${animateBadge ? "badge-bounce" : "opacity-0"}`}
            >
              <div className="relative h-[70px] w-[70px] md:h-[100px] md:w-[100px]">
                <div
                  aria-hidden
                  className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]"
                />
                <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#8cc63f]">
                  <svg
                    viewBox="0 0 300 300"
                    aria-hidden
                    className="absolute inset-0 h-full w-full fill-black transform -rotate-12"
                  >
                    <defs>
                      <path
                        id="ambulan-badge-path"
                        d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224"
                      />
                    </defs>
                    <text fontSize="28" fontWeight="500" className="font-newsreader">
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

                  <div className="relative z-10 flex h-[30px] w-[30px] md:h-[45px] md:w-[45px] items-center justify-center rounded-full border-[2px] border-black bg-[#8cc63f]">
                    <Image
                      src="/images/icon/hitam logo taza 1.svg"
                      alt="Logo Taza"
                      width={36}
                      height={36}
                      className="h-[18px] w-auto md:h-[28px]"
                    />
                  </div>
                </div>
              </div>
            </div>

            <h1 className="text-[26px] md:text-[32px] font-newsreader font-bold text-black mb-5 mt-4 ml-6 md:ml-8 text-left drop-shadow-sm">
              Bidang <span className="text-[#8cc63f]">Ekonomi</span>
            </h1>

            <ul className="space-y-3 md:space-y-4 mb-8 md:mb-10 ml-2 md:ml-8">
              {[
                "Tebar Hewan Kurban",
                "Berbagi Fitrah",
                "Zakat Maal",
                "Bingkisan Kado Lebaran",
                "Berbagi Ifhtar Istimewa",
                "Stimulasi Pelaku Usaha Sejahtera",
              ].map((item, idx) => (
                <li key={idx} className="flex items-center gap-3 md:gap-4">
                  {/* Icon Centang khusus */}
                  <div className="w-[24px] h-[24px] md:w-[32px] md:h-[32px] rounded-full bg-[#1e5b3a] flex items-center justify-center flex-shrink-0 relative overflow-hidden shadow-sm">
                    <svg
                      className="w-3.5 h-3.5 md:w-5 md:h-5 text-white stroke-white stroke-[4]"
                      fill="none"
                      viewBox="0 0 24 24"
                      strokeLinecap="square"
                      strokeLinejoin="miter"
                    >
                      <polyline points="5 12 10 17 22 2"></polyline>
                    </svg>
                  </div>
                  <span className="text-zinc-800 font-semibold text-[15px] md:text-[18px]">
                    {item}
                  </span>
                </li>
              ))}
            </ul>

            <div className="flex justify-center mt-6 mb-2 w-full">
              <div className="relative inline-block">
                <div
                  aria-hidden
                  className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
                />
                <a
                  href="#donasi"
                  className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
                >
                  <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5 md:px-6 md:py-3">
                    <div className="relative z-10 inline-flex items-center gap-2 text-[15px] font-semibold font-newsreader text-white md:text-[18px]">
                      <span>Donasi Disini</span>
                      <Image
                        src="/images/icon/Donation.svg"
                        alt="Ikon donasi"
                        width={20}
                        height={20}
                        className="h-[20px] w-[20px]"
                      />
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ===================== PROGRAM EKONOMI INTRO ===================== */}
      <section className="w-full py-16 px-4 md:px-12 bg-white flex justify-center">
        <div className="max-w-5xl w-full flex flex-col md:flex-row items-center justify-between gap-10">
          <div className="w-full md:w-1/2 order-2 md:order-1 flex justify-center md:justify-start">
            <div className="max-w-md w-full">
              <h2 className="text-2xl md:text-3xl font-newsreader font-bold text-black mb-4">
                Program Ekonomi
              </h2>
              <p className="text-zinc-700 text-sm md:text-base md:leading-relaxed text-left">
                Taman Zakat adalah lembaga amil zakat nasional milik masyarakat Indonesia yang
                mengelola zakat, infak, sedekah, serta dana kemanusiaan lainnya melalui serangkaian
                program salah satunya adalah kesehatan. Isu permasalahan yang diintervensi Rumah
                Zakat dalam bidang kesehatan adalah stunting & wasting (gizi buruk), ancaman
                kesejahteraan lansia (pemenuhan kebutuhan dasar, penelantaran, dll), akses terhadap
                air minum dan sanitasi yang layak, dan kerawanan pangan.
              </p>
            </div>
          </div>
          <div className="w-full md:w-1/2 order-1 md:order-2 flex justify-center md:justify-end">
            <Image
              src="/images/gambardetaile/bidang ekonomi.svg"
              alt="Program Ekonomi"
              width={500}
              height={400}
              className="w-full max-w-sm md:max-w-md object-contain"
            />
          </div>
        </div>
      </section>

      {/* ===================== LIST EKONOMI BLOCKS ===================== */}

      {/* Tebar Hewan Kurban */}
      <section className="w-full py-16 px-4 md:px-12 bg-[#F8EED3]">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 flex justify-center md:justify-end">
            <div className="relative w-[90%] md:w-full max-w-[400px] aspect-[4/3] mt-6 md:mt-0">
              {/* Shadow matches section background */}
              <div className="absolute -top-3 -left-3 md:-top-4 md:-left-4 w-[65%] h-[98%] bg-[#F8EED3] rounded-xl shadow-[-12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                <Image
                  src="/images/gambardetaile/qurban pelosok desa 1.png"
                  alt="Tebar Hewan Kurban"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
          <div className="w-full md:w-1/2 flex flex-col justify-center items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Tebar Hewan Kurban
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Hanya dengan <span className="text-[#FF5B5B] font-bold">Rp10.000</span>, Anda bisa
                menjadi bagian dari harapan—membantu memutus kesenjangan pangan dan menghadirkan
                makanan bagi saudara dhuafa yang sedang berjuang di masa sulit ini.
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
                <button className="bg-white border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
                  Lihat Detail Program
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Berbagi Fitrah */}
      <section className="w-full py-16 px-4 md:px-12 bg-white">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 order-2 md:order-1 flex flex-col items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Berbagi Fitrah
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Program infak ambulans Taman Zakat diharapkan dapat mengurangi hambatan-hambatan
                bagi warga desa untuk mendapatkan fasilitas kesehatan yang layak dan terjamin dalam
                pertolongan pertama pada kesehatan.
              </p>
              <div className="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                <button className="bg-white border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
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
              {/* Shadow matches section background */}
              <div className="absolute -top-3 -right-3 md:-top-4 md:-right-4 w-[65%] h-[98%] bg-[#FFFFFF] rounded-xl shadow-[12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                <Image
                  src="/images/gambardetaile/diberi taza 1.svg"
                  alt="Berbagi Fitrah"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Zakat Maal */}
      <section className="w-full py-16 px-4 md:px-12 bg-[#F8EED3]">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 flex justify-center md:justify-end">
            <div className="relative w-[90%] md:w-full max-w-[400px] aspect-[4/3] mt-6 md:mt-0">
              <div className="absolute -top-3 -left-3 md:-top-4 md:-left-4 w-[65%] h-[98%] bg-[#F8EED3] rounded-xl shadow-[-12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                <Image
                  src="/images/gambardetaile/santri 1.svg"
                  alt="Zakat Maal"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
          <div className="w-full md:w-1/2 flex flex-col justify-center items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Zakat Maal
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Hanya dengan <span className="text-[#FF5B5B] font-bold">Rp10.000</span>, Anda bisa
                menjadi bagian dari harapan—membantu memutus kesenjangan pangan dan menghadirkan
                makanan bagi saudara dhuafa yang sedang berjuang di masa sulit ini.
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
                <button className="bg-white border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
                  Lihat Detail Program
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Bingkisan Kado Lebaran */}
      <section className="w-full py-16 px-4 md:px-12 bg-white">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 order-2 md:order-1 flex flex-col items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Bingkisan Kado Lebaran
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Program infak ambulans Taman Zakat diharapkan dapat mengurangi hambatan-hambatan
                bagi warga desa untuk mendapatkan fasilitas kesehatan yang layak dan terjamin dalam
                pertolongan pertama pada kesehatan.
              </p>
              <div className="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                <button className="bg-white border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
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

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                <Image
                  src="/images/gambardetaile/imagebukapuasa1.png"
                  alt="Bingkisan Kado Lebaran"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Berbagi Ifhtar Istimewa */}
      <section className="w-full py-16 px-4 md:px-12 bg-[#F8EED3]">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 flex justify-center md:justify-end">
            <div className="relative w-[90%] md:w-full max-w-[400px] aspect-[4/3] mt-6 md:mt-0">
              <div className="absolute -top-3 -left-3 md:-top-4 md:-left-4 w-[65%] h-[98%] bg-[#F8EED3] rounded-xl shadow-[-12px_-12px_15px_rgba(127,194,72,0.2)] z-0" />

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                <Image
                  src="/images/gambardetaile/qurban palestina.png"
                  alt="Berbagi Ifhtar Istimewa"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
          <div className="w-full md:w-1/2 flex flex-col justify-center items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Berbagi Ifhtar Istimewa
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Hanya dengan <span className="text-[#FF5B5B] font-bold">Rp10.000</span>, Anda bisa
                menjadi bagian dari harapan—membantu memutus kesenjangan pangan dan menghadirkan
                makanan bagi saudara dhuafa yang sedang berjuang di masa sulit ini.
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
                <button className="bg-white border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
                  Lihat Detail Program
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Stimulasi Pelaku Usaha Sejahtera */}
      <section className="w-full py-16 px-4 md:px-12 bg-white">
        <div className="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-14">
          <div className="w-full md:w-1/2 order-2 md:order-1 flex flex-col items-center md:items-start text-center md:text-left">
            <div className="max-w-md">
              <h2 className="text-lg md:text-2xl font-newsreader font-bold text-black mb-3">
                Stimulasi Pelaku Usaha Sejahtera
              </h2>
              <p className="text-zinc-800 text-sm leading-relaxed mb-6 font-medium">
                Program infak ambulans Taman Zakat diharapkan dapat mengurangi hambatan-hambatan
                bagi warga desa untuk mendapatkan fasilitas kesehatan yang layak dan terjamin dalam
                pertolongan pertama pada kesehatan.
              </p>
              <div className="flex flex-col sm:flex-row items-center justify-center md:justify-start gap-4">
                <button className="bg-white border text-[#7FC248] shadow-sm px-4 py-2 md:px-5 md:py-2.5 rounded hover:bg-[#F3F9EF] transition font-semibold text-xs md:text-sm border-[#7FC248]/30">
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

              <div className="relative z-10 w-full h-full rounded-xl overflow-hidden">
                <Image
                  src="/images/gambardetaile/maspion 1.svg"
                  alt="Stimulasi Pelaku Usaha Sejahtera"
                  fill
                  className="object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ===================== BOTTOM COLLAGE SECTION ===================== */}
      <section className="w-full pt-10 md:pt-20 pb-12 md:pb-16 px-4 md:px-12 bg-[#F8EED3] relative overflow-hidden">
        <div className="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-8 md:gap-14">
          {/* Left: Collage */}
          <div className="w-full md:w-1/2 relative min-h-[350px] sm:min-h-[450px] md:min-h-[750px] lg:min-h-[800px] my-4 md:my-8 flex-shrink-0">
            {/* Image 1 (Top Center) */}
            <div className="absolute top-0 left-[15%] lg:left-[18%] w-[55%] xl:w-[50%] aspect-[4/3] rounded border-[3px] border-[#8CC63F] shadow-md z-40 rotate-[2deg] overflow-hidden">
              <Image
                src="/images/gambardetaile/qurban pelosok desa 1.png"
                alt="Tebar Hewan Qurban"
                fill
                className="object-cover"
              />
            </div>
            {/* Image 2 (Middle Left) */}
            <div className="absolute top-[28%] left-[0%] w-[45%] xl:w-[42%] aspect-[4/3] rounded border-[3px] border-[#8CC63F] shadow-md z-20 rotate-[-3deg] overflow-hidden">
              <Image
                src="/images/gambardetaile/santri 1.svg"
                alt="Santri"
                fill
                className="object-cover"
              />
            </div>
            {/* Image 3 (Middle Right) */}
            <div className="absolute top-[32%] right-[2%] lg:right-[5%] w-[52%] xl:w-[48%] aspect-[4/3] rounded border-[3px] border-[#8CC63F] shadow-md z-20 rotate-[1deg] overflow-hidden">
              <Image
                src="/images/gambardetaile/qurban palestina.png"
                alt="Qurban Palestina"
                fill
                className="object-cover"
              />
            </div>
            {/* Image 4 (Bottom Left) */}
            <div className="absolute top-[56%] left-[8%] lg:left-[10%] w-[40%] xl:w-[35%] aspect-[3/4] rounded border-[3px] border-[#8CC63F] shadow-md z-50 rotate-[2deg] overflow-hidden">
              <Image
                src="/images/gambardetaile/diberi taza 1.svg"
                alt="Santunan"
                fill
                className="object-cover"
              />
            </div>
            {/* Image 5 (Bottom Right) */}
            <div className="absolute top-[62%] right-[5%] lg:right-[10%] w-[48%] xl:w-[45%] aspect-[4/3] rounded border-[3px] border-[#8CC63F] shadow-md z-30 rotate-[-2deg] overflow-hidden">
              <Image
                src="/images/gambardetaile/imagebukapuasa1.png"
                alt="Buka Puasa"
                fill
                className="object-cover"
              />
            </div>
          </div>

          {/* Right: Text */}
          <div className="w-full md:w-1/2 flex flex-col items-center md:items-end text-center md:text-right mt-4 md:mt-0">
            <h2 className="text-xl sm:text-2xl md:text-3xl font-newsreader font-bold text-black mb-3">
              Dari Amanah Menjadi Manfaat
            </h2>
            <p className="text-zinc-800 text-sm md:text-[16px] leading-relaxed mb-6 font-medium max-w-sm">
              Amanah Anda kami jaga, dan kami pastikan sampai menjadi manfaat nyata.
            </p>
            <div className="relative inline-block">
              <div
                aria-hidden
                className="absolute inset-0 z-20 rounded-sm border-2 border-black border-wiggle"
              />
              <a
                href="#donasi"
                className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
              >
                <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5 md:px-6 md:py-3">
                  <div className="relative z-10 inline-flex items-center gap-2 text-[15px] font-semibold font-newsreader text-white">
                    <span>Donasi Disini</span>
                    <Image
                      src="/images/icon/Donation.svg"
                      alt="Ikon donasi"
                      width={20}
                      height={20}
                      className="h-[20px] w-[20px]"
                    />
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* ===================== SEDEKAH BERAS DHUAFA ===================== */}
      <section className="w-full relative bg-[#FAF7F0] pb-0 mt-8 md:mt-16 overflow-visible">
        {/* Latar Putih & FAF7F0 (Porsi putih lebih sedikit dari krem bawah) */}
        <div className="absolute top-0 left-0 right-0 h-[45%] md:h-[42%] bg-white z-0"></div>

        <div className="max-w-5xl mx-auto px-4 md:px-8 relative z-10 flex flex-col md:flex-row md:items-end justify-center min-h-[300px] md:min-h-[340px]">
          
          {/* Tanda petik berpotongan di perbatasan putih & krem */}
          <div className="absolute top-[45%] md:top-[42%] left-1/2 transform -translate-x-1/2 z-0">
            <div className="text-[#F1E0B3] text-[90px] md:text-[160px] font-serif leading-none select-none relative -top-[25px] md:-top-[45px]">
              “
            </div>
          </div>

          {/* Bagian Teks (Berada di Kiri, Rata Kanan) */}
          <div className="w-full md:w-1/2 flex flex-col items-center md:items-end text-center md:text-right relative z-10 pb-6 md:pb-20 pr-0 md:pr-16 lg:pr-28 pt-8 md:pt-16">
            <h3 className="text-xl md:text-[28px] font-newsreader font-bold text-black mb-2 md:mb-4">
              Sedekah Beras Dhuafa
            </h3>
            <p className="text-zinc-600 text-sm md:text-[16px] max-w-[280px] font-medium leading-relaxed">
              Gotong royong dalam kebaikan, jangan biarkan saudaramu dalam kelaparan
            </p>
          </div>

          {/* Bagian Gambar (Berada di Kanan, Diperkecil) */}
          <div className="w-full md:w-1/2 flex justify-center md:justify-start relative z-20 pb-0 pl-0 md:pl-16 lg:pl-28 mt-2 md:mt-0">
            <Image
              src="/images/gambardetaile/sedekah-beras_1-removebg-preview 1.svg"
              alt="Sedekah Beras Dhuafa"
              width={220}
              height={280}
              className="w-[180px] sm:w-[200px] md:w-[220px] h-auto object-contain drop-shadow-xl"
            />
          </div>

        </div>
      </section>
    </main>
  );
}
