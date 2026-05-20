'use client'
import React, { useState } from 'react'
import Image from 'next/image'

const SparkIcon = ({ className }: { className?: string }) => (
  <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
    <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34" />
  </svg>
)

const defaultStats = [
  { number: '10K+', label: 'Penerima Manfaat' },
  { number: '50+', label: 'Program Sosial' },
  { number: '8', label: 'Kota Cakupan' },
]

const benefits = [
  {
    icon: '🤝',
    title: 'Jaringan Bermakna',
    desc: 'Terhubung dengan ratusan relawan berdedikasi dan para profesional di bidang sosial.',
  },
  {
    icon: '📚',
    title: 'Pengembangan Diri',
    desc: 'Akses pelatihan, workshop, dan pengalaman lapangan yang memperkaya skill-mu.',
  },
  {
    icon: '🌱',
    title: 'Dampak Nyata',
    desc: 'Setiap aksimu langsung dirasakan oleh masyarakat yang membutuhkan.',
  },
  {
    icon: '🏅',
    title: 'Sertifikasi Relawan',
    desc: 'Dapatkan sertifikat resmi sebagai bukti kontribusimu yang bisa digunakan kapan saja.',
  },
]

const areaColors = [
  'bg-[#EBF5D5] text-[#2d6e1f] border-[#a3cc72]',
  'bg-[#D6EDCA] text-[#3a7d27] border-[#8dc05e]',
  'bg-[#C8E6BC] text-[#2e6b1e] border-[#78b04a]',
  'bg-[#DDEFD0] text-[#336120] border-[#90c467]',
  'bg-[#E4F2D8] text-[#3d7a29] border-[#9ecb6e]',
  'bg-[#CFE8BE] text-[#285c18] border-[#6fa842]',
]

const defaultAreas = [
  'Pendidikan',
  'Kesehatan',
  'Lingkungan',
  'Pemberdayaan Ekonomi',
  'Sosial Kemasyarakatan',
  'Kemanusiaan & Bencana',
]

const defaultFormFields = [
  { name: 'nama', label: 'Nama Lengkap', type: 'text', placeholder: 'Masukkan nama lengkap', required: '1' },
  { name: 'no_hp', label: 'No. HP / WhatsApp', type: 'text', placeholder: 'Contoh: 08123456789', required: '1' },
  { name: 'email', label: 'Email', type: 'email', placeholder: 'contoh@email.com', required: '1' },
  { name: 'kontribusi', label: 'Bidang Kontribusi', type: 'select', options: 'Pendidikan,Kesehatan,Lingkungan,Pemberdayaan Ekonomi,Sosial Kemasyarakatan,Kemanusiaan & Bencana', required: '1' },
  { name: 'keterangan', label: 'Ceritakan Motivasimu', type: 'textarea', placeholder: 'Kenapa kamu ingin jadi volunteer Taman Zakat?', required: '0' }
]

export default function VolunteerPage() {
  const [pageData, setPageData] = useState<any>(null)
  const [isLoadingData, setIsLoadingData] = useState(true)

  const [loading, setLoading] = useState(false)
  const [success, setSuccess] = useState(false)
  const [errorMsg, setErrorMsg] = useState('')

  React.useEffect(() => {
    const fetchPageData = async () => {
      try {
        const apiUrl = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`
        const res = await fetch(`${apiUrl}/content/volunteer`)
        const data = await res.json()
        if (data && data.main) {
          setPageData(data.main)
        }
      } catch (error) {
        console.error('Failed to fetch page data:', error)
      }
    }
    fetchPageData()
  }, [])

  const formFields = pageData?.form_fields || defaultFormFields;
  const kontribusiField = formFields.find((f: any) => f.name === 'kontribusi');
  const areasList = kontribusiField?.options ? kontribusiField.options.split(',').map((o: string) => o.trim()) : [];

  const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault()
    setLoading(true)
    setErrorMsg('')
    setSuccess(false)

    try {
      const formData = new FormData(e.currentTarget);
      const data = Object.fromEntries(formData.entries());
      const apiUrl = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`
      const response = await fetch(`${apiUrl}/volunteer`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      })

      if (response.ok) {
        setSuccess(true)
        e.currentTarget.reset();
      } else {
        const errorData = await response.json()
        setErrorMsg(errorData.message || 'Terjadi kesalahan saat mengirim data.')
      }
    } catch (error) {
      setErrorMsg('Gagal terhubung ke server. Silakan coba lagi.')
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="bg-white min-h-screen overflow-hidden font-poppins">

      {/* HERO BANNER */}
      <section className="relative w-full h-[420px] sm:h-[500px] md:h-[560px] overflow-hidden">
        <Image
          src={pageData?.hero_image || "/images/gambardetaile/hero bidang kemanusian.svg"}
          alt="Volunteer Banner"
          fill
          className="object-cover object-center"
          priority
        />

        <div className="absolute inset-0 bg-black/55" />

        <div className="absolute inset-0 flex flex-col items-center justify-center text-center px-4 z-10">
          <span className="inline-block bg-[#FFE525] text-[#1a5c2a] text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
            Bergabung Sekarang
          </span>

          <h1 className="text-4xl sm:text-5xl md:text-[56px] font-black text-white leading-tight mb-5 drop-shadow-lg" dangerouslySetInnerHTML={{ __html: pageData?.hero_title || 'Jadilah Bagian<br /><span class="text-[#FFE525]">Perubahan</span> Nyata' }}>
          </h1>

          <p className="text-white/85 text-base sm:text-lg leading-relaxed max-w-xl mb-8 drop-shadow">
            {pageData?.hero_subtitle || 'Bersama Taman Zakat, setiap langkahmu memberi dampak bagi ribuan keluarga. Jadilah relawan dan ukir kisah yang berarti.'}
          </p>

          <a
            href="#form-daftar"
            className="inline-block bg-[#E12B5E] hover:bg-[#c72251] text-white font-bold px-10 py-4 rounded-full text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95"
          >
            Daftar Sekarang →
          </a>
        </div>

        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" className="w-full">
            <path d="M0 60V30C240 0 480 60 720 40C960 20 1200 50 1440 30V60H0Z" fill="white" />
          </svg>
        </div>
      </section>

      {/* STATS */}
      <section className="max-w-4xl mx-auto px-4 -mt-2 pb-16 relative z-20">
        <div className="flex flex-wrap justify-center gap-4">
          {(pageData?.stats || defaultStats).map((s: any, i: number) => (
            <div key={i} className="bg-white rounded-2xl border border-zinc-100 shadow-sm p-5 text-center hover:shadow-md transition-shadow w-40 sm:w-48">
              <div className="text-3xl sm:text-4xl font-black text-[#267a38] mb-1">{s.number}</div>
              <div className="text-zinc-500 text-sm font-medium">{s.label}</div>
            </div>
          ))}
        </div>
      </section>

      {/* BIDANG KESUKARELAAN */}
      <section className="py-16 px-4">
        <div className="max-w-4xl mx-auto">
          <div className="text-center mb-10">
            <h2 className="text-2xl sm:text-3xl font-black text-zinc-800 mb-3">Bidang yang Bisa Kamu Pilih</h2>
            <p className="text-zinc-500 text-base max-w-xl mx-auto">Temukan area yang sesuai dengan passion dan keahlianmu.</p>
          </div>
          <div className="flex flex-wrap gap-3 justify-center">
            {areasList.map((label: string, i: number) => {
              const colorClass = areaColors[i % areaColors.length];
              return (
                <span key={i} className={`border rounded-full px-5 py-2.5 text-sm font-semibold cursor-default select-none ${colorClass}`}>
                  {label}
                </span>
              );
            })}
          </div>
        </div>
      </section>

      {/* DIVIDER QUOTE */}
      <section className="bg-[#E12B5E] py-12 px-4">
        <div className="max-w-3xl mx-auto text-center">
          <SparkIcon className="w-8 h-8 text-white/40 mx-auto mb-4" />
          <blockquote className="text-white text-xl sm:text-2xl md:text-3xl font-black leading-snug italic">
            &ldquo;Satu tangan yang memberi lebih baik dari seribu tangan yang hanya menonton.&rdquo;
          </blockquote>
          <p className="text-white/70 text-sm mt-4 font-medium">— Taman Zakat</p>
        </div>
      </section>

      {/* FORM PENDAFTARAN */}
      <section id="form-daftar" className="py-16 px-4 bg-[#F9FBF5]">
        <div className="max-w-2xl mx-auto">

          {/* form header */}
          <div className="text-center mb-10">
            <div className="relative inline-block mb-6">
              <div className="absolute inset-0 bg-[#FFD700] rotate-2 -translate-x-2 translate-y-1 rounded z-0" />
              <div className="bg-[#FFE525] px-8 py-3 uppercase text-2xl font-black text-[#E12B5E] tracking-[0.15em] relative z-10 rounded">
                VOLUNTEER
              </div>
            </div>
            <h2 className="text-2xl sm:text-3xl font-black text-[#267a38] mb-3">{pageData?.form_title || 'Siap Beraksi? Daftarkan Dirimu!'}</h2>
            <p className="text-zinc-500 text-sm">{pageData?.form_subtitle || 'Isi formulir di bawah ini dan tim kami akan segera menghubungimu.'}</p>
          </div>

          {/* form card */}
            <div className="bg-white rounded-3xl shadow-lg border border-zinc-100 p-6 sm:p-10 relative overflow-hidden">
              <div className="absolute top-0 right-0 w-40 h-40 bg-[#EBF5D5] rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none" />
              <div className="absolute bottom-0 left-0 w-28 h-28 bg-[#FDE8EC] rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none" />

              <form onSubmit={handleSubmit} className="space-y-6 relative z-10">

                {errorMsg && (
                  <div className="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-2xl text-sm font-medium">
                    {errorMsg}
                  </div>
                )}
                
                {formFields.map((field: any, idx: number) => {
                  const isRequired = field.required === '1';

                  return (
                    <div key={idx}>
                      <label className="block text-zinc-700 font-bold mb-2 ml-1 text-sm">
                        {field.label} {isRequired && <span className="text-[#E12B5E]">*</span>}
                      </label>
                      
                      {field.type === 'textarea' ? (
                        <textarea
                          name={field.name}
                          required={isRequired}
                          placeholder={field.placeholder}
                          rows={4}
                          className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all text-sm resize-none"
                        ></textarea>
                      ) : field.type === 'select' ? (
                        <div className="relative">
                          <select
                            name={field.name}
                            required={isRequired}
                            className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-5 py-4 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all text-sm appearance-none cursor-pointer"
                          >
                            <option value="">Pilih {field.label.toLowerCase()}</option>
                            {field.options && field.options.split(',').map((opt: string, i: number) => (
                              <option key={i} value={opt.trim()}>{opt.trim()}</option>
                            ))}
                          </select>
                          <div className="absolute inset-y-0 right-5 flex items-center pointer-events-none text-zinc-400">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" /></svg>
                          </div>
                        </div>
                      ) : (
                        <input
                          type={field.type || 'text'}
                          name={field.name}
                          required={isRequired}
                          placeholder={field.placeholder}
                          className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all text-sm"
                        />
                      )}
                    </div>
                  );
                })}

                <div className="pt-2 flex items-center justify-between gap-4">
                  <button
                    type="submit"
                    disabled={loading}
                    className="bg-[#E12B5E] hover:bg-[#c72251] disabled:bg-[#e12b5e]/50 disabled:cursor-not-allowed text-white font-bold py-3.5 px-10 rounded-full transition-all text-base shadow-md hover:shadow-lg active:scale-95 hover:-translate-y-0.5"
                  >
                    {loading ? 'Mengirim...' : 'Daftar Sekarang'}
                  </button>

                  <div className="w-24 h-24 opacity-80 pointer-events-none flex-shrink-0 mix-blend-multiply">
                    <Image
                      src="/images/icon/cap volunter.svg"
                      alt="Cap Volunteer"
                      width={96}
                      height={96}
                      className="w-full h-full object-contain"
                    />
                  </div>
                </div>

                <p className="text-zinc-400 text-xs text-center -mt-2">
                  Dengan mendaftar, kamu menyetujui ketentuan sukarela Taman Zakat.
                </p>
              </form>
            </div>

          </div>
        </section>

      {/* ─── FOOTER ILLUSTRATION ───────────────────────────── */}
      <div className="w-full flex flex-row overflow-hidden">
        <div className="w-full md:w-1/2 flex-shrink-0">
          <Image
            src="/images/icon/Volunteer Day Pink Pastel Playful Illustrated Instagram Post 2.svg"
            alt="Volunteer Illustration"
            width={960}
            height={600}
            className="w-full h-auto object-cover object-bottom"
            priority
          />
        </div>
        <div className="hidden md:block md:w-1/2 flex-shrink-0">
          <Image
            src="/images/icon/Volunteer Day Pink Pastel Playful Illustrated Instagram Post 2.svg"
            alt="Volunteer Illustration"
            width={960}
            height={600}
            className="w-full h-auto object-cover object-bottom"
            priority
          />
        </div>
      </div>

    {/* SUCCESS POPUP MODAL */}
      {success && (
        <div className="fixed inset-0 z-50 flex items-center justify-center px-4 bg-black/60 backdrop-blur-sm animate-in fade-in duration-300">
          <div className="bg-white rounded-3xl w-full max-w-md p-8 text-center shadow-2xl animate-in zoom-in-95 duration-300 relative overflow-hidden">
            {/* Decoration */}
            <div className="absolute top-0 right-0 w-32 h-32 bg-[#EBF5D5] rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none" />
            <div className="absolute bottom-0 left-0 w-24 h-24 bg-[#FDE8EC] rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none" />
            
            <div className="w-20 h-20 bg-[#D6EDCA] text-[#3a7d27] rounded-full flex items-center justify-center mx-auto mb-6 relative z-10">
              <svg className="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            
            <h3 className="text-2xl font-black text-[#267a38] mb-3 relative z-10">Pendaftaran Berhasil!</h3>
            <p className="text-zinc-500 text-base mb-8 relative z-10">
              Terima kasih telah mendaftar. Tim Taman Zakat akan segera menghubungi Anda melalui WhatsApp atau Email untuk langkah selanjutnya.
            </p>
            
            <button 
              onClick={() => setSuccess(false)}
              className="w-full bg-[#E12B5E] hover:bg-[#c72251] text-white font-bold py-3.5 rounded-2xl transition-all shadow-md hover:shadow-lg active:scale-95 relative z-10"
            >
              Tutup
            </button>
          </div>
        </div>
      )}

    </div>
  )
}
