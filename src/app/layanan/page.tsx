import React from 'react'
import Link from 'next/link'

export default function page() {
  return (
    <div className="bg-white text-zinc-800 min-h-screen">
      <div className="mx-auto max-w-[1280px] px-4 md:px-8 lg:px-12 py-10 md:py-16">
        
        {/* Title Section */}
        <div className="flex justify-center mb-10 md:mb-12">
          <div className="relative inline-block text-center mt-8 z-0">
            <div className="absolute -left-4 -right-4 -top-1 -bottom-1 sm:-top-2 sm:-bottom-2 bg-[#ffeeee] -rotate-[3deg] -z-10" aria-hidden="true"></div>
            <h1 className="text-3xl md:text-4xl lg:text-[42px] font-newsreader font-bold text-black relative z-10 px-2 tracking-tight">
              Layanan Taman Zakat
            </h1>
          </div>
        </div>

        {/* Description */}
        <div className="mb-16 md:mb-20 max-w-4xl mx-auto px-4 md:px-0">
          <p className="text-zinc-800 text-[17px] md:text-[20px] font-sans leading-[1.6] md:text-center text-justify">
            Taman Zakat adalah Lembaga Amil Zakat (LAZ) yang telah memiliki legalitas resmi dan diakui oleh berbagai pihak berwenang, baik di tingkat daerah maupun nasional. Legalitas tersebut menjadi bukti komitmen kami dalam mengelola dana zakat, infaq, dan sedekah secara profesional, amanah, dan sesuai ketentuan perundang-undangan yang berlakut
          </p>
        </div>

        {/* Separator Line */}
        <div className="w-[40%] md:w-[35%] lg:w-[28%] max-w-[320px] h-[2px] md:h-[3px] bg-black mb-12 md:mb-16"></div>

        {/* Main Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 pb-20">
          
          {[
            { title: "Konfirmasi Donasi", href: "/layanan/konfirmasi-donasi" },
            { title: "Kantor Pelayanan", href: "/layanan/kantor-layanan" },
            { title: "QR Code Donasi", href: "/layanan/qr-code-donasi" },
            { title: "No. Rekening", href: "/layanan/no-rekening" },
            { title: "Hitung Zakat", href: "#" },
            { title: "FAQ", href: "/layanan/faq" }
          ].map((item, index) => (
            <div key={index} className="border border-black rounded-lg bg-white relative aspect-[4/5] md:aspect-square lg:aspect-[4/5] flex flex-col justify-end p-5 md:p-6 transition-transform hover:-translate-y-1 hover:shadow-lg group overflow-hidden">
              <Link href={item.href} className="absolute inset-0 z-20" aria-label={item.title}></Link>
              
              <div className="border border-black rounded-md px-4 py-3 bg-white w-[90%] md:w-[85%] z-10 shadow-sm flex flex-col justify-center transition-colors group-hover:border-zinc-500">
                <div className="flex items-center justify-between mb-1">
                  <h3 className="font-newsreader text-base md:text-lg text-black font-medium">{item.title}</h3>
                  <span className="text-black text-lg leading-none font-bold">&#10140;</span>
                </div>
                <p className="text-[10px] md:text-[11px] text-zinc-500 font-sans tracking-wide mt-1">
                  join our monthly giving community
                </p>
              </div>
            </div>
          ))}

        </div>
      </div>
    </div>
  )
}