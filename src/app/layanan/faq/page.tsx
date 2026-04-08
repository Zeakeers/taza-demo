import { HelpCircle, Search } from "lucide-react";
import React from "react";

const faqList = Array(8).fill({
  question:
    "Saya sudah transfer, tapi status donasi masih 'Belum Dibayar', apa yang harus saya lakukan?",
  answer:
    "Harap tunggu 5-10 menit, pastikan nominal sesuai kode unik, lalu unggah bukti transfer di menu konfirmasi atau hubungi admin WhatsApp",
});

export default function FAQPage() {
  return (
    <>
      <style>{`
        body {
          overflow-x: hidden;
        }
      `}</style>
      <main className="w-full bg-white">
        {/* Container utama */}
      <div className="mx-auto w-full max-w-[1200px] px-6 py-16 md:px-10 lg:px-12">
        {/* Title & Search */}
        <div className="mb-14">
          <h1 className="mb-8 text-center text-2xl font-bold text-black md:text-[28px]">
            Haloo,ada yang bisa kami bantu?
          </h1>

          <div className="relative mx-auto max-w-[550px]">
            <input
              type="text"
              placeholder="Cari bantuan disini ..."
              className="w-full rounded-full border border-zinc-200 bg-[#FAFAFA] py-3.5 pl-8 pr-16 text-sm font-medium text-zinc-800 outline-none placeholder:text-zinc-400 focus:border-[#7FC248] md:text-base"
            />
            <button
              aria-label="Search"
              className="absolute right-2 top-1/2 flex h-[38px] w-[38px] -translate-y-1/2 items-center justify-center rounded-full bg-[#B2E26E] transition hover:bg-[#a1d15c]"
            >
              <Search className="h-[18px] w-[18px] text-white" strokeWidth={3} />
            </button>
          </div>
        </div>

        {/* Content Layout */}
        <div className="grid grid-cols-1 gap-12 lg:grid-cols-[1.5fr_1fr] lg:gap-16">
          {/* Left Column - FAQ List */}
          <div>
            <h2 className="mb-6 text-lg font-bold text-black md:text-xl">Pencarian terbanyak</h2>
            <div className="flex flex-col gap-6">
              {faqList.map((item, index) => (
                <div key={index} className="flex items-start gap-3">
                  <HelpCircle
                    className="mt-0.5 h-[22px] w-[22px] shrink-0 text-[#a5d65a]"
                    strokeWidth={2}
                  />
                  <div>
                    <h3 className="text-[15px] font-[600] text-[#7eb338] md:text-base md:leading-snug">
                      {item.question}
                    </h3>
                    <p className="mt-1.5 text-sm text-zinc-600 md:text-[15px] md:leading-relaxed text-left">
                      {item.answer}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Right Column - Popular Topics */}
          <div className="relative w-full lg:translate-x-16 xl:translate-x-28">
            <div className="sticky top-[120px] h-fit w-full bg-[#F4F9F2] p-8 md:p-10 pb-10">
              <h3 className="relative z-10 mb-5 text-[17px] font-bold text-zinc-800">
                Populer Topic
              </h3>
              <ul className="relative z-10 flex flex-col gap-2.5">
                {[...Array(8)].map((_, idx) => (
                  <li key={idx}>
                    <a
                      href="#"
                      className="text-[15px] font-medium text-[#7fb539] transition hover:text-[#5DA630] hover:underline"
                    >
                      Verification
                    </a>
                  </li>
                ))}
              </ul>

              <div className="relative z-10 mt-14 border-t border-zinc-200/80 pt-6">
                <h4 className="font-semibold text-[#8DC63F]">Contact Support</h4>
                <p className="mt-1 text-[13px] text-zinc-400">24 * 7 help from our support staff</p>
              </div>

              {/* Decorative shapes overflowing to the right screen edge */}
              <div className="absolute left-[55%] md:left-[60%] top-[15%] xl:top-[8%] flex flex-col w-[800px] xl:w-[1000px] rotate-[-12deg] pointer-events-none hidden sm:flex z-0">
                <div className="h-[60px] w-full bg-[#89BD43] shadow-[0_4px_10px_rgba(0,0,0,0.05)] translate-x-[40px]"></div>
                <div className="h-[80px] w-full bg-[#BBE567] shadow-[0_4px_10px_rgba(0,0,0,0.05)]"></div>
                <div className="h-[85px] w-full border-[1.5px] border-zinc-300 bg-transparent translate-x-[20px]"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Tiga kotak kosong (Section bawah hijau muda) */}
      <section className="w-full bg-[#EAF2DE] py-14">
        <div className="mx-auto w-full max-w-[1200px] px-6">
          <div className="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
            {[1, 2, 3].map((item) => (
              <div
                key={item}
                className="h-[220px] w-full border border-[#D5E6C1] bg-[#E2EDD3] md:h-[260px]"
              ></div>
            ))}
          </div>
        </div>
      </section>
    </main>
    </>
  );
}
