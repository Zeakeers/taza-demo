import Link from "next/link";
import Image from "next/image";

export default function RamadhanPage() {
  const ramadhanPrograms = [
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Mari lipatgandakan pahala kita dengan ikut berbagi buka puasa lewat paket ifthar lengkap yang istimewa untuk mereka",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Hadirkan keceriaan pada wajah anak-anak yatim daerah di hari lebaran dengan memberikan kado lebaran yakni, baju lebaran, sarung, mukena, sajadah, dsb.",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Mari lipatgandakan pahala kita dengan ikut berbagi buka puasa lewat paket ifthar lengkap yang istimewa untuk mereka",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Hadirkan keceriaan pada wajah anak-anak yatim daerah di hari lebaran dengan memberikan kado lebaran yakni, baju lebaran, sarung, mukena, sajadah, dsb.",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Mari lipatgandakan pahala kita dengan ikut berbagi buka puasa lewat paket ifthar lengkap yang istimewa untuk mereka",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Hadirkan keceriaan pada wajah anak-anak yatim daerah di hari lebaran dengan memberikan kado lebaran yakni, baju lebaran, sarung, mukena, sajadah, dsb.",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Mari lipatgandakan pahala kita dengan ikut berbagi buka puasa lewat paket ifthar lengkap yang istimewa untuk mereka",
      link: "#"
    },
    {
      title: "Buka Puasa Yatim Dhuafa & Da'i",
      description: "Hadirkan keceriaan pada wajah anak-anak yatim daerah di hari lebaran dengan memberikan kado lebaran yakni, baju lebaran, sarung, mukena, sajadah, dsb.",
      link: "#"
    }
  ];

  return (
    <div className="w-full flex flex-col bg-[#FAF7F0] overflow-x-hidden">
      <style dangerouslySetInnerHTML={{ __html: `
        @keyframes borderWiggle {
          0%   { transform: translateX(-4px) rotate(-2deg); }
          50%  { transform: translateX(-4px) rotate(2deg); }
          100% { transform: translateX(-4px) rotate(-2deg); }
        }
        .border-wiggle {
          animation: borderWiggle 2.5s ease-in-out infinite;
          transform-origin: center center;
        }
      `}} />
      
      {/* 1. Hero Section */}
      <section className="relative w-full min-h-[400px] md:min-h-[500px] bg-black flex flex-col items-center justify-center px-4 py-16">
        {/* Placeholder for Background Image */}
        <div className="absolute inset-0 bg-zinc-900 z-0 opacity-50"></div>
        
        {/* Decorative elements - Left Empty Placeholder */}
        <div className="absolute top-0 left-0 w-32 h-48 bg-transparent z-10"></div>
        {/* Decorative elements - Right Empty Placeholder */}
        <div className="absolute bottom-0 right-1/4 w-16 h-32 bg-transparent z-10"></div>

        <div className="relative z-20 text-center flex flex-col items-center max-w-3xl mt-10">
          <h1 className="text-white text-5xl md:text-6xl lg:text-7xl font-ramadhan mb-4 tracking-wider">
            RAMADHAN Kareem
          </h1>
          <h2 className="text-zinc-200 text-lg md:text-xl font-newsreader mb-2 font-medium">
            Terangi Dunia dengan Kebaikan
          </h2>
          <p className="text-zinc-400 text-sm md:text-base font-medium mb-10 max-w-xl">
            Satu langkah sederhana Anda dapat membawa harapan bagi banyak orang
          </p>
          
          {/* Donasi Button */}
          <div className="relative inline-block mt-6">
            <div
              aria-hidden
              className="absolute inset-0 z-20 rounded-sm border-2 border-white border-wiggle"
            />
            <Link
              href="#donasi"
              className="relative z-10 inline-block transition-transform duration-150 hover:-translate-y-0.5"
            >
              <div className="relative rounded-sm bg-[#7FC248] px-4 py-2 md:px-5 md:py-2.5">
                <div className="relative z-10 inline-flex items-center gap-2 text-sm font-semibold font-newsreader text-white md:text-base">
                  <span>Donasi Disini</span>
                  <Image
                    src="/images/icon/Donation.svg"
                    alt="Ikon donasi"
                    width={18}
                    height={18}
                    className="h-[18px] w-[18px]"
                  />
                </div>
              </div>
            </Link>
          </div>
        </div>
      </section>

      {/* 2. Program Pilihan Ramadhan Section */}
      <section id="programs" className="w-full py-16 md:py-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl text-zinc-900 font-newsreader mb-4 font-medium">
            Program Pilihan Ramadhan
          </h2>
          <p className="text-zinc-700 text-base md:text-lg max-w-2xl mx-auto">
            Bantu share halaman ini agar lebih banyak doa dan bantuan terkumpul untuk Saudara kita yang membutuhkan
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
          {ramadhanPrograms.map((program, index) => (
            <div key={index} className="w-full flex flex-col sm:flex-row bg-[#151515] rounded-lg overflow-hidden border border-zinc-800 shadow-xl hover:shadow-2xl transition-shadow">
              {/* Image Placeholder */}
              <div className="w-full sm:w-[45%] h-56 sm:h-auto bg-zinc-800 relative shrink-0">
                 {/* Image will go here */}
              </div>
              
              {/* Content */}
              <div className="w-full sm:w-[55%] p-6 md:p-8 flex flex-col justify-center">
                <h3 className="text-white text-xl md:text-2xl font-newsreader font-semibold mb-3">
                  {program.title}
                </h3>
                <p className="text-zinc-400 text-sm leading-relaxed mb-8">
                  {program.description}
                </p>
                
                {/* Button Container aligned to bottom-left */}
                <div className="mt-auto">
                  <div className="relative inline-block mt-4">
                    {/* The outline border to the left */}
                    <div className="absolute top-[4px] -left-1 w-full h-full rounded-sm border-[1px] border-white/40 pointer-events-none"></div>
                    
                    {/* The main button */}
                    <Link
                      href={program.link}
                      className="relative z-10 block bg-white rounded-sm px-4 py-1.5 shadow-sm hover:brightness-95 transition"
                    >
                      <div className="flex items-center gap-2">
                        <span className="text-zinc-900 font-semibold font-newsreader text-sm">
                          Donasi Disini
                        </span>
                        <Image
                          src="/images/icon/hitam logo taza 1.svg"
                          alt="Ikon Taza"
                          width={14}
                          height={14}
                          className="h-[14px] w-auto opacity-80"
                        />
                      </div>
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* 3. Bottom CTA Banner */}
      <section className="relative w-full min-h-[300px] md:min-h-[350px] bg-[#0A0A0A] flex flex-col md:flex-row items-center justify-between px-6 md:px-16 lg:px-24 py-16">
        {/* Background placeholder */}
        <div className="absolute inset-0 z-0 bg-zinc-900 opacity-30"></div>
        
        <div className="relative z-10 w-full md:w-2/3 mb-8 md:mb-0 text-center md:text-left">
          <h2 className="text-white text-4xl md:text-5xl lg:text-5xl font-ramadhan mb-4 tracking-wide leading-tight">
            Ramadan dengan Kebaikan
          </h2>
          <p className="text-zinc-300 text-base md:text-lg max-w-xl mx-auto md:mx-0 leading-relaxed font-newsreader">
            Mari berbagi hidangan berbuka kepada mereka yang membutuhkan dan hadirkan kebahagiaan di bulan penuh berkah ini
          </p>
        </div>
        
         <div className="relative z-10 w-full md:w-1/3 flex justify-center md:justify-end">
           <Link href="#programs" className="bg-[#ED1C24] hover:bg-red-700 transition text-white px-8 py-3 md:py-4 rounded-md font-semibold text-base md:text-lg flex items-center gap-3">
             Salurkan Kebaikan
             <span className="font-bold border-l pl-3 border-red-500/50">&#8594;</span>
           </Link>
         </div>
      </section>

    </div>
  );
}
