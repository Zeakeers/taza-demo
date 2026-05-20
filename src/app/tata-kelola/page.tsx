"use client";

import RightBarAudit from "@/components/layout/rightbar-audit";
import Link from "next/link";
import Image from "next/image";
import { useEffect, useState } from "react";

export default function TataKelolaPage() {
  const [activeSection, setActiveSection] = useState("laporan-publikasi");
  const [annualReports, setAnnualReports] = useState<any[]>([]);
  const [legalFormals, setLegalFormals] = useState<any[]>([]);

  useEffect(() => {
    document.title = "Tata Kelola - Taman Zakat";

    const fetchData = async () => {
      try {
        const url = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`;
        const resAnnual = await fetch(`${url}/tata-kelola/annual-report`);
        if (resAnnual.ok) setAnnualReports(await resAnnual.json());

        const resLegal = await fetch(`${url}/tata-kelola/legal-formal`);
        if (resLegal.ok) setLegalFormals(await resLegal.json());
      } catch (err) {
        console.error("Failed to fetch tata kelola data", err);
      }
    };
    fetchData();

    const handleScroll = () => {
      const sections = ["laporan-publikasi", "hasil-audit", "legal-formal"];
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
        behavior: "smooth",
      });
    }
  };

  return (
    <div className="bg-white text-zinc-800 min-h-screen font-poppins">
      <div className="mx-auto max-w-[1280px] px-4 md:px-8 lg:px-12 py-10 md:py-16 flex relative">
        <div className="hidden md:block w-36 relative shrink-0">
          <div className="sticky top-32 h-[80vh]">
            <div className="absolute right-[6px] top-6 bottom-0 w-[2px] bg-[#191919] z-0"></div>

            <div className="flex flex-col gap-24 relative z-10 pt-4">
              <div
                onClick={() => scrollToSection("laporan-publikasi")}
                className="flex flex-col items-end justify-center cursor-pointer group relative w-full pr-6"
              >
                {activeSection === "laporan-publikasi" ? (
                  <div className="w-[14px] h-[14px] rounded-full bg-[#5DA630] absolute right-0 top-1/2 -translate-y-1/2 z-20"></div>
                ) : (
                  <div className="w-[12px] h-[12px] rounded-full border-[2px] border-[#5DA630] bg-white absolute right-[1px] top-1/2 -translate-y-1/2 z-20 transition-colors group-hover:bg-zinc-100"></div>
                )}
                <span
                  className={`text-[14px] border rounded-lg px-3 py-1 bg-white text-center leading-tight max-w-[95px] w-full flex justify-center relative z-10 transition-all duration-300 ${activeSection === "laporan-publikasi" ? "border-[2px] border-[#5DA630] text-[#5DA630] font-semibold" : "border border-[#5DA630]/50 text-zinc-500 group-hover:border-[#5DA630] group-hover:text-[#5DA630]"}`}
                >
                  Laporan Dan Publikasi
                </span>
              </div>

              <div
                onClick={() => scrollToSection("hasil-audit")}
                className="flex flex-col items-end justify-center cursor-pointer group relative w-full pr-6"
              >
                {activeSection === "hasil-audit" ? (
                  <div className="w-[14px] h-[14px] rounded-full bg-[#5DA630] absolute right-0 top-1/2 -translate-y-1/2 z-20"></div>
                ) : (
                  <div className="w-[12px] h-[12px] rounded-full border-[2px] border-[#5DA630] bg-white absolute right-[1px] top-1/2 -translate-y-1/2 z-20 transition-colors group-hover:bg-zinc-100"></div>
                )}
                <span
                  className={`text-[14px] border rounded-lg px-3 py-1 bg-white relative z-10 transition-all duration-300 ${activeSection === "hasil-audit" ? "border-[2px] border-[#5DA630] text-[#5DA630] font-semibold" : "border border-[#5DA630]/50 text-zinc-500 group-hover:border-[#5DA630] group-hover:text-[#5DA630]"}`}
                >
                  Hasil Audit
                </span>
              </div>

              <div
                onClick={() => scrollToSection("legal-formal")}
                className="flex flex-col items-end justify-center cursor-pointer group relative w-full pr-6"
              >
                {activeSection === "legal-formal" ? (
                  <div className="w-[14px] h-[14px] rounded-full bg-[#5DA630] absolute right-0 top-1/2 -translate-y-1/2 z-20"></div>
                ) : (
                  <div className="w-[12px] h-[12px] rounded-full border-[2px] border-[#5DA630] bg-white absolute right-[1px] top-1/2 -translate-y-1/2 z-20 transition-colors group-hover:bg-zinc-100"></div>
                )}
                <span
                  className={`text-[14px] border rounded-lg px-3 py-1 bg-white relative z-10 transition-all duration-300 ${activeSection === "legal-formal" ? "border-[2px] border-[#5DA630] text-[#5DA630] font-semibold" : "border border-[#5DA630]/50 text-zinc-500 group-hover:border-[#5DA630] group-hover:text-[#5DA630]"}`}
                >
                  Legal Formal
                </span>
              </div>
            </div>
          </div>
        </div>

        <div className="flex-1 lg:pl-16">
          <div className="border border-zinc-400 bg-zinc-50/50 p-6 md:p-8 rounded-sm mb-16 text-[15px] md:text-base leading-relaxed text-zinc-800 font-medium">
            <p className="max-w-4xl text-justify">
              Taman Zakat adalah lembaga Amil Zakat (LAZ) yang telah memiliki
              legalitas resmi dan diakui oleh berbagai pihak berwenang, baik di
              tingkat daerah maupun nasional. Legalitas tersebut menjadi bukti
              komitmen kami dalam mengelola dana zakat, infaq, dan shodaqoh
              secara profesional, amanah dan sesuai ketentuan perundang-undangan
              yang berlaku.
            </p>
          </div>

          <section id="laporan-publikasi" className="mb-16 pt-8 scroll-mt-32">
            <div className="flex items-center gap-4 w-full mb-16">
              <h2 className="font-bold text-xl md:text-2xl text-zinc-900 whitespace-nowrap">
                Laporan Dan
                <br />
                Publikasi
              </h2>
              <div className="h-[2px] bg-zinc-900 mt-4 flex-1"></div>
            </div>

            <div className="flex flex-col gap-32 relative pb-20 overflow-hidden px-4 md:px-0">
              {annualReports.map((report, index) => {
                const isEven = index % 2 === 0;
                
                return (
                  <div key={report.id} className={`flex flex-col ${isEven ? 'lg:flex-row' : 'flex-col-reverse lg:flex-row'} items-center justify-between min-h-[300px] gap-8 lg:gap-0 mt-8 md:mt-24`}>
                    
                    {!isEven && (
                      <div className="w-full lg:w-1/2 flex flex-col justify-center items-start lg:items-end text-left lg:text-left pr-0 lg:pr-[10%] z-40 relative mt-16 md:mt-0">
                        <div className="lg:max-w-sm">
                          <h3 className="text-xl md:text-2xl lg:text-3xl font-bold text-black mb-3">
                            {report.title}
                            <br />
                            {report.year}
                          </h3>
                          <p className="text-sm md:text-base text-zinc-600 mb-6 whitespace-pre-wrap">
                            {report.description}
                          </p>
                          <div className="flex w-full">
                            {report.file_url ? (
                              <a href={report.file_url} target="_blank" rel="noopener noreferrer" className="border border-black rounded-full px-5 py-1.5 text-sm md:text-base font-semibold hover:bg-black hover:text-white transition-colors group flex items-center gap-2">
                                Annual Report
                                <span className="hidden group-hover:inline">→</span>
                              </a>
                            ) : (
                              <button className="border border-black rounded-full px-5 py-1.5 text-sm md:text-base font-semibold hover:bg-black hover:text-white transition-colors group flex items-center gap-2">
                                Annual Report
                                <span className="hidden group-hover:inline">→</span>
                              </button>
                            )}
                          </div>
                        </div>
                      </div>
                    )}

                    <div className="relative w-full lg:w-1/2 h-[300px] md:h-[400px]">
                      <div className={`absolute ${isEven ? 'top-20 -left-4 md:-left-10 lg:-left-20 w-24 md:w-32 lg:w-[220px] bg-[#E3F2D4]' : 'top-10 -right-4 md:-right-10 lg:-right-0 w-24 md:w-32 lg:w-[150px] bg-[#FAF1E3]'} h-[300px] md:h-[400px] z-0`}></div>
                      
                      <div className={`absolute top-40 ${isEven ? 'left-10 md:left-20 lg:left-12' : 'left-10 md:left-24 lg:left-12'} w-32 md:w-56 h-32 md:h-48 z-10 shadow-sm overflow-hidden`}>
                        <img src={report.image_url || "https://picsum.photos/seed/laporan1/400/300"} alt="Laporan" className="w-full h-full object-cover" />
                      </div>
                      <div className={`absolute top-16 ${isEven ? 'left-36 md:left-56 lg:left-40' : 'left-32 md:left-56 lg:left-40'} w-44 md:w-60 h-44 md:h-60 z-20 shadow-md overflow-hidden`}>
                        <img src={report.image2_url || "https://picsum.photos/seed/laporan2/400/400"} alt="Laporan" className="w-full h-full object-cover" />
                      </div>
                      <div className={`absolute ${isEven ? 'top-52 md:top-64 left-52 md:left-80 lg:left-64 w-28 md:w-40 h-28 md:h-40' : 'top-48 md:top-64 left-44 md:left-80 lg:left-64 w-32 md:w-44 h-32 md:h-44'} z-30 shadow-sm overflow-hidden`}>
                        <img src={report.image3_url || "https://picsum.photos/seed/laporan3/300/300"} alt="Laporan" className="w-full h-full object-cover" />
                      </div>
                    </div>

                    {isEven && (
                      <div className="w-full lg:w-1/2 flex flex-col justify-center items-start pl-0 lg:pl-[10%] z-40 relative">
                        <h3 className="text-xl md:text-2xl lg:text-3xl font-bold text-black mb-3">
                          {report.title}
                          <br />
                          {report.year}
                        </h3>
                        <p className="text-sm md:text-base text-zinc-600 mb-6 max-w-sm whitespace-pre-wrap">
                          {report.description}
                        </p>
                        {report.file_url ? (
                          <a href={report.file_url} target="_blank" rel="noopener noreferrer" className="border border-black rounded-full px-5 py-1.5 text-sm md:text-base font-semibold hover:bg-black hover:text-white transition-colors group flex items-center gap-2">
                            Annual Report
                            <span className="hidden group-hover:inline">→</span>
                          </a>
                        ) : (
                          <button className="border border-black rounded-full px-5 py-1.5 text-sm md:text-base font-semibold hover:bg-black hover:text-white transition-colors group flex items-center gap-2">
                            Annual Report
                            <span className="hidden group-hover:inline">→</span>
                          </button>
                        )}
                      </div>
                    )}
                  </div>
                );
              })}
            </div>
          </section>

          <section id="hasil-audit" className="mb-24 pt-8 scroll-mt-32">
            <div className="flex items-center gap-4 w-full">
              <h2 className="font-bold text-xl md:text-2xl text-zinc-900 whitespace-nowrap">
                Hasil
                <br />
                Audit
              </h2>
              <div className="h-[2px] bg-zinc-400 mt-4 flex-1"></div>
            </div>

            <div className="min-h-[100px] flex flex-col md:flex-row md:justify-between gap-4 md:gap-4">
              <div className="flex-1">
                <h3 className="mt-10 font-semibold text-xl text-zinc-black">
                  Audit Keuangan
                </h3>

                <p className="mt-5 text-lg text-black max-w-2xl">
                  Taman Zakat sebagai LAZ Nasional berizin resmi dari Kemenag,
                  senantiasa berupaya secara maksimal tunduk dan patuh terhadap
                  ketentuan perundangan.
                </p>

                <p className="mt-2 mb-5 text-lg text-black max-w-2xl">
                  Hasil audit keuangan Taman Zakat menunjukkan bahwa pengelolaan
                  dana dilakukan secara transparan dan akuntabel. Audit Keuangan
                  oleh KAP (Kantor Akuntan Publik) kami lakukan sebagai bentuk
                  upaya pemenuhan kepatuhan terhadap ketentuan perundangan
                  sekaligus untuk meyakinkan kembali bahwa pengelolaan keuangan
                  ZIS dan DSKL yang telah kami lakukan adalah wajar, sesuai
                  dengan prinsip dan standar akuntansi yang berlaku di
                  Indonesia.
                </p>

                <div className="flex justify-center md:justify-start">
                  <Link
                    href="/tata-kelola/audit"
                    className="mt-5 bg-[#5DA630] text-white px-7 py-2.5 rounded-full hover:bg-[#4A8A25] transition-colors"
                  >
                    Detail Audit Keuangan
                  </Link>
                </div>
              </div>

              <RightBarAudit />
            </div>
          </section>

          <section id="legal-formal" className="mb-24 scroll-mt-32">
            <h2 className="border border-zinc-400 inline-block px-4 py-1.5 font-bold text-lg md:text-xl mb-12 rounded-sm text-zinc-900 bg-white">
              Legal Formal
            </h2>

            <div className="flex flex-wrap justify-center gap-y-12 gap-x-6">
              {legalFormals.map((item, idx) => (
                <div key={item.id || idx} className="relative w-[280px] h-[340px] flex flex-col justify-center">
                  <Image
                    src="/images/icon/Yellow Paper Clip Open Donation Instagram Post 1.svg"
                    alt="Paper note"
                    fill
                    className="object-cover z-0"
                  />
                  <div className="relative z-10 flex flex-col items-center text-center px-6 pt-6 pb-4 w-full h-full">
                    <h3 className="font-semibold text-zinc-900 text-lg mb-2 leading-tight mt-12 whitespace-pre-wrap">
                      {item.title}
                    </h3>
                    
                    {item.elements && item.elements.map((el: any, eidx: number) => {
                        // Use provided class if exists, otherwise use nice default styles
                        const textClass = el.class || "text-[14px] text-zinc-800 my-1 font-medium whitespace-pre-wrap leading-tight";
                        const textLargeClass = el.class || "text-[32px] font-light text-black my-2";
                        const badgeClass = el.class || "bg-[#A52A2A] text-white text-[12px] px-4 py-1.5 font-medium rounded-md my-1.5 mx-auto shadow-sm w-[90%]";
                        const outlineClass = el.class || "border-2 border-zinc-500 text-[11px] px-5 py-1 rounded-full font-semibold my-1 mx-auto text-zinc-700";
                        
                        if (el.type === 'text') return <p key={eidx} className={textClass}>{el.content}</p>;
                        if (el.type === 'text_large') return <p key={eidx} className={textLargeClass}>{el.content}</p>;
                        if (el.type === 'badge') return <div key={eidx} className={badgeClass}>{el.content}</div>;
                        if (el.type === 'outline') return <div key={eidx} className={outlineClass}>{el.content}</div>;
                        return null;
                    })}
                  </div>
                </div>
              ))}
            </div>
          </section>
        </div>
      </div>
    </div>
  );
}
