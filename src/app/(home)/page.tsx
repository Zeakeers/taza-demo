import React from "react";
import Image from "next/image";
import IndonesiaMap from "@/components/ui/indonesia-map";
import HeroSliderHome from "@/components/ui/hero-slider-home";
import BerbagiMengubahKehidupan from "@/components/ui/berbagi-mengubah-kehidupan";
import BeritaTabs from "@/components/ui/berita-tabs";
import ArtikelSlider from "@/components/ui/artikel-slider";

export default function Home() {
  return (
    <section className="w-full min-h-screen flex flex-col bg-white overflow-x-hidden">
      {/* Header */}
      <header>
        <HeroSliderHome />
      </header>

      <main>
        {/* slider hero */}
        <BerbagiMengubahKehidupan />

        {/* Tentang Kami / About */}
        <section className="mt-20 px-4">
          <div className="text-center max-w-3xl mx-auto">
            <h2 className="text-lg sm:text-xl font-bold uppercase tracking-widest text-[#3B7A1C]">
              TENTANG KAMI
            </h2>
            <h3 className="text-2xl sm:text-3xl font-light mt-2 text-black font-bold">
              <span className="font-bold text-[#7FC248]">TAMAN ZAKAT</span>{" "}
              INDONESIA
            </h3>
            <p className="mt-6 text-base sm:text-lg text-black leading-relaxed font-medium">
              Kami Memfasilitasi perkembangan generasi yang penuh berkah dan
              kami mempunyai mimpi bisa menjadi salah satu tulang punggung
              gerakan kebaikan ummat.
            </p>
            <button className="mt-6 bg-[#7FC248] text-white px-6 py-2.5 rounded-md font-medium inline-flex items-center justify-center gap-2 hover:bg-[#6eb23a] transition-colors shadow-md">
              Selengkapnya{" "}
              <span className="text-2xl leading-none -mt-1">&rarr;</span>
            </button>
          </div>

          <div className="max-w-4xl mx-auto bg-[#EAFCDC] border border-[#7FC248] rounded-xl p-6 sm:p-8 text-center relative mt-16 shadow-sm">
            
            <p className="text-base sm:text-lg text-black font-medium leading-relaxed mt-2 sm:mt-0 px-4 pt-2">
              Lembaga Filantropi Profesional dan terpercaya yang berfokus pada
              Sarana dakwah untuk Pengembangan Alqur&apos;an, Pendidikan,
              Kesehatan dan Kemanusiaan
            </p>
          </div>
        </section>

        {/* Map / Stats Section */}
        <section className="w-full mt-24 relative z-0 pt-16 pb-12 bg-[#0D2B05] sm:bg-[linear-gradient(180deg,#0D2B05_65%,#ffffff_65%)]">
          <div className="max-w-[1000px] mx-auto px-4">
            <h2 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-center mb-4 leading-tight text-white drop-shadow-md">
              Setiap Zakat Anda Mengalirkan <br className="hidden sm:block" />{" "}
              Keberkahan untuk Sesama
            </h2>
            <p className="text-center text-sm sm:text-base text-gray-300 mb-12 max-w-4xl mx-auto opacity-90 drop-shadow-md">
              Taman Zakat memastikan setiap titipan kebaikan Anda tersalurkan
              secara tepat sasaran kepada mereka yang membutuhkan di berbagai
              wilayah Indonesia melalui program-program yang akuntabel dan
              transparan.
            </p>

            <div className="border border-gray-600 rounded-lg relative overflow-hidden flex flex-col items-center pt-10 shadow-lg">
              <Image
                src="/images/icon/logo taza font putih.png"
                width={240}
                height={70}
                className="h-[45px] sm:h-[50px] w-auto drop-shadow"
                alt="Taman Zakat Logo"
              />
              <p className="text-center text-[10px] sm:text-xs text-gray-400 mt-2 mb-10 font-medium">
                Last updated: March 6, 2026
              </p>

              <div className="grid grid-cols-1 sm:grid-cols-3 text-center w-full max-w-3xl gap-8 sm:gap-0 divide-y sm:divide-y-0 sm:divide-x divide-gray-700 px-4">
                <div className="pt-4 sm:pt-0">
                  <h3 className="text-2xl sm:text-3xl font-bold text-white mb-2">
                    47
                  </h3>
                  <p className="text-xs sm:text-sm text-gray-400">
                    Wilayah Jangkauan
                  </p>
                </div>
                <div className="pt-4 sm:pt-0">
                  <h3 className="text-2xl sm:text-3xl font-bold text-white mb-2">
                    102.088
                  </h3>
                  <p className="text-xs sm:text-sm text-gray-400">
                    Penerima Manfaat
                  </p>
                </div>
                <div className="pt-4 sm:pt-0">
                  <h3 className="text-2xl sm:text-3xl font-bold text-white mb-2">
                    19
                  </h3>
                  <p className="text-xs sm:text-sm text-gray-400">
                    Aksi Kebaikan
                  </p>
                </div>
              </div>

              <div className="w-[95%] md:w-[90%] mt-8 pb-6 relative z-20">
                <IndonesiaMap />
              </div>
            </div>
          </div>
        </section>

        {/* Section Berita Interactive */}
        <BeritaTabs />

        {/* Section Artikel (Green BG) */}
        <section className="bg-[#7fc248] border-t border-[#B8DDA1] pt-12 pb-16 w-full mt-10">
          <div className="max-w-6xl mx-auto px-4">
            <h2 className="text-2xl sm:text-3xl font-bold text-black text-center mb-10">
              Artikel{" "}
              <span className="text-white font-medium">Taman Zakat</span>
            </h2>
          </div>

          <ArtikelSlider />
        </section>

        {/* Change The World Bottom Section */}
        <section className="bg-[#FAEED3] w-full py-16 text-center shadow-inner">
          <p className="text-[#A2BAF5] text-xs sm:text-sm tracking-[0.3em] font-bold mb-3 uppercase">
            PELUANG KEBAIKAN
          </p>
          <h2 className="text-3xl font-bold mb-4 text-black">
            Bergabunglah Bersama Kami
          </h2>
          <p className="text-sm font-medium text-black mb-6">
            Mari menjadi bagian dari gerakan kebaikan untuk perubahan yang lebih
            baik bagi ummat.
          </p>
          <button className="text-xs font-bold text-black border-b-2 border-black pb-1 hover:text-[#7FC248] hover:border-[#7FC248] transition-colors">
            LIHAT SEMUA PELUANG
          </button>
        </section>
      </main>
    </section>
  );
}
