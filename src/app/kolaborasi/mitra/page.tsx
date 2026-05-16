import React from 'react';
import Image from 'next/image';
import { getMitra } from '@/lib/api';

interface MitraLogo {
  id: number;
  name: string;
  logo: string;
}

interface MitraSection {
  id: number;
  name: string;
  logos: MitraLogo[];
}

export default async function MitraPage() {
  const data = await getMitra();
  const sections: MitraSection[] = data?.sections || [];

  return (
    <div className="bg-white min-h-screen overflow-hidden relative font-poppins">

      <div className="max-w-[1200px] mx-auto px-4 md:px-8 py-16 md:py-24">

        {/* Page Main Title */}
        <div className="w-full flex justify-center mb-16 md:mb-20">
          <h1 className="text-2xl md:text-[46px] font-bold text-black text-center uppercase tracking-wide">
            Sinergi Kebaikan
          </h1>
        </div>

        {/* Dynamic Sections */}
        {sections.map((section, sectionIndex) => (
          <div key={section.id}>
            {/* Section Content */}
            {sectionIndex % 2 === 0 ? (
              /* Even sections (0, 2, 4...): Title LEFT, Logos RIGHT */
              <div className="relative w-full flex flex-col md:flex-row justify-between mb-16 gap-8 items-start">
                <div className="w-full md:w-[35%] static md:sticky top-0 md:top-[300px] flex flex-col justify-center md:justify-start items-center md:items-start mb-10 md:mb-0">
                  <h2 className="text-3xl md:text-[40px] font-bold text-black leading-tight max-w-[423px] text-center md:text-left">
                    {section.name}
                  </h2>
                </div>

                <div className="w-full md:w-[60%] flex justify-center md:justify-end">
                  <LogoGrid logos={section.logos} />
                </div>

                {/* QRIS & ATM icons — only on section index 2 (Mitra Payment), flush to screen edges */}
                {sectionIndex === 2 && (
                  <div className="absolute bottom-0 left-1/2 -translate-x-1/2 w-screen pointer-events-none z-20">
                    <div className="relative w-full h-0">
                      <div className="absolute left-0 bottom-0 w-[100px] md:w-[120px] lg:w-[150px]">
                        <Image src="/images/icon/qris.svg" alt="QRIS" width={150} height={150} className="w-full h-auto object-contain" />
                      </div>
                      <div className="absolute right-0 bottom-0 w-[120px] md:w-[160px] lg:w-[200px]">
                        <Image src="/images/icon/atm.svg" alt="ATM" width={200} height={200} className="w-full h-auto object-contain" />
                      </div>
                    </div>
                  </div>
                )}
              </div>
            ) : (
              /* Odd sections (1, 3, 5...): Logos LEFT, Title RIGHT */
              <div className="relative w-full py-10 mb-16 flex flex-col-reverse md:flex-row justify-between items-center min-h-[400px] gap-8">

                {/* Newspaper decorative background — only on section index 1 (Media Partner) */}
                {sectionIndex === 1 && (
                  <div className="absolute inset-0 z-0 flex items-center justify-center opacity-90 pointer-events-none overflow-hidden md:overflow-visible">
                    <div className="relative w-full h-full max-w-[1200px]">
                      <Image src="/images/icon/koran 1.svg" alt="" width={400} height={400} className="absolute right-[-25%] md:right-[-25%] top-[30%] md:top-[5%] object-contain object-right w-[200px] md:w-[450px] h-auto" />
                      <Image src="/images/icon/koran 2.svg" alt="" width={700} height={400} className="absolute left-[5%] md:left-[15%] top-[30%] md:top-[5%] object-contain w-[300px] md:w-[750px] h-auto" />
                      <Image src="/images/icon/koran 3.svg" alt="" width={150} height={150} className="absolute left-[-5%] md:left-[0%] bottom-[-5%] md:bottom-[-20%] object-contain w-[80px] md:w-[140px] h-auto" />
                      <Image src="/images/icon/koran 4.svg" alt="" width={120} height={120} className="absolute right-[5%] md:right-[20%] bottom-[0%] md:bottom-[10%] object-contain w-[70px] md:w-[120px] h-auto" />
                    </div>
                  </div>
                )}

                <div className="relative z-10 w-full md:w-[60%] flex justify-center md:justify-start items-center">
                  <LogoGrid logos={section.logos} />
                </div>

                <div className="relative z-10 w-full md:w-[35%] flex justify-center md:justify-end items-center mt-4 md:mt-0 md:pr-8 mb-6 md:mb-0">
                  <h2 className="text-3xl md:text-[40px] font-bold text-black text-center md:text-right">
                    {section.name}
                  </h2>
                </div>
              </div>
            )}

            {/* Separator between sections — alternates direction */}
            {sectionIndex < sections.length - 1 && (
              sectionIndex % 2 === 0 ? (
                /* After even section: lines lean RIGHT */
                <div className="w-full flex justify-end mb-20 md:mr-[-2%]">
                  <div className="w-full max-w-[800px] flex flex-col gap-[28px] md:gap-[36px] relative py-4">
                    <div className="w-[80%] h-[2.5px] bg-[#d1d5db] ml-[20%] rounded-full"></div>
                    <div className="w-[95%] h-[2.5px] bg-[#d1d5db] ml-[25%] rounded-full"></div>
                    <div className="w-[105%] h-[2.5px] bg-[#d1d5db] ml-[-18%] rounded-full"></div>
                  </div>
                </div>
              ) : (
                /* After odd section: lines lean LEFT */
                <div className="w-full flex justify-start mb-24 md:ml-[-2%]">
                  <div className="w-full max-w-[800px] flex flex-col gap-[28px] md:gap-[36px] relative py-4">
                    <div className="w-[80%] h-[2.5px] bg-[#d1d5db] mr-[20%] ml-auto rounded-full"></div>
                    <div className="w-[95%] h-[2.5px] bg-[#d1d5db] mr-[25%] ml-auto rounded-full"></div>
                    <div className="w-[105%] h-[2.5px] bg-[#d1d5db] mr-[-18%] ml-auto rounded-full"></div>
                  </div>
                </div>
              )
            )}
          </div>
        ))}

        {/* Empty State */}
        {sections.length === 0 && (
          <div className="text-center py-20">
            <p className="text-gray-400 text-lg">Belum ada data mitra.</p>
          </div>
        )}

      </div>

    </div>
  );
}

/**
 * LogoGrid component: Displays logos in a grid of max 3 per row.
 * When a row has fewer than 3 items, they are centered.
 */
function LogoGrid({ logos }: { logos: MitraLogo[] }) {
  if (!logos || logos.length === 0) return null;

  const maxPerRow = 3;
  const rows: MitraLogo[][] = [];

  for (let i = 0; i < logos.length; i += maxPerRow) {
    rows.push(logos.slice(i, i + maxPerRow));
  }

  return (
    <div className="w-full max-w-[650px] flex flex-col gap-y-10">
      {rows.map((row, rowIndex) => {
        const isLastRow = rowIndex === rows.length - 1;
        const isIncomplete = row.length < maxPerRow;

        return (
          <div
            key={rowIndex}
            className={`flex gap-x-8 md:gap-x-12 ${
              isLastRow && isIncomplete ? 'justify-center' : 'justify-center md:justify-start'
            }`}
          >
            {row.map((logo) => (
              <div
                key={logo.id}
                className="flex items-center justify-center w-[110px] md:w-[180px] h-[70px] md:h-[100px] p-2"
              >
                <Image
                  src={logo.logo}
                  alt={logo.name}
                  width={180}
                  height={100}
                  className="max-w-full max-h-full object-contain"
                />
              </div>
            ))}
          </div>
        );
      })}
    </div>
  );
}
