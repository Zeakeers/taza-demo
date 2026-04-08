import React from 'react'
import Image from 'next/image'

export default function VolunteerPage() {
  return (
    <div className="bg-white min-h-screen pt-16 flex flex-col items-center relative overflow-hidden">
      <div className="max-w-[700px] w-full z-10 flex flex-col items-center px-4 md:px-8">
        
        {/* Header 'VOLUNTEER' */}
        <div className="relative mb-12 mt-10">
            <div className="relative inline-block">
                {/* Back rotated box */}
                <div className="absolute inset-0 bg-[#FFD700] rotate-3 -translate-x-3 -translate-y-1 w-full h-full z-0"></div>
                
                {/* Front box */}
                <div className="bg-[#FFE525] px-8 py-3 md:px-10 uppercase text-2xl md:text-3xl font-black text-[#E12B5E] tracking-[0.2em] relative z-10 w-full h-full">
                    VOLUNTEER
                </div>
                
                {/* simple SVG spark top left */}
                <svg className="absolute -top-10 -left-6 w-12 h-12 text-black z-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34"/>
                </svg>

                {/* simple SVG spark bottom right */}
                <svg className="absolute -bottom-6 -right-6 w-10 h-10 text-black z-20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34"/>
                </svg>
            </div>
        </div>

        {/* Intro text */}
        <div className="border-l-[3px] border-zinc-300 pl-5 mb-16 w-full max-w-[600px] text-zinc-700 text-[15px] sm:text-[16px] leading-relaxed font-medium">
            Taman Zakat melalui berbagai program ziswaf menerima donasi dari berbagai pihak mulai perorangan, perusahaan swasta, BUMN atau pihak manapun yang memiliki tujuan untuk bersama-sama mengembangkan kegiatan Sosial ke masyarakat.
        </div>

        {/* Form Title */}
        <div className="relative mb-10 text-center flex items-center justify-center w-full max-w-[500px]">
            {/* spark on the left */}
            <svg className="absolute -left-2 md:-left-8 top-1 w-10 h-10 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
                <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34"/>
            </svg>
            <h1 className="text-[20px] sm:text-[22px] md:text-[24px] font-bold text-[#358249] px-8 leading-tight">
                Siap Beraksi? Daftarkan<br/>Dirimu di Sini
            </h1>
        </div>

        {/* Form */}
        <form className="w-full max-w-[500px] flex flex-col gap-6 relative z-20">
            {/* standard inputs */}
            {[
              { label: 'Nama', type: 'text' },
              { label: 'Nama Perusahaan', type: 'text' },
              { label: 'No HP', type: 'text' },
            ].map((field, idx) => (
              <div key={idx} className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">{field.label}</label>
                <input 
                  type={field.type} 
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
                />
              </div>
            ))}

            {/* Email with spark on the right */}
            <div className="flex flex-col relative w-full">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Email</label>
                <input 
                  type="email" 
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors relative z-10"
                />
                {/* Spark */}
                <svg className="absolute z-0 -right-4 md:-right-12 top-10 w-9 h-9 text-zinc-400 block" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34"/>
                </svg>
            </div>

            {/* Kontribusi */}
            <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Kontribusi</label>
                <input 
                  type="text" 
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
                />
            </div>

            {/* Keterangan */}
            <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Keterangan</label>
                <textarea 
                  rows={5}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
                ></textarea>
            </div>

            {/* Submit & Stamp Row */}
            <div className="mt-4 flex flex-row items-center w-full relative h-[100px] md:h-[120px]">
                <button 
                  type="button" 
                  className="bg-[#A81F26] hover:bg-[#8d181e] text-white font-semibold py-3 px-12 rounded-full transition-colors text-lg shadow-md hover:shadow-lg active:scale-95 z-20"
                >
                  Konfirmasi
                </button>

                {/* Stamp */}
                <div className="absolute right-0 md:-right-8 lg:-right-16 top-[-30px] md:top-[-40px] w-[140px] h-[140px] md:w-[150px] md:h-[150px] opacity-90 pointer-events-none z-10 mix-blend-multiply">
                    <Image 
                      src="/images/icon/cap volunter.svg" 
                      alt="Cap Volunteer" 
                      width={180} 
                      height={180} 
                      className="w-full h-full object-contain" 
                    />
                </div>
            </div>
            
        </form>
      </div>

      {/* Hands Image positioned at bottom */}
      <div className="w-full mt-10 md:mt-2 xl:mt-[-40px] relative z-0 flex flex-row">
          <div className="w-full md:w-1/2 flex-shrink-0">
              <Image 
                src="/images/icon/Volunteer Day Pink Pastel Playful Illustrated Instagram Post 2.svg" 
                alt="Volunteer Background" 
                width={960} 
                height={600} 
                className="w-full h-auto min-h-[150px] object-cover object-bottom" 
                priority
              />
          </div>
          <div className="hidden md:block md:w-1/2 flex-shrink-0">
              <Image 
                src="/images/icon/Volunteer Day Pink Pastel Playful Illustrated Instagram Post 2.svg" 
                alt="Volunteer Background" 
                width={960} 
                height={600} 
                className="w-full h-auto min-h-[150px] object-cover object-bottom" 
                priority
              />
          </div>
      </div>
      
    </div>
  )
}
