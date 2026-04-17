'use client'
import React, { useState } from 'react'
import Image from 'next/image'

const SparkIcon = ({ className }: { className?: string }) => (
  <svg className={className} viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="3" strokeLinecap="round" strokeLinejoin="round">
    <path d="M12 4v16M4 12h16M6.34 6.34l11.32 11.32M6.34 17.66L17.66 6.34"/>
  </svg>
)

const stats = [
  { number: '500+', label: 'Relawan Aktif' },
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
  { label: 'Pendidikan', color: 'bg-[#EBF5D5] text-[#3a7d27] border-[#b5d98b]' },
  { label: 'Kesehatan', color: 'bg-[#FDE8EC] text-[#c02350] border-[#f5aec0]' },
  { label: 'Lingkungan', color: 'bg-[#E8F4FD] text-[#1e6fa8] border-[#aed4f0]' },
  { label: 'Pemberdayaan Ekonomi', color: 'bg-[#FFF8E1] text-[#b8860b] border-[#ffe082]' },
  { label: 'Sosial Kemasyarakatan', color: 'bg-[#F3E8FF] text-[#7c3aed] border-[#d5b0f5]' },
  { label: 'Kemanusiaan & Bencana', color: 'bg-[#FFF0E5] text-[#c2470a] border-[#f5c09a]' },
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
    <div className="bg-white min-h-screen overflow-hidden">

      {/* ─── HERO ─────────────────────────────────────────── */}
      <section className="relative bg-gradient-to-br from-[#1a5c2a] via-[#267a38] to-[#3a9e50] pt-24 pb-32 px-4 overflow-hidden">
        {/* decorative circles */}
        <div className="absolute -top-16 -right-16 w-72 h-72 rounded-full bg-white/5 pointer-events-none" />
        <div className="absolute top-10 -left-10 w-48 h-48 rounded-full bg-[#FFE525]/10 pointer-events-none" />
        <div className="absolute bottom-0 right-1/4 w-32 h-32 rounded-full bg-[#E12B5E]/10 pointer-events-none" />

        <div className="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-10 relative z-10">
          <div className="flex-1 text-center md:text-left">
            {/* badge */}
            <span className="inline-block bg-[#FFE525] text-[#1a5c2a] text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-6">
              Bergabung Sekarang
            </span>

            {/* headline */}
            <h1 className="text-4xl sm:text-5xl md:text-[56px] font-black text-white leading-tight mb-6">
              Jadilah Bagian<br/>
              <span className="text-[#FFE525]">Perubahan</span> Nyata
            </h1>

            <p className="text-white/80 text-base sm:text-lg leading-relaxed max-w-lg mb-8">
              Bersama Taman Zakat, setiap langkahmu memberi dampak bagi ribuan keluarga. Jadilah relawan dan ukir kisah yang berarti.
            </p>

            <a
              href="#form-daftar"
              className="inline-block bg-[#E12B5E] hover:bg-[#c72251] text-white font-bold px-10 py-4 rounded-full text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95"
            >
              Daftar Sekarang →
            </a>
          </div>

          {/* stamp / image */}
          <div className="flex-shrink-0 relative">
            <div className="w-56 h-56 sm:w-64 sm:h-64 relative">
              <Image
                src="/images/icon/cap volunter.svg"
                alt="Cap Volunteer"
                width={280}
                height={280}
                className="w-full h-full object-contain drop-shadow-2xl"
                priority
              />
            </div>
            <SparkIcon className="absolute -top-4 -right-4 w-8 h-8 text-[#FFE525]" />
            <SparkIcon className="absolute -bottom-4 -left-4 w-6 h-6 text-white/60" />
          </div>
        </div>

        {/* wave divider */}
        <div className="absolute bottom-0 left-0 right-0">
          <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" className="w-full">
            <path d="M0 60V30C240 0 480 60 720 40C960 20 1200 50 1440 30V60H0Z" fill="white"/>
          </svg>
        </div>
      </section>

      {/* ─── STATS ─────────────────────────────────────────── */}
      <section className="max-w-4xl mx-auto px-4 -mt-2 pb-16">
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
          {stats.map((s, i) => (
            <div key={i} className="bg-white rounded-2xl border border-zinc-100 shadow-sm p-5 text-center hover:shadow-md transition-shadow">
              <div className="text-3xl sm:text-4xl font-black text-[#267a38] mb-1">{s.number}</div>
              <div className="text-zinc-500 text-sm font-medium">{s.label}</div>
            </div>
          ))}
        </div>
      </section>

      {/* ─── KENAPA JADI VOLUNTEER ─────────────────────────── */}
      <section className="bg-[#F9FBF5] py-16 px-4">
        <div className="max-w-4xl mx-auto">
          <div className="text-center mb-12">
            <div className="inline-flex items-center gap-2 mb-3">
              <SparkIcon className="w-5 h-5 text-[#FFE525]" />
              <span className="text-[#267a38] font-bold uppercase tracking-widest text-sm">Kenapa Jadi Volunteer?</span>
              <SparkIcon className="w-5 h-5 text-[#FFE525]" />
            </div>
            <h2 className="text-2xl sm:text-3xl md:text-4xl font-black text-zinc-800 leading-tight">
              Lebih dari Sekadar Membantu,<br/>
              <span className="text-[#267a38]">Ini tentang Tumbuh Bersama</span>
            </h2>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
            {benefits.map((b, i) => (
              <div key={i} className="bg-white rounded-2xl p-6 border border-zinc-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all flex gap-4 items-start">
                <div className="text-3xl flex-shrink-0 mt-0.5">{b.icon}</div>
                <div>
                  <h3 className="font-bold text-zinc-800 text-base mb-1">{b.title}</h3>
                  <p className="text-zinc-500 text-sm leading-relaxed">{b.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ─── BIDANG KESUKARELAAN ───────────────────────────── */}
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

      {/* ─── DIVIDER QUOTE ─────────────────────────────────── */}
      <section className="bg-[#E12B5E] py-12 px-4">
        <div className="max-w-3xl mx-auto text-center">
          <SparkIcon className="w-8 h-8 text-white/40 mx-auto mb-4" />
          <blockquote className="text-white text-xl sm:text-2xl md:text-3xl font-black leading-snug italic">
            &ldquo;Satu tangan yang memberi lebih baik dari seribu tangan yang hanya menonton.&rdquo;
          </blockquote>
          <p className="text-white/70 text-sm mt-4 font-medium">— Taman Zakat</p>
        </div>
      </section>

      {/* ─── FORM PENDAFTARAN ──────────────────────────────── */}
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
