import React from 'react';
import Image from 'next/image';
import Link from 'next/link';

interface BankAccount {
  logo: string;
  name: string;
  number: string;
  width: number;
  height: number;
}

interface SectionData {
  title: string;
  accounts: BankAccount[];
}

const sections: SectionData[] = [
  {
    title: "Dana Sosial",
    accounts: [
      { logo: "/images/logo bank/bank-bsi-logo 1.svg", name: "BSI", number: "7900950057", width: 140, height: 40 },
      { logo: "/images/logo bank/bank mandiri.svg", name: "Mandiri", number: "1410075075051", width: 140, height: 40 },
      { logo: "/images/logo bank/bank-jatim-logo 1.svg", name: "Bank Jatim", number: "1862032515", width: 140, height: 40 }
    ]
  },
  {
    title: "Zakat",
    accounts: [
      { logo: "/images/logo bank/bank-negara-indonesia-(bni)-logo 2.svg", name: "BNI", number: "1900-9500-54", width: 110, height: 35 },
      { logo: "/images/logo bank/bank mandiri.svg", name: "Mandiri", number: "14100-750-750-10", width: 140, height: 40 },
      { logo: "/images/logo bank/bank-bsi-logo 1.svg", name: "BSI", number: "7900-9400-46", width: 140, height: 40 }
    ]
  },
  {
    title: "Infaq",
    accounts: [
      { logo: "/images/logo bank/bank-central-asia-(bca)-logo 1.svg", name: "BCA", number: "271-909-5555", width: 130, height: 45 },
      { logo: "/images/logo bank/bank-rakyat-indonesia-(bri)-logo 1.svg", name: "BRI", number: "0211-0100-2263-302", width: 140, height: 40 },
      { logo: "/images/logo bank/bank-negara-indonesia-(bni)-logo 2.svg", name: "BNI", number: "0900950051", width: 110, height: 35 },
      { logo: "/images/logo bank/bank mandiri.svg", name: "Mandiri", number: "14100-750-750-02", width: 140, height: 40 },
      { logo: "/images/logo bank/bank-bsi-logo 1.svg", name: "BSI", number: "744-664-4003", width: 140, height: 40 }
    ]
  },
  {
    title: "Jariyah",
    accounts: [
      { logo: "/images/logo bank/bank-bsi-logo 1.svg", name: "BSI", number: "7930-4482-90", width: 140, height: 40 }
    ]
  },
  {
    title: "Non Halal",
    accounts: [
      { logo: "/images/logo bank/bank-bsi-logo 1.svg", name: "BSI", number: "7900960063", width: 140, height: 40 }
    ]
  }
];

export default function NoRekeningPage() {
  return (
    <div className="bg-[#fcfee1] min-h-screen">
      {/* Hero Section */}
      <div className="relative w-full h-[450px] md:h-[500px]">
        <Image 
          src="/images/gambardetaile/hero no rekening.svg" 
          alt="Hero Pilihan Rekening Donasi" 
          fill
          priority
          className="object-cover object-[center_34%]"
        />
      </div>

      <div className="w-full pb-20 -mt-32 md:-mt-44 relative z-10 px-4 md:px-8">
        <div className="max-w-[1100px] mx-auto bg-white pt-10 md:pt-14 pb-16 md:pb-20 px-6 md:px-12 shadow-sm">
          
          {/* Header Title and Description */}
          <div className="flex flex-col md:flex-row gap-6 md:gap-12 items-center md:items-start mb-8 w-full">
            <div className="md:w-5/12 flex py-2 items-center justify-center md:justify-start">
              <h1 className="text-3xl md:text-[36px] font-bold text-[#86bf54] leading-tight text-center md:text-left">
                Pilihan Rekening Donasi
              </h1>
            </div>
            <div className="md:w-7/12">
              <p className="text-[#555555] text-sm md:text-[15px] leading-[1.8] text-left font-medium">
                Dengan informasi rekening donasi berikut, Anda dapat berkontribusi secara langsung untuk membantu menciptakan dampak positif bagi mereka yang memerlukan. Terima kasih atas kebaikan dan kemurahan hati Anda.
              </p>
            </div>
          </div>
          
          {/* Separator Line */}
          <div className="w-full h-[2px] bg-[#d4d4d4] mb-16 mx-auto"></div>

          {/* Bank Sections */}
          <div className="space-y-16">
            {sections.map((sec, secIdx) => (
              <div key={secIdx} className="flex flex-col items-center">
                {/* Category Title */}
                <h2 className="text-center text-xl md:text-2xl font-bold text-[#83b953] mb-10 tracking-wide">
                  {sec.title}
                </h2>

                {/* Cards Container */}
                <div className="flex flex-wrap justify-center gap-6 md:gap-8 w-full max-w-4xl">
                  {sec.accounts.map((acc, accIdx) => (
                    <div 
                      key={accIdx} 
                      className="w-[300px] flex flex-col overflow-hidden bg-white rounded-xl border border-zinc-400/60 group hover:transform hover:-translate-y-1 transition-all duration-300 shadow-sm"
                    >
                      {/* Top White Box */}
                      <div className="h-[95px] w-full relative">
                        <div className="relative w-full h-full flex items-center justify-center p-4">
                          <Image 
                            src={acc.logo} 
                            alt={acc.name} 
                            width={acc.width}
                            height={acc.height}
                            className={`object-contain max-h-[45px] transition-transform duration-300 group-hover:scale-105`}
                          />
                        </div>
                      </div>
                      
                      {/* Bottom Green Box */}
                      <div className="bg-gradient-to-r from-[#89DC45] to-[#496B2D] px-6 py-4 flex flex-col justify-center flex-1">
                        <p className="text-white text-sm font-medium mb-1">Nomer Rekening</p>
                        <p className="text-white text-[26px] font-bold tracking-wide">{acc.number}</p>
                        <div className="w-full h-[1px] bg-white/30 my-2"></div>
                        <p className="text-xs text-white/90">a.n Yayasan Taman Zakat Indonesia</p>
                      </div>
                    </div>
                  ))}
                </div>
                
                {/* Separator Line for all but last section */}
                {secIdx < sections.length - 1 && (
                  <div className="mt-16 w-full max-w-3xl flex items-center justify-center relative">
                    {/* The small vertical ticks on the separator to match design */}
                    <div className="h-[5px] w-[1px] bg-zinc-400 absolute left-0"></div>
                    <div className="w-full h-[1px] bg-zinc-300"></div>
                    <div className="h-[5px] w-[1px] bg-zinc-400 absolute right-0"></div>
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>

      {/* Footer / Confirm Section */}
      <div className="bg-[#262626] w-full py-14 px-6 relative z-10 border-t border-zinc-800">
        <div className="max-w-[1100px] mx-auto flex flex-col md:flex-row items-center justify-between gap-8 py-2">
          <div className="md:w-2/3 text-white">
            <p className="text-[15px] md:text-lg leading-[1.7] md:leading-[1.6] text-center md:text-left font-medium opacity-95">
              Apabila akad donasi yang di transfer tidak sesuai<br className="hidden md:block" />
              dengan pos rekening diatas, silakan konfirmasi atau<br className="hidden md:block" />
              mohon keikhlasannya untuk kami golongkan sebagai<br className="hidden md:block" />
              infaq &amp; sedekah bebas
            </p>
          </div>
          <div className="md:w-1/3 flex justify-center md:justify-end">
            <Link href="/layanan/konfirmasi-donasi" passHref>
              <button className="bg-white hover:bg-zinc-100 transition-colors shadow-lg px-8 py-3 rounded-md flex flex-col items-center group cursor-pointer border border-transparent hover:border-zinc-300">
                <span className="text-black font-bold text-lg flex items-center gap-2 group-hover:gap-3 transition-all">
                  Konfirmasi <span className="text-xl">&rarr;</span>
                </span>
                <span className="text-[10px] text-zinc-500 font-medium tracking-wide">
                  Silakan melakukan konfirmasi
                </span>
              </button>
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
