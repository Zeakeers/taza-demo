import React from 'react'
import Image from 'next/image'

export default function PermohonanBantuanPage() {
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
             <h1 className="text-[20px] sm:text-[22px] md:text-[26px] font-bold text-[#2d7d42] uppercase tracking-wide text-center">
               FORM PERMOHONAN BANTUAN
             </h1>
          </div>

          {/* Form */}
          <form className="flex flex-col gap-5 md:gap-6 relative z-20">
            
            {/* Standard Text Inputs */}
            {[
              { label: 'Nama Pemohon', type: 'text' },
              { label: 'Alamat Domisili', type: 'text' },
              { label: 'No Whatsapp', type: 'text' },
              { label: 'Email', type: 'email' },
              { label: 'Jenis Pemohon', type: 'text' },
            ].map((field, idx) => (
              <div key={idx} className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">{field.label}</label>
                <input 
                  type={field.type} 
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
                />
              </div>
            ))}

            {/* Radio Source Info */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2.5 ml-1 text-[14px] sm:text-[15px] font-medium leading-tight">
                Darimana Anda Mendapat Info Permohonan Bantuan Taman Zakat ini?
              </label>
              <div className="flex flex-wrap gap-3">
                {[
                  'Media Sosial',
                  'Website Taman Zakat',
                  'LAZ atau Lembaga Sosial Lain',
                  'Lainnya'
                ].map((opt, idx) => (
                  <label key={idx} className="flex items-center gap-2 bg-[#eff4fd] border border-[#d2def2] px-4 py-2.5 rounded-full cursor-pointer text-[13px] sm:text-sm text-zinc-700 hover:bg-[#e0eaf9] transition-colors">
                    <input type="radio" name="sourceInfo" className="accent-[#5DA630] w-4 h-4" />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
            </div>

            {/* Textarea 1 */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium leading-snug">
                Jika Dapat Info dari referensi/rekomendasi, Tuliskan dengan Format: Nama Referensi/Rekomendasi_Jabatan_Instansi/Perusahaan
              </label>
              <textarea 
                  rows={4}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* Radio Previous Request */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2.5 ml-1 text-[14px] sm:text-[15px] font-medium leading-tight">
                Apakah Sebelumnya Anda Pernah Mengajukan Permohonan ke Lembaga Amil Zakat (LAZ) atau Lembaga Sosial lain?
              </label>
              <div className="flex flex-wrap gap-3">
                {['Ya', 'Tidak'].map((opt, idx) => (
                  <label key={idx} className="flex items-center gap-2 bg-[#eff4fd] border border-[#d2def2] px-5 py-2.5 rounded-full cursor-pointer text-[13px] sm:text-sm text-zinc-700 hover:bg-[#e0eaf9] transition-colors">
                    <input type="radio" name="prevRequest" className="accent-[#5DA630] w-4 h-4" />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
            </div>

            {/* Textarea 2 */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium leading-snug">
                Jika Sebelumnya Pernah Mengajukan Bantuan di Lembaga Amil Zakat (LAZ) atau Lembaga Sosial Lain, Kira-Kira Kapan Terakhir Kali Anda mengajukan?
              </label>
              <textarea 
                  rows={3}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* File Upload */}
            <div className="flex flex-col mt-1">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium">Upload Foto/Scan KTP Pemohon</label>
              <div className="flex items-center w-full">
                <input type="file" 
                  className="block w-full text-sm text-zinc-500
                  file:mr-4 file:py-2.5 file:px-4
                  file:rounded-sm file:border file:border-[#b4c4dd]
                  file:text-sm file:font-medium
                  file:bg-[#eff4fd] file:text-zinc-700
                  hover:file:bg-[#e0eaf9] file:transition-colors file:cursor-pointer
                  bg-transparent cursor-pointer" 
                  accept="image/*,.pdf"
                />
              </div>
            </div>

            {/* Textarea 3 */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium leading-snug">
                Deskripsi Permohonan (Apa Alasan Anda Mengajukan Bantuan di Taman Zakat)
              </label>
              <textarea 
                  rows={4}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* Nominal Input */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Nominal Bantuan yang ingin diajukan</label>
              <input 
                type="number" 
                className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
              />
            </div>

            {/* Submit Button */}
            <div className="mt-6 flex justify-center w-full">
              <button 
                type="button" 
                className="w-full sm:w-auto min-w-[200px] bg-[#E12B5E] hover:bg-[#c72251] text-white font-semibold py-3.5 px-12 rounded-full transition-colors text-lg shadow-md hover:shadow-lg active:scale-95"
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
