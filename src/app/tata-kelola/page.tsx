"use client";

import Link from "next/link";
import Image from "next/image";
import { useEffect, useState } from "react";

export default function TataKelolaPage() {
  const [activeSection, setActiveSection] = useState("legal-formal");

  useEffect(() => {
    document.title = "Tata Kelola - Taman Zakat";

    const handleScroll = () => {
      const sections = ["legal-formal", "hasil-audit", "laporan-publikasi"];
      let current = sections[0];

      for (const id of sections) {
        const element = document.getElementById(id);
        if (element) {
          const rect = element.getBoundingClientRect();
          if (rect.top <= 300) {
            current = id;
          }
        }
      }
      setActiveSection(current);
    };

    window.addEventListener("scroll", handleScroll);
    handleScroll();

    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
      const offset = 120; 
      const bodyRect = document.body.getBoundingClientRect().top;
      const elementRect = element.getBoundingClientRect().top;
      const elementPosition = elementRect - bodyRect;
      const offsetPosition = elementPosition - offset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
      });
    }
  };

  return (
    <div className="bg-white text-zinc-800 min-h-screen">
      <div className="mx-auto max-w-[1280px] px-4 md:px-8 lg:px-12 py-10 md:py-16 flex relative">
        
        {/* Sidebar Nav (Sticky) */}
        <div className="hidden md:block w-36 relative shrink-0">
          <div className="sticky top-32 h-[80vh]">
            {/* Garis Vertikal */}
            <div className="absolute right-[6px] top-6 bottom-0 w-[2px] bg-[#191919] z-0"></div>
            
            <div className="flex flex-col gap-24 relative z-10 pt-4">
              
              {/* Item 1 */}
              <div onClick={() => scrollToSection("legal-formal")} className="flex flex-col items-end justify-center cursor-pointer group relative w-full pr-6">
                {activeSection === "legal-formal" ? (
                  <div className="w-[14px] h-[14px] rounded-full bg-[#5DA630] absolute right-0 top-1/2 -translate-y-1/2 z-20"></div>
                ) : (
                  <div className="w-[12px] h-[12px] rounded-full border-[2px] border-[#5DA630] bg-white absolute right-[1px] top-1/2 -translate-y-1/2 z-20 transition-colors group-hover:bg-zinc-100"></div>
                )}
                <span className={`text-[14px] border rounded-lg px-3 py-1 bg-white relative z-10 transition-all duration-300 ${activeSection === "legal-formal" ? 'border-[2px] border-[#5DA630] text-[#5DA630] font-semibold' : 'border border-[#5DA630]/50 text-zinc-500 group-hover:border-[#5DA630] group-hover:text-[#5DA630]'}`}>
                  Legal Formal
                </span>
              </div>

              {/* Item 2 */}
              <div onClick={() => scrollToSection("hasil-audit")} className="flex flex-col items-end justify-center cursor-pointer group relative w-full pr-6">
                {activeSection === "hasil-audit" ? (
                  <div className="w-[14px] h-[14px] rounded-full bg-[#5DA630] absolute right-0 top-1/2 -translate-y-1/2 z-20"></div>
                ) : (
                  <div className="w-[12px] h-[12px] rounded-full border-[2px] border-[#5DA630] bg-white absolute right-[1px] top-1/2 -translate-y-1/2 z-20 transition-colors group-hover:bg-zinc-100"></div>
                )}
                <span className={`text-[14px] border rounded-lg px-3 py-1 bg-white relative z-10 transition-all duration-300 ${activeSection === "hasil-audit" ? 'border-[2px] border-[#5DA630] text-[#5DA630] font-semibold' : 'border border-[#5DA630]/50 text-zinc-500 group-hover:border-[#5DA630] group-hover:text-[#5DA630]'}`}>
                  Hasil Audit
                </span>
              </div>

              {/* Item 3 */}
              <div onClick={() => scrollToSection("laporan-publikasi")} className="flex flex-col items-end justify-center cursor-pointer group relative w-full pr-6">
                {activeSection === "laporan-publikasi" ? (
                  <div className="w-[14px] h-[14px] rounded-full bg-[#5DA630] absolute right-0 top-1/2 -translate-y-1/2 z-20"></div>
                ) : (
                  <div className="w-[12px] h-[12px] rounded-full border-[2px] border-[#5DA630] bg-white absolute right-[1px] top-1/2 -translate-y-1/2 z-20 transition-colors group-hover:bg-zinc-100"></div>
                )}
                <span className={`text-[14px] border rounded-lg px-3 py-1 bg-white text-center leading-tight max-w-[95px] w-full flex justify-center relative z-10 transition-all duration-300 ${activeSection === "laporan-publikasi" ? 'border-[2px] border-[#5DA630] text-[#5DA630] font-semibold' : 'border border-[#5DA630]/50 text-zinc-500 group-hover:border-[#5DA630] group-hover:text-[#5DA630]'}`}>
                  Laporan Dan Publikasi
                </span>
              </div>
              
            </div>
          </div>
        </div>

        {/* Main Content */}
        <div className="flex-1 lg:pl-16">
          
          {/* Header Box */}
          <div className="border border-zinc-400 bg-zinc-50/50 p-6 md:p-8 rounded-sm mb-16 text-[15px] md:text-base leading-relaxed text-zinc-800 font-medium">
            <p className="max-w-4xl text-justify">
              Taman Zakat adalah lembaga Amil Zakat (LAZ) yang telah memiliki legalitas resmi dan diakui oleh berbagai pihak berwenang, baik di tingkat daerah maupun nasional. Legalitas tersebut menjadi bukti komitmen kami dalam mengelola dana zakat, infaq, dan shodaqoh secara profesional, amanah dan sesuai ketentuan perundang-undangan yang berlaku.
            </p>
          </div>

          {/* Section: Legal Formal */}
          <section id="legal-formal" className="mb-24 scroll-mt-32">
            <h2 className="border border-zinc-400 inline-block px-4 py-1.5 font-bold text-lg md:text-xl mb-12 rounded-sm text-zinc-900 bg-white">
              Legal Formal
            </h2>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-6 justify-items-center">
              
              {/* Card 1 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col text-center px-8 pt-6 pb-4 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-lg mb-2 leading-tight mt-12">Akta Pendiri Yayasan</h3>
                  <div className="text-[32px] font-light text-black my-2">34</div>
                  <p className="text-sm text-black mb-1 text-left ml-6">Notaris :</p>
                  <div className="inline-block mx-auto">
                    <p className="text-[15px] text-black font-semibold border-b-[3px] border-[#5DA630] pb-0.5 inline-block">Wahyu Hidayat, SH., M.Kn</p>
                  </div>
                  
                  <div className="absolute bottom-10 right-8 bg-[#A52A2A] text-white text-[11px] px-3 py-1 font-medium rounded-sm">
                    29 Desember 2018
                  </div>
                </div>
              </div>

              {/* Card 2 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col items-center px-6 pt-6 pb-4 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-[17px] mb-6 leading-tight mt-12 text-center">S.K Kemenkum &<br/>KemenHAM</h3>
                  
                  <div className="w-full flex justify-center mb-1">
                    <div className="bg-[#A52A2A] text-white text-[10px] px-3 py-1 rounded-sm w-[90%] font-medium">
                      AHU-0000016.AH.01.04.Tahun 2019
                    </div>
                  </div>
                  <div className="w-full flex justify-end pr-[5%] mb-5 mt-1">
                    <div className="border border-zinc-500 text-[10px] px-4 py-0.5 rounded-full font-medium">
                      Pengesahan Pendirian
                    </div>
                  </div>

                  <div className="w-full flex justify-center mb-1">
                    <div className="bg-[#A52A2A] text-white text-[10px] px-3 py-1 rounded-sm w-[90%] font-medium">
                      AHU-AH.01.06.0008536.Tahun 2021
                    </div>
                  </div>
                  <div className="w-full flex justify-end pr-[5%] mt-1">
                    <div className="border border-zinc-500 text-[10px] px-4 py-0.5 rounded-full font-medium">
                      Perubahan data yayasan
                    </div>
                  </div>
                </div>
              </div>

              {/* Card 3 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col items-center pt-8 px-6 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-lg mb-8 leading-tight mt-12 text-center">Nomor Pokok<br/>Wajib Pajak</h3>
                  <div className="bg-[#A52A2A] text-white text-[13px] px-4 py-1.5 font-semibold mb-4 rounded-sm tracking-wide">
                    90.042.146.2-603.000
                  </div>
                  <div className="border border-zinc-500 text-xs px-5 py-1 rounded-sm font-medium">
                    NPWP
                  </div>
                </div>
              </div>

              {/* Card 4 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col items-center pt-8 px-6 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-[17px] mb-8 leading-tight mt-12 text-center">Izin Lembaga<br/>Kesejahteraan Sosial</h3>
                  <div className="bg-[#A52A2A] text-white text-[13px] px-4 py-1.5 rounded-sm mb-4 font-medium tracking-wide">
                    466.4/2149/438.5.6/2019
                  </div>
                  <div className="border border-zinc-800 text-xs px-3 py-1 rounded-md font-medium text-black">
                    Dinas Sosial Kabupaten
                  </div>
                </div>
              </div>

              {/* Card 5 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col items-center px-6 pt-6 pb-4 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-lg mb-6 leading-tight mt-12 text-center">Keanggotaan Resmi<br/>Forum Zakat</h3>
                  
                  <div className="w-full flex justify-center mb-1">
                    <div className="bg-[#A52A2A] text-white text-[12px] px-4 py-1 rounded-sm font-medium">
                      130/SK/PH-FOZ/X/2019
                    </div>
                  </div>
                  <div className="w-full flex justify-end pr-[15%] mb-5 mt-1">
                    <div className="border border-zinc-600 text-[10px] px-3 py-0.5 rounded-full font-medium">
                      S. K
                    </div>
                  </div>

                  <div className="w-full flex justify-center mb-1 ml-[-20px]">
                    <div className="bg-[#A52A2A] text-white text-[12px] px-5 py-1 rounded-sm font-medium">
                      130.FOZ.2019
                    </div>
                  </div>
                  <div className="w-full flex justify-end pr-[15%] mt-1">
                    <div className="border border-zinc-600 text-[10px] px-3 py-0.5 rounded-full font-medium">
                      Nomor Anggota
                    </div>
                  </div>

                  <div className="absolute bottom-8 left-10">
                    <Image src="/images/icon/Forum Zakat.svg" alt="Forum Zakat" width={60} height={30} className="object-contain" />
                  </div>
                </div>
              </div>

              {/* Card 6 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col items-center px-6 pt-6 pb-4 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-[15.5px] mb-6 leading-tight mt-12 text-center">Rekomendasi LAZ<br/>Tingkat Provinsi dari<br/>BAZNAS</h3>
                  
                  <div className="w-full flex justify-center mb-1">
                    <div className="bg-[#A52A2A] text-white text-[11px] px-3 py-1.5 rounded-sm font-medium">
                      617/ANG/BAZNAS/XI/2020
                    </div>
                  </div>
                  <div className="w-full flex justify-end pr-[12%] mt-1">
                    <div className="border border-zinc-600 text-[10px] px-2 py-0.5 rounded-sm font-medium">
                      Nomor Surat
                    </div>
                  </div>

                  <div className="absolute bottom-8 left-10">
                    <Image src="/images/icon/Logo BAZNAS RI-Hijau-01 2.svg" alt="BAZNAS" width={55} height={55} className="object-contain" />
                  </div>
                </div>
              </div>

              {/* Card 7 */}
              <div className="relative w-[280px] h-[340px] flex flex-col justify-center lg:col-start-2">
                <Image src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg" alt="Paper note" fill className="object-cover z-0" />
                <div className="relative z-10 flex flex-col items-center px-6 pt-6 pb-4 w-full h-full">
                  <h3 className="font-semibold text-zinc-900 text-[17px] mb-8 leading-tight mt-12 text-center">S. K Dirjen Bimas<br/>Islam Kementerian<br/>Agama RI</h3>
                  
                  <div className="bg-[#A52A2A] text-white text-sm px-5 py-1.5 font-bold mb-5 rounded-sm">
                    245 Tahun 2021
                  </div>
                  
                  <div className="border border-zinc-600 text-[10px] px-3 py-2 rounded-sm text-center leading-relaxed font-medium text-black">
                    Pemberian Izin kepada Yayasan Taman<br/>Zakat Indonesia sebagai Lembaga<br/>Amil Zakat Skala Provinsi.
                  </div>
                </div>
              </div>

            </div>
          </section>

          {/* Section: Hasil Audit */}
          <section id="hasil-audit" className="mb-24 pt-8 scroll-mt-32">
            <div className="flex items-center gap-4 w-full">
              <h2 className="font-bold text-xl md:text-2xl text-zinc-900 whitespace-nowrap">
                Hasil<br />Audit
              </h2>
              <div className="h-[2px] bg-zinc-400 mt-4 flex-1"></div>
            </div>
            <div className="min-h-[100px]"></div>
          </section>

          {/* Section: Laporan Dan Publikasi */}
          <section id="laporan-publikasi" className="mb-16 pt-8 scroll-mt-32">
            <div className="flex items-center gap-4 w-full mb-16">
              <h2 className="font-bold text-xl md:text-2xl text-zinc-900 whitespace-nowrap">
                Laporan Dan<br />Publikasi
              </h2>
              <div className="h-[2px] bg-zinc-900 mt-4 flex-1"></div>
            </div>

            {/* Alternating Layout */}
            <div className="flex flex-col gap-32 relative pb-20 overflow-hidden px-4 md:px-0">
              
              {/* Block 1 */}
              <div className="flex flex-col lg:flex-row items-center justify-between min-h-[300px] gap-8 lg:gap-0">
                
                {/* Visual Block - Left */}
                <div className="relative w-full lg:w-1/2 h-[300px] md:h-[400px]">
                  {/* Absolute positioning of rectangles according to design */}
                  {/* Light green block behind */}
                  <div className="absolute top-20 -left-4 md:-left-10 lg:-left-20 w-24 md:w-32 lg:w-[220px] h-[300px] md:h-[400px] bg-[#E3F2D4] z-0"></div>
                  
                  {/* Square gray left */}
                  <div className="absolute top-40 left-10 md:left-20 lg:left-12 w-32 md:w-56 h-32 md:h-48 bg-[#D9D9D9] z-10 shadow-sm"></div>
                  
                  {/* Big Black Square center */}
                  <div className="absolute top-16 left-36 md:left-56 lg:left-40 w-44 md:w-60 h-44 md:h-60 bg-black z-20 shadow-md"></div>
                  
                  {/* Dark gray rectangle right bottom */}
                  <div className="absolute top-52 md:top-64 left-52 md:left-80 lg:left-64 w-28 md:w-40 h-28 md:h-40 bg-[#888484] z-30 shadow-sm"></div>
                </div>

                {/* Text Block - Right */}
                <div className="w-full lg:w-1/2 flex flex-col justify-center items-start pl-0 lg:pl-[10%] z-40 relative">
                  <h3 className="text-xl md:text-2xl lg:text-3xl font-bold text-black mb-3">
                    We are advancing<br/>equality
                  </h3>
                  <p className="text-sm md:text-base text-zinc-600 mb-6 max-w-sm">
                    We believe in the inherent dignity of all people and that inequality is the defining challenge of our time.
                  </p>
                  <button className="border border-black rounded-full px-5 py-1.5 text-sm md:text-base font-semibold hover:bg-black hover:text-white transition-colors group flex items-center gap-2">
                    Annual Report
                    <span className="hidden group-hover:inline">→</span>
                  </button>
                </div>
              </div>

              {/* Block 2 */}
              <div className="flex flex-col-reverse lg:flex-row items-center justify-between min-h-[300px] gap-8 lg:gap-0 mt-8 md:mt-24">
                
                {/* Text Block - Left */}
                <div className="w-full lg:w-1/2 flex flex-col justify-center items-start lg:items-end text-left lg:text-left pr-0 lg:pr-[10%] z-40 relative mt-16 md:mt-0">
                  <div className="lg:max-w-sm">
                    <h3 className="text-xl md:text-2xl lg:text-3xl font-bold text-black mb-3">
                      We are advancing<br/>equality
                    </h3>
                    <p className="text-sm md:text-base text-zinc-600 mb-6">
                      We believe in the inherent dignity of all people and that inequality is the defining challenge of our time.
                    </p>
                    <div className="flex w-full">
                      <button className="border border-black rounded-full px-5 py-1.5 text-sm md:text-base font-semibold hover:bg-black hover:text-white transition-colors group flex items-center gap-2">
                        Annual Report
                        <span className="hidden group-hover:inline">→</span>
                      </button>
                    </div>
                  </div>
                </div>

                {/* Visual Block - Right */}
                <div className="relative w-full lg:w-1/2 h-[300px] md:h-[400px]">
                  {/* Absolute positioning of rectangles according to design */}
                  {/* Light beige block behind */}
                  <div className="absolute top-10 -right-4 md:-right-10 lg:-right-0 w-24 md:w-32 lg:w-[150px] h-[300px] md:h-[400px] bg-[#FAF1E3] z-0"></div>
                  
                  {/* Square gray left bottom */}
                  <div className="absolute top-36 left-10 md:left-24 lg:left-12 w-40 md:w-56 h-32 md:h-48 bg-[#D9D9D9] z-10 shadow-sm"></div>
                  
                  {/* Big Black Square center */}
                  <div className="absolute top-16 left-32 md:left-56 lg:left-40 w-40 md:w-56 h-40 md:h-56 bg-black z-20 shadow-md"></div>
                  
                  {/* Light gray rectangle right bottom */}
                  <div className="absolute top-48 md:top-64 left-44 md:left-80 lg:left-64 w-32 md:w-44 h-32 md:h-44 bg-[#E0E0E0] z-30 shadow-sm"></div>
                </div>
              </div>

            </div>
          </section>

        </div>
      </div>
    </div>
  );
}
