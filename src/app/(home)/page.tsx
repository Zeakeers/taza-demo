import React from "react";
import Image from "next/image";
import IndonesiaMap from "@/components/ui/indonesia-map";
import HeroSliderHome from "@/components/ui/hero-slider-home";
import BerbagiMengubahKehidupan from "@/components/ui/berbagi-mengubah-kehidupan";
import BeritaTabs from "@/components/ui/berita-tabs";

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
            <h2 className="text-lg sm:text-xl font-bold uppercase tracking-widest text-[#3B7A1C]">ABOUT</h2>
            <h3 className="text-2xl sm:text-3xl font-light mt-2 text-black font-bold"><span className="font-bold text-[#7FC248]">TAMAN ZAKAT</span> INDONESIA</h3>
            <p className="mt-6 text-base sm:text-lg text-black leading-relaxed font-medium">
              Kami Memfasilitasi perkembangan generasi yang penuh berkah dan kami mempunyai mimpi bisa menjadi salah satu tulang punggung gerakan kebaikan ummat.
            </p>
            <button className="mt-6 bg-[#7FC248] text-white px-6 py-2.5 rounded-md font-medium inline-flex items-center justify-center gap-2 hover:bg-[#6eb23a] transition-colors shadow-md">
              Selengkapnya <span className="text-2xl leading-none -mt-1">&rarr;</span>
            </button>
          </div>

          <div className="max-w-4xl mx-auto bg-[#EAFCDC] border border-[#7FC248] rounded-xl p-6 sm:p-8 text-center relative mt-16 shadow-sm">
            {/* logo bulat taza animasi */}
            <div className="absolute -top-8 -left-5 md:-top-10 md:-left-8 z-20 hover:scale-105 transition-transform duration-300">
              <div className="relative h-[65px] w-[65px] md:h-[80px] md:w-[80px]">
                <div aria-hidden className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]" />
                <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#8cc63f]">
                  <svg viewBox="0 0 300 300" aria-hidden className="absolute inset-0 h-full w-full fill-black transform -rotate-12 animate-[spin_15s_linear_infinite]">
                    <defs>
                      <path id="home-kemanusiaan-badge-path" d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224" />
                    </defs>
                    <text fontSize="30" fontWeight="500" className="font-newsreader tracking-wider">
                      <textPath href="#home-kemanusiaan-badge-path" startOffset="50%" textAnchor="middle" textLength="660">
                        Taman Zakat - Indonesia - taza -
                      </textPath>
                    </text>
                  </svg>
                  <div className="relative z-10 flex h-[28px] w-[28px] md:h-[35px] md:w-[35px] items-center justify-center rounded-full border-[2px] border-black bg-[#8cc63f]">
                    <Image src="/images/icon/hitam logo taza 1.svg" alt="Logo Taza" width={24} height={24} className="h-[16px] w-auto md:h-[20px]" />
                  </div>
                </div>
              </div>
            </div>
            <p className="text-base sm:text-lg text-black font-medium leading-relaxed mt-2 sm:mt-0 px-4 pt-2">
              Lembaga Filantropi Profesional dan terpercaya yang berfokus pada Sarana dakwah untuk Pengembangan Alqur'an, Pendidikan, Kesehatan dan Kemanusiaan
            </p>
          </div>
        </section>

        
        {/* Map / Stats Section */}
        <section className="w-full mt-24 relative z-0 pt-16 pb-12 bg-[linear-gradient(180deg,#000000_62%,#ffffff_62%)] sm:bg-[linear-gradient(180deg,#000000_65%,#ffffff_65%)]">
          <div className="max-w-[1000px] mx-auto px-4">
            <h2 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-center mb-4 leading-tight text-white drop-shadow-md">
              Know that your donation is making <br className="hidden sm:block"/> a difference
            </h2>
            <p className="text-center text-sm sm:text-base text-gray-300 mb-12 max-w-4xl mx-auto opacity-90 drop-shadow-md">
              charity: water uses 100% of your donation to fund clean water around the world and then proves every single project you fund, complete with GPS coordinates and photos. Give water. Get proof. Every single time.
            </p>
            
            <div className="border border-gray-600 rounded-lg relative overflow-hidden flex flex-col items-center pt-10 shadow-lg">
                <Image src="/images/icon/logo taza font putih.png" width={240} height={70} className="h-[45px] sm:h-[50px] w-auto drop-shadow" alt="Taman Zakat Logo" />
                <p className="text-center text-[10px] sm:text-xs text-gray-400 mt-2 mb-10 font-medium">Last updated: March 6, 2026</p>

                <div className="grid grid-cols-1 sm:grid-cols-3 text-center w-full max-w-3xl gap-8 sm:gap-0 divide-y sm:divide-y-0 sm:divide-x divide-gray-700 px-4">
                  <div className="pt-4 sm:pt-0">
                    <h3 className="text-2xl sm:text-3xl font-bold text-white mb-2">47</h3>
                    <p className="text-xs sm:text-sm text-gray-400">Wilayah Jangkauan</p>
                  </div>
                  <div className="pt-4 sm:pt-0">
                    <h3 className="text-2xl sm:text-3xl font-bold text-white mb-2">102.088</h3>
                    <p className="text-xs sm:text-sm text-gray-400">Penerima Manfaat</p>
                  </div>
                  <div className="pt-4 sm:pt-0">
                    <h3 className="text-2xl sm:text-3xl font-bold text-white mb-2">19</h3>
                    <p className="text-xs sm:text-sm text-gray-400">Aksi Kebaikan</p>
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
        <section className="bg-[#D3ECC4] border-t border-[#B8DDA1] pt-12 pb-16 w-full mt-10">
          <div className="max-w-6xl mx-auto px-4">
            <h2 className="text-2xl sm:text-3xl font-bold text-black text-center mb-10">
              Artikel <span className="text-[#7FC248] font-light">Taman Zakat</span>
            </h2>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
              {[1, 2].map((card) => (
                <div key={card} className="bg-white p-4 rounded-xl shadow-md flex gap-4 h-[300px]">
                  <div className="w-1/2 h-full bg-[#D9D9D9] rounded-md flex items-center justify-center text-gray-500">
                    Image
                  </div>
                  <div className="w-1/2 flex flex-col pt-2">
                    <span className="text-[10px] text-blue-500 font-medium tracking-widest uppercase mb-1">ARTIKEL</span>
                    <h3 className="text-lg md:text-xl font-bold leading-snug mb-2 text-black">Daging Kurban Boleh Dicuci? Baca Dulu Dulu</h3>
                    <p className="text-xs text-gray-400 mb-4 inline-flex items-center gap-1">
                      <span className="w-2.5 h-2.5 rounded-full bg-gray-300 inline-block"></span>
                      13 Jul 2024
                    </p>
                    <p className="text-xs text-black leading-relaxed line-clamp-6 font-medium">
                      Bolehkah daging kurban dicuci sebelum dimasak? Simak penjelasannya lebih lengkap di sini. Daging kurban merupakan salah satu momen istimewa yang paling ditunggu-tunggu setiap setahun sekali. Bagi umat muslim...
                    </p>
                  </div>
                </div>
              ))}
            </div>

            {/* Pagination Dots */}
            <div className="flex justify-center gap-3">
              <span className="w-2.5 h-2.5 rounded-full bg-white cursor-pointer hover:bg-gray-400 transition-colors"></span>
              <span className="w-2.5 h-2.5 rounded-full bg-gray-600 shadow-sm cursor-pointer border border-gray-400"></span>
              <span className="w-2.5 h-2.5 rounded-full bg-white cursor-pointer hover:bg-gray-400 transition-colors"></span>
            </div>
          </div>
        </section>

        {/* Change The World Bottom Section */}
        <section className="bg-[#FAEED3] w-full py-16 text-center shadow-inner">
          <p className="text-[#A2BAF5] text-xs sm:text-sm tracking-[0.3em] font-bold mb-3 uppercase">OPPORTUNITIES</p>
          <h2 className="text-3xl font-bold mb-4 text-black">Change the world with us</h2>
          <p className="text-sm font-medium text-black mb-6">we've been opening at the position under</p>
          <button className="text-xs font-bold text-black border-b-2 border-black pb-1 hover:text-[#7FC248] hover:border-[#7FC248] transition-colors">
            SEE ALL OUR AVAILABLE ROLE
          </button>
        </section>

      </main>
    </section>
  );
}
