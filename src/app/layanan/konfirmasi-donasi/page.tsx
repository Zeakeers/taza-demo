import React from 'react'
import Image from 'next/image'

export default function KonfirmasiDonasiPage() {
  return (
    <div className="bg-[#f0f5da] min-h-screen py-16 px-4 md:px-8 flex items-center justify-center relative overflow-hidden">
      <div className="max-w-lg w-full z-10">
        {/* Card Container */}
        <div className="bg-white rounded-[32px] md:rounded-[40px] shadow-sm relative pt-12 pb-20 px-6 sm:px-12 md:px-14 mx-auto border border-white/50">
          
          {/* Logo & Title */}
          <div className="flex flex-col items-center mb-8">
             <div className="w-24 h-24 mb-4 relative flex items-center justify-center">
                {/* Fallback to Taza Logo if specific hexagon is not found */}
                <Image 
                  src="/images/icon/taman zakat  logo .svg" 
                  alt="Logo Taman Zakat" 
                  width={96} 
                  height={96} 
                  className="w-full h-full object-contain" 
                  priority
                />
             </div>
             <h1 className="text-[22px] md:text-[26px] font-bold text-[#2d7d42] uppercase tracking-wide text-center">
               Konfirmasi Donasi
             </h1>
          </div>

          {/* Form */}
          <form className="flex flex-col gap-4 md:gap-5 relative z-20">
            {[
              { label: 'Nama Lengkap', type: 'text' },
              { label: 'No WhatsApp', type: 'text' },
              { label: 'Email', type: 'email' },
              { label: 'Tanggal Transfer', type: 'date' },
              { label: 'Bank Tujuan', type: 'text' },
              { label: 'Program', type: 'text' },
              { label: 'Nominal', type: 'number' }
            ].map((field, idx) => (
              <div key={idx} className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[15px] font-medium">{field.label}</label>
                <input 
                  type={field.type} 
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
                />
              </div>
            ))}

            <div className="flex flex-col mt-1">
              <label className="text-zinc-600 mb-2 ml-1 text-[15px] font-medium">Bukti Pembayaran</label>
              <div className="flex items-center">
                <input type="file" 
                  className="block w-full text-sm text-zinc-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded-sm file:border file:border-[#b4c4dd]
                  file:text-sm file:font-medium
                  file:bg-[#eff4fd] file:text-zinc-700
                  hover:file:bg-[#e0eaf9] file:transition-colors file:cursor-pointer
                  bg-transparent cursor-pointer" 
                  accept="image/*,.pdf"
                />
              </div>
            </div>

            <div className="mt-8 flex justify-center">
              <button 
                type="button" 
                className="bg-[#ad1a1e] hover:bg-[#911317] text-white font-semibold py-3 px-12 rounded-full transition-colors text-lg shadow-md hover:shadow-lg active:scale-95"
              >
                Konfirmasi
              </button>
            </div>
          </form>

          {/* Cap Lunas Stamp */}
          <div className="absolute -bottom-6 -right-6 md:-bottom-12 md:-right-12 z-30 w-40 h-40 md:w-52 md:h-52 transform -rotate-12 select-none pointer-events-none opacity-90 drop-shadow-sm">
             <Image 
               src="/images/icon/cap lunas.svg" 
               alt="Lunas Stamp" 
               fill 
               className="object-contain"
             />
          </div>
        </div>
      </div>
    </div>
  )
}
