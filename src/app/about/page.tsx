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
          Semangat untuk mengalirkan kebaikan dari para donatur kepada penerima manfaat menjadi landasan Taman Zakat Indonesia untuk bergerak sebagai lembaga filantropi profesional dan tepercaya. Berfokus pada sarana dakwah untuk pengembangan Alquran, pendidikan, kesehatan, dan kemanusiaan, kami memfasilitasi perkembangan generasi yang penuh berkah.
        </p>
        <p className="mt-6">
          Semangat untuk mengalirkan kebaikan dari para donatur kepada penerima manfaat menjadi landasan Taman Zakat Indonesia untuk bergerak sebagai lembaga filantropi profesional dan tepercaya. Berfokus Semangat untuk mengalirkan kebaikan dari para donatur kepada penerima manfaat menjadi landasan Taman Zakat Indonesia untuk bergerak sebagai lembaga filantropi profesional dan tepercaya.
        </p>
      </>
    ),
    bottomText: (
      <p>
        Berfokus pada sarana dakwah untuk pengembangan Alquran, pendidikan, kesehatan, dan kemanusiaan, kami memfasilitasi perkembangan generasi yang penuh berkah.pada sarana dakwah untuk pengembangan Alquran, pendidikan, kesehatan, dan kemanusiaan, kami memfasilitasi perkembangan generasi yang penuh berkah.
      </p>
    ),
  },
  "Visi Misi": {
    topText: (
      <>
        <p>
          Visi kami adalah menjadi lembaga pengelola zakat yang amanah, profesional, dan berdampak luas bagi umat. Misi kami meliputi:
        </p>
        <ol className="list-decimal pl-5 mt-4 space-y-2">
          <li>Mengoptimalkan penghimpunan zakat, infaq, sedekah dan dana sosial kemanusiaan.</li>
          <li>Menyalurkan dana secara tepat sasaran kepada mustahik.</li>
          <li>Mengembangkan program pemberdayaan masyarakat yang berkelanjutan.</li>
          <li>Membangun kepercayaan publik melalui transparansi dan akuntabilitas.</li>
        </ol>
      </>
    ),
    bottomText: (
      <p>
        Kami terus berinovasi dalam menjalankan program-program dakwah untuk Pengembangan Al-Qur&apos;an, Pendidikan, Kesehatan dan Kemanusiaan. Sebagai lembaga filantropi profesional, kami berkomitmen untuk menjadi tulang punggung gerakan kebaikan ummat dengan memfasilitasi perkembangan generasi yang penuh berkah.
      </p>
    ),
  },
  Legalitas: {
    topText: (
      <>
        <p>
          Taman Zakat Indonesia merupakan lembaga yang telah resmi terdaftar dan memiliki legalitas yang lengkap:
        </p>
        <ul className="list-disc pl-5 mt-4 space-y-2">
          <li>SK Kemenkumham RI: lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</li>
          <li>NPWP Lembaga: lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</li>
          <li>Terdaftar di BAZNAS (Badan Amil Zakat Nasional)</li>
          <li>Anggota FOZ (Forum Zakat)</li>
          <li>Predikat WTP (Wajar Tanpa Pengecualian) dari auditor independen</li>
          <li>SK Gubernur Jawa Timur tentang Izin Operasional LAZ</li>
        </ul>
      </>
    ),
    bottomText: (
      <p>
        Seluruh kegiatan penghimpunan dan penyaluran dana dilakukan sesuai dengan peraturan perundang-undangan yang berlaku dan diaudit secara berkala oleh akuntan publik independen.
      </p>
    ),
  },
  Profile: {
    topText: (
      <>
        <p>
          Taman Zakat Indonesia didirikan pada tahun 2016 dengan semangat untuk menjadi lembaga filantropi yang profesional dan terpercaya. Berawal dari kepedulian terhadap kondisi masyarakat, kami terus berkembang dan berinovasi dalam mengelola dana zakat, infaq, sedekah, dan dana sosial kemanusiaan.
        </p>
        <p className="mt-6">
          Dalam perjalanannya, Taman Zakat Indonesia telah mendapatkan pengakuan dari berbagai pihak, termasuk BAZNAS, FOZ (Forum Zakat), dan mendapatkan predikat WTP (Wajar Tanpa Pengecualian) yang merupakan bukti komitmen kami terhadap transparansi dan akuntabilitas.
        </p>
      </>
    ),
    bottomText: (
      <p>
        Kantor Pusat kami berlokasi di Jl. Wisma Trosobo IV No. 33, Kel. Trosobo, Kec. Taman, Kab. Sidoarjo, Prov. Jawa Timur. Kami juga memiliki jaringan layanan yang tersebar di berbagai wilayah Indonesia.
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
        <Image src="/images/icon/Taman Zakat Logo.svg" alt="Taman Zakat" width={180} height={80} className="relative z-10 w-32 md:w-40" />
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
        <Image src="/images/icon/Forum Zakat.svg" alt="FOZ" width={130} height={60} className="w-24 md:w-32 object-contain" />
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
        <Image src="/images/icon/Logo baznas.svg" alt="BAZNAS" width={140} height={100} className="relative z-10 w-28 md:w-40" />
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
         <Image src="/images/icon/iklas_beramal-removebg-preview 1.svg" alt="Kemenag" width={120} height={120} className="w-24 md:w-32 object-contain" />
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
         <Image src="/images/icon/WTP.svg" alt="WTP" width={120} height={120} className="w-24 md:w-32 object-contain" />
      </div>
    )
  },
];

/* ───────── kepengurusan data ───────── */
const kepengurusanTabs = [
  "Board of Director",
  "Board of Trustee",
  "Board of Trustees",
  "Sharia Council",
  "Sharia Reference",
  "Expert Council",
] as const;
type KepengurusanTab = (typeof kepengurusanTabs)[number];

export type TeamMember = {
  name: string;
  role: string;
  image: string;
};

export const kepengurusanData: Record<KepengurusanTab, TeamMember[]> = {
  "Board of Director": [
    { name: "Nama Direktur 1", role: "Jabatan Direktur", image: "" },
    { name: "Nama Direktur 2", role: "Jabatan Direktur", image: "" },
  ],
  "Board of Trustee": [
    { name: "H. Slamet Budiono, S.H., M.M", role: "Chief Executive Officer", image: "" },
    { name: "Nama Trustee 2", role: "Role Trustee", image: "" },
  ],
  "Board of Trustees": [
    { name: "Nama Trustees 1", role: "Role Trustees", image: "" },
  ],
  "Sharia Council": [
    { name: "Nama Sharia Council 1", role: "Role Sharia Council", image: "" },
  ],
  "Sharia Reference": [
    { name: "Nama Sharia Reference 1", role: "Role Sharia Reference", image: "" },
  ],
  "Expert Council": [
    { name: "Nama Expert Council 1", role: "Role Expert Council", image: "" },
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
  const [activeKepengurusan, setActiveKepengurusan] = useState<KepengurusanTab>("Board of Trustee");
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
              The craziest thing we can<br />do is nothing.
            </h1>
            
            <div className="mt-6 text-zinc-800 text-[11px] md:text-xs font-bold tracking-wider uppercase flex flex-col items-center">
              <div className="flex items-center gap-2">
                <span className="w-5 h-[1.5px] bg-zinc-800 block"></span>
                <span>PAK SLAMET, FOUNDER & CEO OF</span>
              </div>
              <span className="mt-1">TAMAN ZAKAT</span>
            </div>
            
            <p className="mt-5 text-zinc-700 text-sm md:text-[15px] leading-relaxed">
              Slamet journey from nightclub promoter to founding a global nonprofit is proof that anyone can make a difference. Join his mission to bring clean and safe water to everyone on earth.
            </p>
            
            <button className="mt-8 bg-[#FDBA12] hover:bg-[#E5A810] text-black font-semibold px-8 py-3 rounded-sm transition-colors duration-200">
              Small Kindness
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
                             <span className="text-lg md:text-2xl font-bold" style={{ color: m.color }}>
                               {m.year}
                             </span>
                             <h3 className="text-sm md:text-base whitespace-pre-line mt-1 font-semibold leading-relaxed text-black">
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
                             <span className="text-lg md:text-2xl font-bold" style={{ color: m.color }}>
                               {m.year}
                             </span>
                             <h3 className="text-sm md:text-base whitespace-pre-line mt-1 font-semibold leading-relaxed text-black">
                               {m.title}
                             </h3>
                          </div>
                        ) : (
                          <div className={`scale-[0.8] sm:scale-90 md:scale-100 origin-left flex items-center ${m.year === '2019' ? 'bg-white rounded-xl shadow-md p-4 z-20 relative' : ''}`}>{m.logoRender()}</div>
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
                  className={`px-4 sm:px-8 pb-3 text-[15px] md:text-lg font-semibold whitespace-nowrap outline-none flex-auto text-center ${
                    activeTab === t
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
        <section className="py-16 md:py-24 bg-[#FAF7F0]">
          <div className="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div className="text-center mb-10">
              <span className="text-[#3b7ee2] text-[13px] md:text-[15px] font-medium tracking-wide uppercase">
                THE EXECUTIVE TEAM
              </span>
              <h2 className="text-center text-[28px] md:text-[36px] font-medium text-black mt-4">
                Change the world with us
              </h2>
              <p className="text-center text-[15px] md:text-[18px] text-black mt-5 max-w-[800px] mx-auto leading-relaxed">
                Our executive team brings a wealth of experience, passion, and vision to guide our work and ensure we stay true to our values.
              </p>
            </div>

            <div className="mt-14 flex flex-col md:flex-row gap-10 lg:gap-20 items-stretch">
              {/* Sidebar Tabs */}
              <div className="w-full md:w-[35%] flex flex-col border border-zinc-300 rounded-2xl py-8 px-4 gap-4 bg-[#FAF7F0] self-start shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                {kepengurusanTabs.map((tab) => (
                  <button
                    key={tab}
                    onClick={() => setActiveKepengurusan(tab)}
                    className={`text-center px-4 py-2.5 rounded-lg text-[16px] md:text-[18px] transition-colors mx-4 sm:mx-8 ${
                      activeKepengurusan === tab
                        ? "bg-[#9FB3C8] text-white"
                        : "bg-transparent text-black hover:bg-black/5"
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
                    <div key={idx} className="flex flex-col bg-[#FAF7F0] rounded-xl overflow-hidden shadow-[0_4px_25px_rgba(180,210,180,0.4)] pb-8 border border-white">
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
                       <div className="flex flex-col items-center pt-5 px-4 text-center bg-[#FAF7F0]">
                         <h4 className="text-[#3b7ee2] font-medium text-[15px] md:text-[16px]">{member.name}</h4>
                         <p className="text-zinc-500 text-[12px] md:text-[13px] mt-1.5 font-medium">{member.role}</p>
                       </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* STATS COUNTER */}
        <section className="py-16 md:py-24 bg-[#0A0A0A]">
          <div className="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <h2 className="text-center text-[#9FB3C8] text-[20px] md:text-[24px] mb-12 md:mb-16 tracking-wide font-medium">
              Taman Zakat impact to date
            </h2>
            <div className="grid grid-cols-1 sm:grid-cols-3 gap-12 md:gap-8 text-center">
              <div className="flex flex-col items-center">
                <h3 className="text-[44px] md:text-[54px] font-bold text-white mb-2 leading-none">47</h3>
                <div className="flex items-center gap-2 text-white text-sm md:text-[15px] font-medium">
                  Wilayah Jangkauan
                  <button onClick={() => setActiveModalInfo(statDetails.wilayah)} className="w-[18px] h-[18px] rounded-full bg-[#7FC248] text-black text-[12px] font-bold flex items-center justify-center outline-none hover:scale-110 transition-transform cursor-pointer">?</button>
                </div>
              </div>
              <div className="flex flex-col items-center">
                <h3 className="text-[44px] md:text-[54px] font-bold text-white mb-2 leading-none">102.088</h3>
                <div className="flex items-center gap-2 text-white text-sm md:text-[15px] font-medium">
                  Penerima Manfaat
                  <button onClick={() => setActiveModalInfo(statDetails.manfaat)} className="w-[18px] h-[18px] rounded-full bg-[#7FC248] text-black text-[12px] font-bold flex items-center justify-center outline-none hover:scale-110 transition-transform cursor-pointer">?</button>
                </div>
              </div>
              <div className="flex flex-col items-center">
                <h3 className="text-[44px] md:text-[54px] font-bold text-white mb-2 leading-none">19</h3>
                <div className="flex items-center gap-2 text-white text-sm md:text-[15px] font-medium">
                  Aksi Kebaikan
                  <button onClick={() => setActiveModalInfo(statDetails.kebaikan)} className="w-[18px] h-[18px] rounded-full bg-[#7FC248] text-black text-[12px] font-bold flex items-center justify-center outline-none hover:scale-110 transition-transform cursor-pointer">?</button>
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
                   You have our word—and more
                 </h3>
                 <p className="text-[#333333] text-[15px] md:text-[17px] leading-relaxed max-w-[500px] mx-auto md:mx-0">
                   When charity: water began, we made a bold promise: 100% of public donations would go directly to fund clean water projects. Private donors cover our operating costs so 100% of your money can fund water projects.
                 </p>
              </div>
            </div>
          </div>
        </section>

        {/* PENGHARGAAN TAMAN ZAKAT */}
        <section className="bg-[#32446B] py-20 relative mt-0 pb-28">
          {/* Title Badge Overlapping */}
          <div className="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[320px] sm:max-w-[400px]">
            <div className="bg-white rounded-2xl shadow-[0_4px_16px_rgba(0,0,0,0.15)] px-6 py-4 border-b-4 border-zinc-200 text-center">
              <h2 className="text-xl md:text-2xl font-semibold text-[#6B96D9]">
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
        <section className="bg-[#f8eed3]">
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
        </section>

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
