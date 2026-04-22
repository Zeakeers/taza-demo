"use client";
import { useState, useEffect } from "react";
import Image from "next/image";

/* ───────── tab data ───────── */
const tabs = ["Sejarah", "Visi Misi", "Legalitas", "Profile"] as const;
type Tab = (typeof tabs)[number];

const tabContent: Record<Tab, { topText: React.ReactNode; bottomText: React.ReactNode }> = {
  Sejarah: {
    topText: (
      <>
        <p>
          Yayasan Taman Zakat Indonesia didirikan pada 29 Desember 2018 dengan misi mulia mengentaskan umat dari kemiskinan. Semangat untuk mengalirkan kebaikan dari para donatur kepada penerima manfaat menjadi landasan kami untuk bergerak sebagai lembaga filantropi profesional dan tepercaya.
        </p>
        <p className="mt-6">
          Berawal dari akta No. 34 oleh notaris Wahyu Hidayat, SH, M.Kn, Taman Zakat terus berkembang hingga kini diakui sebagai LAZ Provinsi yang dipercaya oleh masyarakat luas. Kami berkomitmen menjadi tonggak gerakan kebaikan umat melalui berbagai program berkelanjutan.
        </p>
      </>
    ),
    bottomText: (
      <p>
        Hingga tahun 2022, Taman Zakat Indonesia telah membersamai lebih dari 3.000 donatur untuk menyalurkan manfaat kepada lebih dari 300.000 orang di berbagai penjuru wilayah.
      </p>
    ),
  },
  "Visi Misi": {
    topText: (
      <>
        <h4 className="font-bold text-[#7FC248] mb-2">VISI</h4>
        <p className="italic mb-6">
          &quot;Lembaga Filantropi Nasional Terpercaya Dalam Pengembangan Pendidikan, Kesehatan dan Pemberdayaan Masyarakat.&quot;
        </p>
        <h4 className="font-bold text-[#7FC248] mb-2">MISI</h4>
        <ul className="list-disc pl-5 space-y-2">
          <li>Mengoptimalkan seluruh SDM untuk Pemberdayaan Masyarakat</li>
          <li>Memfasilitasi Layanan Pendidikan dan Kesehatan Masyarakat</li>
          <li>Membangun Secara Aktif Jaringan Filantropy Nasional dan Internasional</li>
        </ul>
      </>
    ),
    bottomText: (
      <>
        <h4 className="font-bold text-[#7FC248] mb-2">TUJUAN</h4>
        <ul className="list-disc pl-5 space-y-2">
          <li>Mengembangkan dan menyediakan lembaga pendidikan berkualitas</li>
          <li>Mengembangkan dan membiayai layanan kesehatan masyarakat yang berkualitas</li>
          <li>Memberikan layanan sosial pemberdayaan masyarakat yang berdampak masif</li>
        </ul>
      </>
    ),
  },
  Legalitas: {
    topText: (
      <>
        <p className="mb-4">Taman Zakat Indonesia memiliki legitimasi penuh melalui aspek legal formal berikut:</p>
        <ul className="list-disc pl-5 space-y-2 text-sm">
          <li><strong>SK Dirjen Bimas Islam No. 245 Tahun 2021</strong>: Izin Lembaga Amil Zakat Skala Provinsi</li>
          <li><strong>Rekomendasi BAZNAS Indonesia</strong>: No. 617/ANG/BAZNAS/XI/2020</li>
          <li><strong>SK Kemenkumham</strong>: AHU-AH.01.06.0008536 Tahun 2021 (Perubahan)</li>
          <li><strong>SK Keanggotaan FOZ</strong>: No. 130/SK/PH-FOZ/X/2019 (NA 130.FOZ.2019)</li>
        </ul>
      </>
    ),
    bottomText: (
      <p>
        Legalitas ini merupakan bukti komitmen kami dalam mengelola dana zakat, infaq, dan sedekah secara amanah, transparan, dan sesuai peraturan perundang-undangan.
      </p>
    ),
  },
  Profile: {
    topText: (
      <>
        <p>
          Taman Zakat merupakan Lembaga Filantropi Profesional yang berfokus pada sarana dakwah untuk pengembangan Al-Qur&apos;an, Pendidikan, Kesehatan dan Kemanusiaan. Berdiri sejak tahun 2018, kami terus berinovasi untuk memberikan dampak maksimal.
        </p>
        <p className="mt-6">
          Visi kami adalah memfasilitasi perkembangan generasi yang penuh berkah. Melalui gerakan #BerbagiBersama, kami mengajak masyarakat untuk meluaskan manfaat dan menjadi mitra terbaik bagi Sobat Zakat semua.
        </p>
      </>
    ),
    bottomText: (
      <p>
        Kami bermimpi menjadi salah satu tulang punggung gerakan kebaikan ummat, menghadirkan solusi nyata bagi kemiskinan dan keterdesakan sosial di Indonesia.
      </p>
    ),
  },
};

/* ───────── milestone data ───────── */
const milestones = [
  {
    year: "2018",
    title: "Pendirian Taman Zakat",
    color: "#5DA630",
    align: "left" as const,
    logoRender: () => (
      <div className="py-4 px-6 md:pr-10">
        <Image src="/images/icon/Taman Zakat Logo.svg" alt="Taman Zakat" width={240} height={100} className="relative z-10 w-40 md:w-56 lg:w-64" />
      </div>
    )
  },
  {
    year: "2019",
    title: "Masuk Dalam Keanggotaan\nFOZ - FORUM ZAKAT",
    color: "#E23E3E",
    align: "right" as const,
    logoRender: () => (
      <div className="py-4 px-6 md:pr-10">
        <Image src="/images/icon/Forum Zakat.svg" alt="FOZ" width={200} height={100} className="w-32 md:w-48 lg:w-56 object-contain" />
      </div>
    )
  },
  {
    year: "2020",
    title: "Rekomendasi LAZ\nProvinsi dari BAZNAS",
    color: "#5DA630",
    align: "left" as const,
    logoRender: () => (
      <div className="py-4 px-6 md:pr-10">
        <Image src="/images/icon/Logo baznas.svg" alt="BAZNAS" width={200} height={140} className="relative z-10 w-36 md:w-48 lg:w-56" />
      </div>
    )
  },
  {
    year: "2021",
    title: "LAZ Provinsi\ndari Kemenag",
    color: "#38681aff",
    align: "right" as const,
    logoRender: () => (
      <div className="flex items-center justify-center">
        <Image src="/images/icon/iklas_beramal-removebg-preview 1.svg" alt="Kemenag" width={180} height={180} className="w-32 md:w-44 lg:w-52 object-contain" />
      </div>
    )
  },
  {
    year: "2022",
    title: "Rekomendasi LAZ\nProvinsi dari BAZNAS",
    color: "#FDBA12",
    titleColor: "#000000",
    align: "left" as const,
    logoRender: () => (
      <div className="flex items-center justify-center">
        <Image src="/images/icon/WTP.svg" alt="WTP" width={180} height={180} className="w-32 md:w-44 lg:w-52 object-contain" />
      </div>
    )
  },
];

/* ───────── kepengurusan data ───────── */
const kepengurusanTabs = [
  "Dewan Direksi",
  "Dewan Pembina",
  "Dewan Pengawas",
  "Dewan Syariah",
  "Referensi Syariah",
  "Dewan Pakar",
] as const;
type KepengurusanTab = (typeof kepengurusanTabs)[number];

export type TeamMember = {
  name: string;
  role: string;
  image: string;
};

export const kepengurusanData: Record<KepengurusanTab, TeamMember[]> = {
  "Dewan Direksi": [
    { name: "H. Slamet Budiono, S.H., M.M", role: "Direktur Utama", image: "" },
    { name: "Nama Direktur 2", role: "Direktur Operasional", image: "" },
  ],
  "Dewan Pembina": [
    { name: "Nama Pembina 1", role: "Ketua Dewan Pembina", image: "" },
    { name: "Nama Pembina 2", role: "Anggota Dewan Pembina", image: "" },
  ],
  "Dewan Pengawas": [
    { name: "Nama Pengawas 1", role: "Ketua Dewan Pengawas", image: "" },
  ],
  "Dewan Syariah": [
    { name: "Nama Syariah 1", role: "Ketua Dewan Syariah", image: "" },
  ],
  "Referensi Syariah": [
    { name: "Nama Referensi 1", role: "Anggota Referensi Syariah", image: "" },
  ],
  "Dewan Pakar": [
    { name: "Nama Pakar 1", role: "Anggota Dewan Pakar", image: "" },
  ],
};

/* ───────── stat details data ───────── */
const statDetails = {
  wilayah: "Lorem ipsum dolor sit amet, wilayah jangkauan meliputi berbagai pelosok negeri dengan fokus pada daerah tertinggal. Aliquam erat volutpat. Aenean varius, ipsum.",
  manfaat: "Curabitur pretium tincidunt lacus, penerima manfaat merupakan dhuafa dan amil yang berhak. Nulla gravida orci a odio. Nullam varius, turpis et commodo.",
  kebaikan: "Suspendisse dictum feugiat nisl, aksi kebaikan meliputi pendidikan, ekonomi, dan kesehatan. Ut sem vamus vulputate eleifend. Praesent dapibus, neque id cursus.",
};

export default function AboutPage() {
  const [activeTab, setActiveTab] = useState<Tab>("Sejarah");
  const [activeKepengurusan, setActiveKepengurusan] = useState<KepengurusanTab>("Dewan Direksi");
  const [activeColor, setActiveColor] = useState<string>("#5DA630");
  const [activeModalInfo, setActiveModalInfo] = useState<string | null>(null);

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const color = entry.target.getAttribute("data-color");
            if (color) setActiveColor(color);
          }
        });
      },
      {
        // Zona observasi diatur pada 20vh, tepat di mana titik bertabrakan
        rootMargin: "-20% 0px -75% 0px",
      }
    );

    const elements = document.querySelectorAll(".milestone-container");
    elements.forEach((el) => observer.observe(el));

    return () => observer.disconnect();
  }, []);

  return (
    <section className="w-full min-h-screen flex flex-col bg-white">
      {/* HERO */}
      <header className="relative w-full h-[480px] md:h-[580px] overflow-hidden">
        {/* Background Image */}
        <Image
          src="/images/gambardetaile/Gemini_Generated_Image_iu64lviu64lviu64 1.svg"
          alt="Hero background"
          fill
          className="object-cover object-center"
          priority
        />

        {/* Container for the Card */}
        <div className="relative z-20 mx-auto w-full max-w-[1240px] h-full flex items-center justify-center md:justify-end px-4 sm:px-6 lg:px-8">
          {/* Card */}
          <div className="bg-[#F9F9F9] p-8 md:p-12 w-full max-w-[460px] shadow-2xl flex flex-col items-center text-center">
            <h1 className="text-black text-[24px] md:text-[28px] font-bold leading-tight">
              Hal paling sia-sia adalah <br />saat kita diam tanpa <br />melakukan apa-apa.
            </h1>

            <div className="mt-6 mb-4 text-zinc-800 text-[11px] md:text-xs font-bold tracking-wider uppercase flex flex-col items-center">
              <div className="flex items-center gap-2">
                <span className="w-5 h-[1px] bg-zinc-400 block"></span>
                <span>H. SLAMET BUDIONO, S.H., M.M</span>
                <span className="w-5 h-[1px] bg-zinc-400 block"></span>
              </div>
              <span className="mt-1 text-[#7FC248]">FOUNDER & CEO TAMAN ZAKAT</span>
            </div>

            <p className="mt-5 text-zinc-700 text-sm md:text-[15px] leading-relaxed italic">
              &quot;Semangat kami adalah memastikan setiap titipan kebaikan Anda mengalir menjadi keberkahan yang nyata bagi mereka yang paling membutuhkan.&quot;
            </p>

            <button className="mt-8 bg-[#FDBA12] hover:bg-[#E5A810] text-black font-semibold px-8 py-3 rounded-sm transition-colors duration-200 uppercase tracking-widest text-xs">
              Zakat Sekarang
            </button>
          </div>
        </div>
      </header>

      <main>
        {/* TONGGAK PERJALANAN  (Milestones) */}
        <section className="relative pt-16 md:pt-20 pb-16 md:pb-20 z-0">
          {/* Static Background that scrolls normally */}
          <div className="absolute top-0 left-0 w-full h-[410px] sm:h-[460px] md:h-[540px] bg-white -z-10" />
          <div className="absolute top-[410px] sm:top-[460px] md:top-[540px] bottom-0 left-0 w-full bg-[#FCF8ED] -z-10" />

          <div className="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 relative z-0">
            <h2 className="text-center text-2xl md:text-3xl font-bold text-black">
              Tonggak Perjalanan
            </h2>
            <p className="text-center text-sm md:text-base text-zinc-500 mt-2">
              Momen Penting dalam Transformasi Organisasi
            </p>

            {/* timeline */}
            <div className="relative mt-20 max-w-4xl mx-auto w-full">
              {/* vertical line track */}
              <div className="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-[1px] bg-zinc-300 block" />

              <div className="flex flex-col w-full">
                {milestones.map((m) => (
                  <div
                    key={m.year}
                    data-year={m.year}
                    data-color={m.color}
                    className="relative w-full h-[50vh] md:h-[60vh] milestone-container"
                  >
                    <div className="sticky top-[20vh] w-full flex flex-row items-center justify-between py-6 md:py-8 pointer-events-none z-10 transition-transform duration-300">

                      {/* Left Side Content */}
                      <div className="w-1/2 flex justify-end pr-4 sm:pr-8 md:pr-14 pointer-events-auto">
                        {m.align === "left" ? (
                          <div className="scale-[0.8] sm:scale-90 md:scale-100 origin-right flex items-center">{m.logoRender()}</div>
                        ) : (
                          <div className="flex flex-col text-right p-2 sm:p-4 md:p-0">
                            <span className="text-2xl md:text-3xl lg:text-4xl font-bold" style={{ color: m.color }}>
                              {m.year}
                            </span>
                            <h3 className="text-base md:text-lg lg:text-xl whitespace-pre-line mt-2 font-semibold leading-relaxed text-black">
                              {m.title}
                            </h3>
                          </div>
                        )}
                      </div>

                      {/* Center dot */}
                      <div
                        className={`flex absolute left-1/2 -translate-x-1/2 w-3 h-3 md:w-4 md:h-4 rounded-full bg-transparent border-2 z-20 transition-colors duration-500`}
                        style={{ borderColor: activeColor }}
                      />

                      {/* Right Side Content */}
                      <div className="w-1/2 flex justify-start pl-4 sm:pl-8 md:pl-14 pointer-events-auto">
                        {m.align === "left" ? (
                          <div className="flex flex-col text-left p-2 sm:p-4 md:p-0">
                            <span className="text-2xl md:text-3xl lg:text-4xl font-bold" style={{ color: m.color }}>
                              {m.year}
                            </span>
                            <h3 className="text-base md:text-lg lg:text-xl whitespace-pre-line mt-2 font-semibold leading-relaxed text-black">
                              {m.title}
                            </h3>
                          </div>
                        ) : (
                          <div className="scale-[0.8] sm:scale-90 md:scale-100 origin-left flex items-center">{m.logoRender()}</div>
                        )}
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>

        {/* MENGENAL LEBIH DEKAT  (Tabs) */}
        <section id="mengenal" className="py-16 md:py-20 bg-[#FAFAFA]">
          <div className="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <h2 className="text-center text-[26px] md:text-3xl font-bold text-black font-[var(--font-newsreader)]">
              Mengenal Lebih Dekat
            </h2>
            <p className="text-center text-sm md:text-base text-black mt-2 font-medium">
              Semua yang ingin Anda ketahui tentang Taman Zakat
            </p>

            {/* Tab buttons */}
            <div className="mt-12 w-full flex justify-between border-b-[2px] border-[#71C935] overflow-x-auto [scrollbar-width:none]">
              {tabs.map((t) => (
                <button
                  key={t}
                  onClick={() => setActiveTab(t)}
                  className={`px-4 sm:px-8 pb-3 text-[15px] md:text-lg font-semibold whitespace-nowrap outline-none flex-auto text-center ${activeTab === t
                    ? "text-black"
                    : "text-zinc-700 hover:text-black"
                    }`}
                >
                  {t}
                </button>
              ))}
            </div>

            {/* Tab content */}
            <div className="mt-10">
              <div className="flex flex-col md:flex-row gap-6 lg:gap-8">
                {/* Side Image */}
                {activeTab === "Sejarah" && (
                  <div className="h-56 sm:h-[260px] w-full md:w-[320px] lg:w-[380px] bg-[#D9D9D9] flex items-center justify-center flex-shrink-0">
                    <span className="text-white font-bold text-xl md:text-2xl">Gambar</span>
                  </div>
                )}

                {/* Top Text Content */}
                <div className="text-black text-[13px] md:text-[15px] leading-relaxed flex-1">
                  {tabContent[activeTab].topText}
                </div>
              </div>

              {/* Bottom Full-width Text */}
              <div className="mt-6 md:mt-8 text-black text-[13px] md:text-[15px] leading-relaxed">
                {tabContent[activeTab].bottomText}
              </div>
            </div>
          </div>
        </section>

        {/* SUSUNAN KEPENGURUSAN */}
        <section className="py-16 md:py-24 bg-white">
          <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-10">
              <span className="text-[#7FC248] text-[13px] md:text-[15px] font-bold tracking-[0.2em] uppercase">
                STRUKTUR ORGANISASI
              </span>
              <h2 className="text-center text-[28px] md:text-[40px] font-bold text-black mt-4">
                Sinergi Kebaikan untuk Ummat
              </h2>
              <p className="text-center text-[15px] md:text-[18px] text-gray-600 mt-5 max-w-[850px] mx-auto leading-relaxed font-medium">
                Tim eksekutif kami terdiri dari para profesional dan praktisi filantropi yang berdedikasi tinggi untuk memastikan setiap amanah donatur terkelola secara transparan, akuntabel, dan berdampak luas.
              </p>
            </div>

            <div className="mt-14 flex flex-col md:flex-row gap-10 lg:gap-20 items-stretch">
              {/* Sidebar Tabs */}
              <div className="w-full md:w-[35%] flex flex-col border border-zinc-300 rounded-2xl py-8 px-4 gap-4 bg-[#5DA630] self-start shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                {kepengurusanTabs.map((tab) => (
                  <button
                    key={tab}
                    onClick={() => setActiveKepengurusan(tab)}
                    className={`text-center px-4 py-2.5 rounded-lg text-[16px] md:text-[18px] transition-colors mx-4 sm:mx-8 ${activeKepengurusan === tab
                      ? "bg-[#7FC248] text-white"
                      : "bg-transparent text-white hover:bg-black/5"
                      }`}
                  >
                    {tab}
                  </button>
                ))}
              </div>

              {/* Content Grid */}
              <div className="w-full md:w-[65%]">
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-10">
                  {kepengurusanData[activeKepengurusan].map((member, idx) => (
                    <div key={idx} className="flex flex-col bg-[#7FC248] rounded-xl overflow-hidden shadow-[0_4px_25px_rgba(180,210,180,0.4)] pb-8 border border-white">
                      {/* Foto */}
                      {member.image ? (
                        <div className="relative w-full h-56 md:h-64 rounded-t-xl overflow-hidden">
                          <Image src={member.image} alt={member.name} fill className="object-cover" />
                        </div>
                      ) : (
                        <div className="w-full h-56 md:h-64 bg-[#EAEAEA] rounded-t-xl flex items-center justify-center">
                          <span className="text-zinc-400 text-sm font-medium">Foto area</span>
                        </div>
                      )}

                      {/* Nama & Posisi */}
                      <div className="flex flex-col items-center pt-5 px-4 text-center bg-[#7FC248]">
                        <h4 className="text-white font-medium text-[15px] md:text-[16px]">{member.name}</h4>
                        <p className="text-white text-[12px] md:text-[13px] mt-1.5 font-medium">{member.role}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* STATS COUNTER */}
        <section className="py-16 md:py-24 bg-[#7FC248]">
          <div className="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <h2 className="text-center text-white text-[20px] md:text-[24px] mb-12 md:mb-16 tracking-wide font-medium">
              Taman Zakat impact to date
            </h2>
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-12 md:gap-8 text-center">
              <div className="flex flex-col items-center">
                <h3 className="text-[44px] md:text-[54px] font-bold text-white mb-2 leading-none">47</h3>
                <div className="flex items-center gap-2 text-white text-sm md:text-[15px] font-medium">
                  Wilayah Jangkauan
                  <button onClick={() => setActiveModalInfo(statDetails.wilayah)} className="w-[18px] h-[18px] rounded-full bg-white text-black text-[12px] font-bold flex items-center justify-center outline-none hover:scale-110 transition-transform cursor-pointer">?</button>
                </div>
              </div>
              <div className="flex flex-col items-center">
                <h3 className="text-[44px] md:text-[54px] font-bold text-white mb-2 leading-none">102.088</h3>
                <div className="flex items-center gap-2 text-white text-sm md:text-[15px] font-medium">
                  Penerima Manfaat
                  <button onClick={() => setActiveModalInfo(statDetails.manfaat)} className="w-[18px] h-[18px] rounded-full bg-white text-black text-[12px] font-bold flex items-center justify-center outline-none hover:scale-110 transition-transform cursor-pointer">?</button>
                </div>
              </div>
              <div className="flex flex-col items-center">
                <h3 className="text-[44px] md:text-[54px] font-bold text-white mb-2 leading-none">19</h3>
                <div className="flex items-center gap-2 text-white text-sm md:text-[15px] font-medium">
                  Aksi Kebaikan
                  <button onClick={() => setActiveModalInfo(statDetails.kebaikan)} className="w-[18px] h-[18px] rounded-full bg-white text-black text-[12px] font-bold flex items-center justify-center outline-none hover:scale-110 transition-transform cursor-pointer">?</button>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* QUOTE / VALUE SECTION */}
        <section className="py-16 md:py-24 bg-white">
          <div className="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div className="flex flex-col md:flex-row items-center md:items-start gap-12 md:gap-16">
              {/* Left Box */}
              <div className="relative w-full max-w-[280px] md:max-w-[340px] aspect-[4/3] flex-shrink-0 mx-auto md:mx-0">
                {/* Yellow dot top left */}
                <div className="absolute -top-4 -left-6 w-1.5 h-1.5 rounded-full bg-[#FDE047] z-20 hidden md:block"></div>

                {/* gamabr bagian kiri*/}
                <div className="w-full h-full border border-zinc-200/60 bg-[#FAFAFA] relative z-10 mt-6 md:mt-0 shadow-[10px_10px_15px_rgba(0,0,0,0.06)] flex items-center justify-center overflow-hidden">

                  {/* hapus saja kalo sudah ada gamabrnya */}
                  <span className="text-zinc-400 text-sm font-medium">Foto area</span>

                  {/* Contoh kode Image siap pakai, hilangkan tanda komentar untuk menggunakannya */}
                  {/* 
                   <Image 
                     src="/images/your-image-path.jpg" 
                     alt="You have our word image" 
                     fill 
                     className="object-cover" 
                   /> 
                   */}
                </div>

                {/* Taza Badge top right corner */}
                <div className="absolute top-2 -right-5 md:-top-6 md:-right-8 z-20">
                  <div className="relative h-[68px] w-[68px]">
                    <div
                      aria-hidden
                      className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]"
                    />
                    <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#7FC248]">
                      {/* Animasi spin infinite untuk teks */}
                      <svg
                        viewBox="0 0 300 300"
                        aria-hidden
                        className="absolute inset-0 h-full w-full fill-black animate-[spin_10s_linear_infinite]"
                      >
                        <defs>
                          <path
                            id="about-badge-path"
                            d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224"
                          />
                        </defs>
                        <text fontSize="30" fontWeight="500" className="font-newsreader">
                          <textPath
                            href="#about-badge-path"
                            startOffset="50%"
                            textAnchor="middle"
                            textLength="680"
                            lengthAdjust="spacing"
                          >
                            Taman Zakat - Indonesia - taza -
                          </textPath>
                        </text>
                      </svg>

                      {/* Ikon tengah statis */}
                      <div className="relative z-10 flex h-[32px] w-[32px] items-center justify-center rounded-full border-[2px] border-black bg-[#7FC248]">
                        <Image
                          src="/images/icon/hitam logo taza 1.svg"
                          alt="Logo Taza hitam"
                          width={26}
                          height={30}
                          className="h-[22px] w-auto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {/* Right Text */}
              <div className="flex-1 text-center md:text-left pt-4 md:pt-14 md:pl-8">
                <h3 className="text-black text-[22px] md:text-[26px] leading-tight mb-4 font-semibold text-zinc-800">
                  Kepuasan Anda adalah Amanah Kami
                </h3>
                <p className="text-[#333333] text-[15px] md:text-[17px] leading-relaxed max-w-[500px] mx-auto md:mx-0">
                  Setiap dana Zakat, Infaq, dan Sedekah yang Anda percayakan kepada kami akan dikelola dengan standar audit yang ketat. Kami memastikan 100% amanah disalurkan kepada program-program Al-Qur&apos;an, Pendidikan, Kesehatan, dan Kemanusiaan.
                </p>
              </div>
            </div>
          </div>
        </section>

        {/* PENGHARGAAN TAMAN ZAKAT */}
        <section className="bg-[#5DA630] py-20 relative mt-0 pb-28">
          {/* Title Badge Overlapping */}
          <div className="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[320px] sm:max-w-[400px]">
            <div className="bg-[#1F4E27] rounded-2xl shadow-[0_4px_16px_rgba(0,0,0,0.15)] px-6 py-4 border-b-4 border-zinc-200 text-center">
              <h2 className="text-xl md:text-2xl font-semibold text-white">
                Penghargaan Taman Zakat
              </h2>
            </div>
          </div>

          <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 mt-14">
            {/* Awards grid */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
              <div className="rounded-xl overflow-hidden shadow-xl hover:scale-105 transition-transform bg-white">
                <Image
                  src="/images/gambardetaile/fundraising award.jpg"
                  alt="Fundraising Award"
                  width={600}
                  height={600}
                  className="w-full h-auto object-cover"
                />
              </div>
              <div className="rounded-xl overflow-hidden shadow-xl hover:scale-105 transition-transform bg-white">
                <Image
                  src="/images/gambardetaile/wtp award.jpeg"
                  alt="WTP Award 2023"
                  width={600}
                  height={600}
                  className="w-full h-auto object-cover"
                />
              </div>
              <div className="rounded-xl overflow-hidden shadow-xl hover:scale-105 transition-transform bg-white">
                <Image
                  src="/images/gambardetaile/aww 1.png"
                  alt="WTP Award 2022"
                  width={600}
                  height={600}
                  className="w-full h-auto object-contain"
                />
              </div>
            </div>
          </div>
        </section>

        {/* OPPORTUNITIES CTA */}
        {/* <section className="bg-[#f8eed3]">
          <div className="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-20 md:py-10 text-center flex flex-col items-center">
            <div className="text-[#9FB3C8] text-[13px] md:text-[15px] font-medium tracking-widest uppercase mb-4">
              OPPORTUNITIES
            </div>
            <h2 className="text-[32px] md:text-[44px] font-medium text-black mb-4">
              Change the world with us
            </h2>
            <p className="text-black text-[16px] md:text-[18px] mb-10 font-medium">
              Explore our openings and join the team
            </p>
            <a href="#" className="text-black font-semibold text-[15px] md:text-[16px] pb-1 border-b-[2px] border-[#7FC248] hover:text-[#7FC248] transition-colors">
              Salurkan Kebaikan
            </a>
          </div>
        </section> */}

        {/* OVERLAY MODAL */}
        {activeModalInfo && (
          <div className="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 px-4" onClick={() => setActiveModalInfo(null)}>
            <div className="bg-white rounded-md w-full max-w-xl p-8 md:p-10 relative shadow-2xl cursor-default" onClick={(e) => e.stopPropagation()}>
              <button
                onClick={() => setActiveModalInfo(null)}
                className="absolute top-4 right-4 text-zinc-400 hover:text-black w-8 h-8 flex items-center justify-center rounded-full hover:bg-zinc-100 transition-colors"
                aria-label="Close modal"
              >
                <span className="text-2xl leading-none">&times;</span>
              </button>
              <h4 className="text-[#9FB3C8] text-[13px] md:text-[14px] font-bold tracking-widest uppercase mb-6">
                THE DETAILES
              </h4>
              <p className="text-black text-[15px] md:text-[16px] leading-[1.6] font-medium">
                {activeModalInfo}
              </p>
            </div>
          </div>
        )}

      </main>
    </section>
  );
}
