"use client";

import Image from "next/image";
import { useEffect, useRef, useState } from "react";



export default function SekolahBintangPage() {
  const [counterVisible, setCounterVisible] = useState(false);
  const [count, setCount] = useState(0);
  const counterRef = useRef<HTMLDivElement>(null);

  // IntersectionObserver for counter animation
  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !counterVisible) {
          setCounterVisible(true);
        }
      },
      { threshold: 0.5 }
    );

    if (counterRef.current) {
      observer.observe(counterRef.current);
    }

    return () => observer.disconnect();
  }, [counterVisible]);

  // Count up animation
  useEffect(() => {
    if (!counterVisible) return;

    const target = 749;
    const duration = 2000;
    const steps = 60;
    const stepValue = target / steps;
    let current = 0;

    const interval = setInterval(() => {
      current += stepValue;
      if (current >= target) {
        setCount(target);
        clearInterval(interval);
      } else {
        setCount(Math.floor(current));
      }
    }, duration / steps);

    return () => clearInterval(interval);
  }, [counterVisible]);

  return (
    <section className="min-h-screen w-full bg-white overflow-x-hidden">
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
        @keyframes labelSeesaw {
          0%   { transform: translateX(-50%) rotate(-3deg); }
          50%  { transform: translateX(-50%) rotate(3deg); }
          100% { transform: translateX(-50%) rotate(-3deg); }
        }
        .label-seesaw {
          animation: labelSeesaw 2.5s ease-in-out infinite;
          transform-origin: center center;
        }
        .fade-up {
          opacity: 0;
          transform: translateY(30px);
          transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1), transform 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .fade-up.visible {
          opacity: 1;
          transform: translateY(0);
        }
      `}} />

      {/* ==================== HERO SECTION ==================== */}
      <section
        className="w-full px-4 py-12 md:py-16"
        style={{ background: "linear-gradient(to bottom, #FAF7F0 65%, #F8EED3 65%)" }}
      >
        <div className="mx-auto max-w-4xl text-center">

          <h1 className="font-newsreader text-2xl font-bold leading-tight text-black md:text-3xl lg:text-4xl">
            Ikuti Infaq Pembangunan Sekolah<br />Penghafal Al&apos;Quran
          </h1>
          <p className="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-zinc-600 md:text-base">
            Pembangunan Sekolah Penghafal Al-Quran yang diselenggarakan di beberapa lokasi memberikan
            wadah yang nyaman dan aman.
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
              <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5">
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

        {/* Video Player Placeholder */}
        <div className="mx-auto mt-10 max-w-3xl">
          <div className="relative aspect-video w-full overflow-hidden rounded-lg bg-zinc-200 shadow-lg">
            <div className="absolute inset-0 flex items-center justify-center">
              <div className="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-md md:h-20 md:w-20">
                <svg className="h-8 w-8 text-[#7FC248] ml-1 md:h-10 md:w-10" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ==================== INVESTASI AKHIRAT ==================== */}
      <section className="w-full bg-[#FAF7F0] px-4 pt-12 pb-0 md:pt-16 md:pb-0">
        <div className="mx-auto max-w-4xl text-center">
          <h2 className="font-newsreader text-xl font-bold italic text-black md:text-2xl lg:text-3xl">
            Investasi Akhirat yang tepat
          </h2>
          <p className="mx-auto mt-4 max-w-3xl text-sm leading-relaxed text-zinc-600 md:text-base">
            Program Infaq Sekolah Penghafal Al-quran 1 M ini adalah satu-satunya cara yang bisa kita
            lakukan untuk mengurangi Pendirian membangun sekolah penghafal quran, Ikuti dan fokus sekolah
            penghafal al quran ini sekalikn.
          </p>

          {/* Price Cards Row 1 */}
          <div className="mt-14 grid grid-cols-3 gap-5 md:gap-8 max-w-3xl mx-auto">
            {/* Per 2 cm² */}
            <div className="relative pt-4">
              <div className="absolute left-1/2 top-1 z-10 label-seesaw">
                <div className="rounded-sm bg-[#7FC248] px-4 py-1.5 text-sm font-semibold text-white md:text-base whitespace-nowrap shadow-sm">
                  per 2 cm2
                </div>
              </div>
              <div className="rounded-lg border border-zinc-200 bg-white px-4 pt-8 pb-5 md:px-6 md:pt-10 md:pb-7 shadow-sm transition-shadow hover:shadow-md">
                <p className="font-newsreader text-base font-semibold text-black md:text-lg">
                  Rp 100.000,-
                </p>
              </div>
            </div>
            {/* Per 0,5 m² */}
            <div className="relative pt-4">
              <div className="absolute left-1/2 top-1 z-10 label-seesaw" style={{ animationDelay: '0.3s' }}>
                <div className="rounded-sm bg-[#7FC248] px-4 py-1.5 text-sm font-semibold text-white md:text-base whitespace-nowrap shadow-sm">
                  per 0,5  m2
                </div>
              </div>
              <div className="rounded-lg border border-zinc-200 bg-white px-4 pt-8 pb-5 md:px-6 md:pt-10 md:pb-7 shadow-sm transition-shadow hover:shadow-md">
                <p className="font-newsreader text-base font-semibold text-black md:text-lg">
                  Rp 2.500.000,-
                </p>
              </div>
            </div>
            {/* Per 1 m² */}
            <div className="relative pt-4">
              <div className="absolute left-1/2 top-1 z-10 label-seesaw" style={{ animationDelay: '0.6s' }}>
                <div className="rounded-sm bg-[#7FC248] px-4 py-1.5 text-sm font-semibold text-white md:text-base whitespace-nowrap shadow-sm">
                  per 1 m2
                </div>
              </div>
              <div className="rounded-lg border border-zinc-200 bg-white px-4 pt-8 pb-5 md:px-6 md:pt-10 md:pb-7 shadow-sm transition-shadow hover:shadow-md">
                <p className="font-newsreader text-base font-semibold text-black md:text-lg">
                  Rp 5.000.000,-
                </p>
              </div>
            </div>
          </div>

          {/* Price Cards Row 2 */}
          <div className="mt-10 flex justify-center gap-5 md:gap-8 max-w-2xl mx-auto">
            {/* Per 10 m² */}
            <div className="relative pt-4">
              <div className="absolute left-1/2 top-1 z-10 label-seesaw" style={{ animationDelay: '0.9s' }}>
                <div className="rounded-sm bg-[#7FC248] px-4 py-1.5 text-sm font-semibold text-white md:text-base whitespace-nowrap shadow-sm">
                  per 10  m2
                </div>
              </div>
              <div className="rounded-lg border border-zinc-200 bg-white px-6 pt-8 pb-5 md:px-8 md:pt-10 md:pb-7 shadow-sm transition-shadow hover:shadow-md">
                <p className="font-newsreader text-base font-semibold text-black md:text-lg">
                  Rp 50.000.000
                </p>
              </div>
            </div>
            {/* 1 Ruangan */}
            <div className="relative pt-4">
              <div className="absolute left-1/2 top-1 z-10 label-seesaw" style={{ animationDelay: '1.2s' }}>
                <div className="rounded-sm bg-[#7FC248] px-4 py-1.5 text-sm font-semibold text-white md:text-base whitespace-nowrap shadow-sm">
                  1 ruangan
                </div>
              </div>
              <div className="rounded-lg border border-zinc-200 bg-white px-6 pt-8 pb-5 md:px-8 md:pt-10 md:pb-7 shadow-sm transition-shadow hover:shadow-md">
                <p className="font-newsreader text-base font-semibold text-black md:text-lg">
                  Rp 300.000.000,-
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Video + Info Card */}
        <div className="mt-10 -mx-4">
          <div className="flex flex-col md:flex-row overflow-hidden">
            {/* Video Left */}
            <div className="relative w-full md:w-1/2 aspect-video bg-zinc-200">
              <div className="absolute inset-0 flex items-center justify-center">
                <div className="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-md md:h-20 md:w-20">
                  <svg className="h-8 w-8 text-[#7FC248] ml-1 md:h-10 md:w-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                  </svg>
                </div>
              </div>
            </div>
            {/* Text Right */}
            <div className="w-full md:w-1/2 bg-[#222520] px-6 py-8 md:px-8 md:py-10 flex flex-col justify-center">
              <h3 className="font-newsreader text-lg font-bold text-white md:text-xl">
                Pahala Mengalir meski usia berakhir
              </h3>
              <p className="mt-3 text-sm leading-relaxed text-white/80 md:text-base">
                Salah satu mitra penyaluran Taman Zakat dalam program pendidikan adalah Lembaga Pendidikan
                Islam Annahl Taman – Sidoarjo yang tergolong dalam Cluster Program Taman Cendekia. Beberapa
                turunan aksi program Taman Cendekia yang telah terdistribusi adalah Pembangunan Sekolah
                Penghafal Alquran seluas 2000 m2
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* ==================== COUNTER SECTION ==================== */}
      <section className="w-full bg-[#7FC248] px-4 py-0 md:py-14">
        <div className="mx-auto max-w-3xl text-center" ref={counterRef}>
          <p className="text-white text-base font-newsreader md:text-lg">
            Mari mulai ambil peluang amal berkelanjutan ini
          </p>
          <div className="mt-4 inline-flex items-center justify-center w-40 md:w-48 rounded-md bg-white py-4 md:py-5 shadow-md">
            <span className="text-3xl font-bold text-[#7FC248] md:text-5xl font-newsreader">
              {count.toLocaleString('id-ID')}
            </span>
          </div>
          <p className="mt-4 text-white text-sm font-newsreader md:text-base font-semibold">
            Donatur telah berpartisipasi
          </p>
        </div>
      </section>

      {/* ==================== MADRASAH HAFIDZ SECTION ==================== */}
      <section className="w-full bg-[#FAF7F0] px-4 py-12 md:py-16">
        <div className="mx-auto max-w-5xl">
          <div className="relative flex items-center justify-center min-h-[300px] md:min-h-[400px]">
            {/* Photo - positioned right */}
            <div className="w-[65%] md:w-[60%] ml-auto overflow-hidden rounded-lg shadow-md">
              <Image
                src="/images/gambardetaile/Manfaat Penyaluran.svg"
                alt="Manfaat Penyaluran Taman Zakat"
                width={800}
                height={600}
                className="h-auto w-full object-cover"
              />
            </div>

            {/* Card - overlapping from left */}
            <div className="absolute left-0 top-1/2 -translate-y-1/2 w-[55%] md:w-[45%] z-10">
              <div className="rounded-lg bg-white/85 backdrop-blur-[0.5px] px-6 py-8 md:px-8 md:py-10 shadow-lg">
                <h3 className="font-newsreader text-lg font-bold text-black md:text-xl text-center">
                  Mencetak Hafidz Qur&apos;an hingga Akhir Zaman
                </h3>
                <p className="mt-3 text-sm leading-relaxed text-zinc-600 md:text-base text-center">
                  Membantu meningkatkan kualitas generasi bangsa Indonesia saat di usia emas mereka.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ==================== CTA BERGABUNG ==================== */}
      <section id="donasi" className="w-full">
        {/* Top half - dark */}
        <div className="bg-[#222520] px-4 pt-12 pb-3 md:pt-20 md:pb-5">
          <div className="mx-auto max-w-3xl text-center">
            <h2 className="font-newsreader text-lg font-bold text-white md:text-xl lg:text-3xl leading-snug">
              Mari bergabung dalam kapal kebaikan Taman Zakat
            </h2>
            <p className="mx-auto mt-4 max-w-xl text-sm leading-relaxed text-white/80 md:text-base">
              Lewat program Pembangunan Sekolah Penghafal Alquran, anda membantu ribuan
              santri cilik yang memiliki semangat menghafal alquran untuk meraih masa depan yang
              gemilang
            </p>
          </div>
        </div>

        {/* Brown section with kaabah - covers both card overlap area and bottom */}
        <div className="relative overflow-hidden">
          {/* Kaabah background image with low opacity - covers entire brown area */}
          <div className="absolute inset-0 bg-[#C4A882]">
            <Image
              src="/images/gambardetaile/kakbah 1.svg"
              alt=""
              fill
              className="object-cover opacity-35"
              aria-hidden="true"
            />
          </div>

          {/* Overlapping image card - gradient top half dark, bottom half transparent to show kaabah */}
          <div
            className="relative z-10 px-4 py-0"
            style={{
              background: "linear-gradient(to bottom, #222520 50%, transparent 50%)"
            }}
          >
            <div className="mx-auto max-w-2xl">
              <div className="relative rounded-lg overflow-hidden shadow-2xl">
                <Image
                  src="/images/gambardetaile/Rectangle 113.svg"
                  alt="Sekolah Penghafal Alquran"
                  width={800}
                  height={500}
                  className="w-full h-auto object-cover"
                />
                {/* Donasi Button centered on image */}
                <div className="absolute inset-0 flex items-center justify-center">
                  <div className="relative inline-block">
                    <div
                      aria-hidden
                      className="absolute inset-0 z-20 rounded-sm border-2 border-white border-wiggle"
                    />
                    <a
                      href="#"
                      className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
                    >
                      <div className="relative rounded-sm bg-[#7FC248] px-5 py-2.5 md:px-6 md:py-3">
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
              </div>
            </div>
          </div>

          {/* Extra space below card to show more kaabah */}
          <div className="relative z-0 min-h-[150px] md:min-h-[250px]" />
        </div>
      </section>
    </section>
  );
}
