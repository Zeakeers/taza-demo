'use client'
import React, { useState } from 'react'
import Image from 'next/image'

const SparkIcon = ({ className }: { className?: string }) => (
  <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
    <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34" />
  </svg>
)

const stats = [
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

const areas = [
  { label: 'Pendidikan', color: 'bg-[#EBF5D5] text-[#2d6e1f] border-[#a3cc72]' },
  { label: 'Kesehatan', color: 'bg-[#D6EDCA] text-[#3a7d27] border-[#8dc05e]' },
  { label: 'Lingkungan', color: 'bg-[#C8E6BC] text-[#2e6b1e] border-[#78b04a]' },
  { label: 'Pemberdayaan Ekonomi', color: 'bg-[#DDEFD0] text-[#336120] border-[#90c467]' },
  { label: 'Sosial Kemasyarakatan', color: 'bg-[#E4F2D8] text-[#3d7a29] border-[#9ecb6e]' },
  { label: 'Kemanusiaan & Bencana', color: 'bg-[#CFE8BE] text-[#285c18] border-[#6fa842]' },
]

export default function VolunteerPage() {
  const [form, setForm] = useState({
    nama: '',
    noHp: '',
    email: '',
    kontribusi: '',
    keterangan: '',
  })

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setForm(prev => ({ ...prev, [e.target.name]: e.target.value }))
  }

  return (
    <div className="bg-white min-h-screen overflow-hidden font-poppins">

      {/* HERO BANNER */}
      <section className="relative w-full h-[420px] sm:h-[500px] md:h-[560px] overflow-hidden">
        {/* banner image (dummy — ganti src saat gambar tersedia) */}
        <Image
          src="/images/gambardetaile/hero bidang kemanusian.svg"
          alt="Volunteer Banner"
          fill
          className="object-cover object-center"
          priority
        />

        {/* overlay gelap agar teks terbaca */}
        <div className="absolute inset-0 bg-black/55" />

        {/* konten teks */}
        <div className="absolute inset-0 flex flex-col items-center justify-center text-center px-4 z-10">
          <span className="inline-block bg-[#FFE525] text-[#1a5c2a] text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">
            Bergabung Sekarang
          </span>

          <h1 className="text-4xl sm:text-5xl md:text-[56px] font-black text-white leading-tight mb-5 drop-shadow-lg">
            Jadilah Bagian<br />
            <span className="text-[#FFE525]">Perubahan</span> Nyata
          </h1>

          <p className="text-white/85 text-base sm:text-lg leading-relaxed max-w-xl mb-8 drop-shadow">
            Bersama Taman Zakat, setiap langkahmu memberi dampak bagi ribuan keluarga. Jadilah relawan dan ukir kisah yang berarti.
          </p>

          <a
            href="#form-daftar"
            className="inline-block bg-[#E12B5E] hover:bg-[#c72251] text-white font-bold px-10 py-4 rounded-full text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95"
          >
            Daftar Sekarang →
          </a>
        </div>

        {/* wave divider */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" className="w-full">
            <path d="M0 60V30C240 0 480 60 720 40C960 20 1200 50 1440 30V60H0Z" fill="white" />
          </svg>
        </div>
      </section>

      {/* STATS */}
      <section className="max-w-4xl mx-auto px-4 -mt-2 pb-16">
        <div className="flex flex-wrap justify-center gap-4">
          {stats.map((s, i) => (
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
            {areas.map((a, i) => (
              <span key={i} className={`border rounded-full px-5 py-2.5 text-sm font-semibold cursor-default select-none ${a.color}`}>
                {a.label}
              </span>
            ))}
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
            <h2 className="text-2xl sm:text-3xl font-black text-[#267a38] mb-3">Siap Beraksi? Daftarkan Dirimu!</h2>
            <p className="text-zinc-500 text-sm">Isi formulir di bawah ini dan tim kami akan segera menghubungimu.</p>
          </div>

          {/* form card */}
          <div className="bg-white rounded-3xl shadow-lg border border-zinc-100 p-6 sm:p-10 relative overflow-hidden">
            {/* subtle bg decoration */}
            <div className="absolute top-0 right-0 w-40 h-40 bg-[#EBF5D5] rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none" />
            <div className="absolute bottom-0 left-0 w-28 h-28 bg-[#FDE8EC] rounded-full translate-y-1/2 -translate-x-1/2 pointer-events-none" />

            <form className="flex flex-col gap-5 relative z-10">
              {/* Nama */}
              <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-sm font-semibold">Nama Lengkap <span className="text-[#E12B5E]">*</span></label>
                <input
                  type="text"
                  name="nama"
                  value={form.nama}
                  onChange={handleChange}
                  placeholder="Masukkan nama lengkap"
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all placeholder:text-zinc-400 text-sm"
                />
              </div>

              {/* No HP */}
              <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-sm font-semibold">No. HP / WhatsApp <span className="text-[#E12B5E]">*</span></label>
                <input
                  type="tel"
                  name="noHp"
                  value={form.noHp}
                  onChange={handleChange}
                  placeholder="Contoh: 08123456789"
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all placeholder:text-zinc-400 text-sm"
                />
              </div>

              {/* Email */}
              <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-sm font-semibold">Email <span className="text-[#E12B5E]">*</span></label>
                <input
                  type="email"
                  name="email"
                  value={form.email}
                  onChange={handleChange}
                  placeholder="contoh@email.com"
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all placeholder:text-zinc-400 text-sm"
                />
              </div>

              {/* Kontribusi */}
              <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-sm font-semibold">Bidang Kontribusi</label>
                <select
                  name="kontribusi"
                  value={form.kontribusi}
                  onChange={handleChange}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all text-sm appearance-none cursor-pointer"
                >
                  <option value="">Pilih bidang kontribusi</option>
                  {areas.map((a, i) => (
                    <option key={i} value={a.label}>{a.label}</option>
                  ))}
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>

              {/* Keterangan */}
              <div className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-sm font-semibold">Ceritakan Motivasimu</label>
                <textarea
                  name="keterangan"
                  value={form.keterangan}
                  onChange={handleChange}
                  rows={4}
                  placeholder="Kenapa kamu ingin jadi volunteer Taman Zakat?"
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/40 focus:border-[#5DA630] transition-all resize-none placeholder:text-zinc-400 text-sm"
                />
              </div>

              {/* Submit + stamp row */}
              <div className="mt-2 flex items-center justify-between gap-4">
                <button
                  type="button"
                  className="bg-[#E12B5E] hover:bg-[#c72251] text-white font-bold py-3.5 px-10 rounded-full transition-all text-base shadow-md hover:shadow-lg active:scale-95 hover:-translate-y-0.5"
                >
                  Daftar Sekarang
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

    </div>
  )
}
