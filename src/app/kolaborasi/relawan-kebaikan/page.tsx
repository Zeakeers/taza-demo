import React from 'react'
import Image from 'next/image'

export default function RelawanKebaikanPage() {
  return (
    <div className="bg-[#EBF1D5] min-h-screen py-10 md:py-16 px-4 md:px-8 flex items-center justify-center relative overflow-hidden">
      <div className="max-w-[600px] w-full z-10">
        {/* Card Container */}
        <div className="bg-white rounded-[32px] md:rounded-[40px] shadow-sm relative pt-12 pb-16 px-6 sm:px-10 md:px-12 mx-auto border border-white/50">
          
          {/* Logo & Title */}
          <div className="flex flex-col items-center mb-10">
             <div className="w-24 h-24 mb-4 relative flex items-center justify-center">
                <Image 
                  src="/images/icon/taman zakat  logo .svg" 
                  alt="Logo Taman Zakat" 
                  width={96} 
                  height={96} 
                  className="w-full h-full object-contain" 
                  priority
                />
             </div>
             <h1 className="text-[20px] sm:text-[22px] md:text-[24px] font-bold text-[#2d7d42] uppercase tracking-wide text-center">
               FORM RELAWAN KEBAIKAN
             </h1>
          </div>

          {/* Form */}
          <form className="flex flex-col gap-5 md:gap-6 relative z-20">
            
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Nama</label>
              <input type="text" className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors" />
            </div>

            <div className="flex flex-col">
              <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Alamat domisili</label>
              <input type="text" className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors" />
            </div>

            <div className="flex flex-col">
              <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Pekerjaan</label>
              <input type="text" className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors" />
            </div>

            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2.5 ml-1 text-[14px] sm:text-[15px] font-medium">Media sosial</label>
              <div className="flex flex-wrap gap-3 mb-2">
                {['Instagram', 'Facebook'].map((opt, idx) => (
                  <label key={idx} className="flex items-center gap-2 bg-transparent border border-zinc-400 px-4 py-1.5 rounded-full cursor-pointer text-[13px] sm:text-sm text-zinc-700 hover:bg-zinc-50 transition-colors">
                    <input type="radio" name="mediaSosial" className="accent-[#5DA630] w-4 h-4" />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
              <input type="text" className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors" />
            </div>

            {[
              { label: 'No HP', type: 'text' },
              { label: 'Email', type: 'email' },
              { label: 'Jenis kelamin', type: 'text' },
              { label: 'Status', type: 'text' },
              { label: 'Pendidikan terakhir', type: 'text' },
              { label: 'Jurusan/Fakultas/Universitas', type: 'text' },
              { label: 'Pengalaman organisasi', type: 'text' },
              { label: 'Pelatihan yang pernah diikuti', type: 'text' },
              { label: 'Bahasa asing yang dikuasai', type: 'text' },
              { label: 'Mendapatkan informasi taman zakat dari?', type: 'text' }
            ].map((field, idx) => (
              <div key={idx} className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">{field.label}</label>
                <input 
                  type={field.type} 
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
                />
              </div>
            ))}

            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium">Alasan bergabung dengan taman zakat</label>
              <textarea 
                  rows={4}
                  className="w-full bg-white border border-zinc-300 text-zinc-800 rounded-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium">Perkiraan bantuan yang dapat anda berikan kepada taman zakat</label>
              <textarea 
                  rows={4}
                  className="w-full bg-white border border-zinc-300 text-zinc-800 rounded-sm px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* Submit Button */}
            <div className="mt-6 flex justify-center w-full">
              <button 
                type="button" 
                className="w-[90%] sm:w-full bg-[#E12B5E] hover:bg-[#c72251] text-white font-bold py-4 px-12 rounded-full transition-colors text-lg shadow-md hover:shadow-lg active:scale-95 mx-auto"
              >
                Konfirmasi
              </button>
            </div>
            
          </form>

        </div>
      </div>
    </div>
  )
}
