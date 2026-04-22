import Image from "next/image";

export default function ProgramPage() {
  const gridBgOffsetY = "150px";

  return (
    <section className="min-h-screen w-full bg-[#faf7f0] overflow-x-hidden font-poppins">
      {/* header */}
      <header className="w-full flex flex-col bg-black md:flex-row md:h-[400px]">
        {/* Gambar */}
        <div className="w-full md:w-1/2 h-56 sm:h-72 md:h-auto overflow-hidden">
          <img
            src="https://picsum.photos/seed/tamanzakat/800/600"
            alt="Header Program"
            className="w-full h-full object-cover"
          />
        </div>
        {/* text */}
        <div className="w-full md:w-1/2 bg-[#30353B] flex flex-col justify-center gap-4 px-6 py-8 sm:px-10 sm:py-10 md:px-12 lg:px-16 text-center md:text-left items-center md:items-start">
          <h1 className="text-white text-xl md:text-3xl lg:text-4xl font-light font-poppins pb-2 border-b-2 border-[#7FC248]">
            Saatnya Bergerak untuk Kebaikan.
          </h1>
          <p className="text-white text-sm md:text-lg font-light leading-relaxed max-w-xl">
            Setiap amanah yang Anda titipkan akan kami salurkan dengan penuh
            tanggung jawab, transparansi, dan keberpihakan kepada mereka yang
            paling membutuhkan.
          </p>
        </div>
      </header>
      {/* content */}
      <main className="bg-[#FAF7F0] w-full md:py-10 lg:py-8 px-5">
        {/* pembuka */}
        <section className="w-full">
          <h2 className="text-2xl md:text-2xl lg:text-3xl text-black font-medium font-poppins text-center mt-14 mb-2 tracking-wide">
            Program Nyata, Dampak yang Terasa
          </h2>
          <p className="text-center text-md md:text-xl lg:text-xl text-zinc-700 max-w-2xl mx-auto text-balance">
            Bagaimana Anda tahu zakat dan donasi Anda benar-benar sampai?
            Caranya sederhana: kami tunjukkan kepada Anda. Karena kepercayaan
            Anda adalah amanah yang kami jaga sepenuh hati.
          </p>

        </section>

        {/* Start Area Grid */}
        <section className="relative z-0 mt-16 md:mt-20">
          <div
            className="pointer-events-none absolute left-1/2 -translate-x-1/2 w-[100dvw] bg-[#F8EED3] z-0"
            style={{ top: gridBgOffsetY, height: "calc(100% - 100px)" }}
          ></div>

          {/* Start Grid Besar */}
          <div className="relative z-10 mx-auto w-full max-w-7xl xl:max-w-[1400px] px-6 sm:px-8 md:px-12 lg:px-16 py-6">
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-12 lg:gap-16 xl:gap-20">
              {/* ================= CARD 1 ================= */}
              <a
                href="/program/dakwah"
                className="w-full relative group hover:drop-shadow-xl transition-all duration-300 ease-in-out block"
              >
                <div className="w-full relative transition-transform duration-300 group-hover:scale-[1.02]">
                  <div className="w-full h-64 sm:h-72 md:h-80 flex items-center justify-center">
                    <img
                      src="/images/gambardetaile/bidang dakwa.svg"
                      alt="Bidang Dakwah"
                      className="w-full h-full object-contain"
                    />
                  </div>
                  {/* Kotak Keterangan */}
                  <div className="mt-0 mx-auto w-[85%] rounded-md border border-zinc-400 bg-[#5DA630] px-3 py-2 sm:px-4 sm:py-3 shadow-lg z-10">
                    <h4 className="font-poppins text-sm sm:text-lg md:text-xl font-medium text-white">
                      Bidang Dakwah{" "}
                      <span className="ml-1 text-xs sm:text-base mb-0.5 inline-block">
                        ➔
                      </span>
                    </h4>
                    <p className="mt-0.5 sm:mt-1 text-[8px] sm:text-[10px] md:text-xs font-normal text-white leading-tight sm:leading-snug">
                      Bergabunglah dalam program dakwah kami untuk menyebarkan
                      nilai-nilai Islam yang rahmatan lil alamin di seluruh
                      pelosok negeri.
                    </p>
                  </div>
                </div>
              </a>

              {/* ================= CARD 2 ================= */}
              <a
                href="/program/ekonomi"
                className="w-full relative group hover:drop-shadow-xl transition-all duration-300 ease-in-out block"
              >
                <div className="w-full relative transition-transform duration-300 group-hover:scale-[1.02]">
                  <div className="w-full h-64 sm:h-72 md:h-80 flex items-center justify-center">
                    <img
                      src="/images/gambardetaile/bidang eko.svg"
                      alt="Bidang Ekonomi"
                      className="w-full h-full object-contain"
                    />
                  </div>
                  {/* Kotak Keterangan */}
                  <div className="mt-0 mx-auto w-[85%] rounded-md border border-zinc-400 bg-[#5DA630] px-3 py-2 sm:px-4 sm:py-3 shadow-lg z-10">
                    <h4 className="font-poppins text-sm sm:text-lg md:text-xl font-medium text-white">
                      Bidang Ekonomi{" "}
                      <span className="ml-1 text-xs sm:text-base mb-0.5 inline-block">
                        ➔
                      </span>
                    </h4>
                    <p className="mt-0.5 sm:mt-1 text-[8px] sm:text-[10px] md:text-xs font-normal text-white leading-tight sm:leading-snug">
                      Berdayakan mustahik melalui program ekonomi produktif
                      agar mereka bisa mandiri dan keluar dari lingkaran
                      kemiskinan.
                    </p>
                  </div>
                </div>
              </a>

              {/* ================= CARD 3 ================= */}
              <a
                href="/program/kemanusiaan"
                className="w-full relative group hover:drop-shadow-xl transition-all duration-300 ease-in-out block"
              >
                <div className="w-full relative transition-transform duration-300 group-hover:scale-[1.02]">
                  <div className="w-full h-64 sm:h-72 md:h-80 flex items-center justify-center">
                    <img
                      src="/images/gambardetaile/bidang kemanusia.svg"
                      alt="Bidang Kemanusiaan"
                      className="w-full h-full object-contain"
                    />
                  </div>
                  {/* Kotak Keterangan */}
                  <div className="mt-0 mx-auto w-[85%] rounded-md border border-zinc-400 bg-[#5DA630] px-3 py-2 sm:px-4 sm:py-3 shadow-lg z-10">
                    <h4 className="font-poppins text-sm sm:text-lg md:text-xl font-medium text-white">
                      Bidang Kemanusiaan{" "}
                      <span className="ml-1 text-xs sm:text-base mb-0.5 inline-block">
                        ➔
                      </span>
                    </h4>
                    <p className="mt-0.5 sm:mt-1 text-[8px] sm:text-[10px] md:text-xs font-normal text-white leading-tight sm:leading-snug">
                      Hadir cepat di setiap bencana dan krisis untuk
                      memberikan bantuan darurat bagi saudara-saudara yang
                      paling membutuhkan.
                    </p>
                  </div>
                </div>
              </a>

              {/* ================= CARD 4 ================= */}
              <a
                href="/program/kesehatan"
                className="w-full relative group hover:drop-shadow-xl transition-all duration-300 ease-in-out block"
              >
                <div className="w-full relative transition-transform duration-300 group-hover:scale-[1.02]">
                  <div className="w-full h-64 sm:h-72 md:h-80 flex items-center justify-center">
                    <img
                      src="/images/gambardetaile/bidang keseha.svg"
                      alt="Bidang Kesehatan"
                      className="w-full h-full object-contain"
                    />
                  </div>
                  {/* Kotak Keterangan */}
                  <div className="mt-0 mx-auto w-[85%] rounded-md border border-zinc-400 bg-[#5DA630] px-3 py-2 sm:px-4 sm:py-3 shadow-lg z-10">
                    <h4 className="font-poppins text-sm sm:text-lg md:text-xl font-medium text-white">
                      Bidang Kesehatan{" "}
                      <span className="ml-1 text-xs sm:text-base mb-0.5 inline-block">
                        ➔
                      </span>
                    </h4>
                    <p className="mt-0.5 sm:mt-1 text-[8px] sm:text-[10px] md:text-xs font-normal text-white leading-tight sm:leading-snug">
                      Wujudkan akses layanan kesehatan yang layak bagi
                      masyarakat dhuafa agar mereka bisa hidup sehat dan
                      produktif.
                    </p>
                  </div>
                </div>
              </a>

              {/* ================= CARD 5 ================= */}
              <a
                href="/program/pendidikan"
                className="w-full sm:col-span-2 sm:justify-self-center sm:w-[calc(50%-1rem)] relative group hover:drop-shadow-xl transition-all duration-300 ease-in-out block"
              >
                <div className="w-full relative transition-transform duration-300 group-hover:scale-[1.02]">
                  <div className="w-full h-64 sm:h-72 md:h-80 flex items-center justify-center">
                    <img
                      src="/images/gambardetaile/bidang pendidikan.svg"
                      alt="Bidang Pendidikan"
                      className="w-full h-full object-contain"
                    />
                  </div>
                  {/* Kotak Keterangan */}
                  <div className="mt-0 mx-auto w-[85%] rounded-md border border-zinc-400 bg-[#5DA630] px-3 py-2 sm:px-4 sm:py-3 shadow-lg z-10">
                    <h4 className="font-poppins text-sm sm:text-lg md:text-xl font-medium text-white">
                      Bidang Pendidikan{" "}
                      <span className="ml-1 text-xs sm:text-base mb-0.5 inline-block">
                        ➔
                      </span>
                    </h4>
                    <p className="mt-0.5 sm:mt-1 text-[8px] sm:text-[10px] md:text-xs font-normal text-white leading-tight sm:leading-snug">
                      Dukung anak-anak yatim dan dhuafa agar tetap bisa
                      mengenyam pendidikan berkualitas dan meraih impian
                      mereka.
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </section>

        {/* Cara Lain untuk Berbuat Kebaikan */}
        <section className="mx-auto w-full max-w-6xl mt-14 md:mt-28">
          <h2 className="text-center text-3xl md:text-4xl font-poppins text-zinc-900">
            Cara Lain untuk Berbuat Kebaikan
          </h2>

          <div className="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 md:gap-10">
            {/* Bayar Zakat */}
            <article className="relative overflow-visible min-h-[185px] rounded-sm border border-zinc-200 bg-[#F7F7F7] px-4 pb-5 pt-12 md:px-5 md:pb-6 md:pt-14 shadow-[0_2px_6px_rgba(0,0,0,0.08)] text-center flex flex-col items-center">
              <img
                src="/images/icon/Dollar Bag.svg"
                alt="Icon Bayar Zakat"
                className="absolute -top-6 left-1/2 -translate-x-1/2 h-14 w-14"
              />
              <h3 className="text-2xl font-medium font-poppins text-zinc-900">
                Bayar Zakat
              </h3>
              <p className="mt-2 text-sm leading-snug text-zinc-700">
                Tunaikan zakat maal, zakat fitrah, dan zakat lainnya dengan
                mudah, aman, dan terpercaya.
              </p>
              <a
                href="#"
                className="mt-auto pt-3 text-sm font-medium text-zinc-900 underline decoration-[#7FC248] underline-offset-4"
              >
                Bayar Zakat Sekarang
              </a>
            </article>

            {/* Dukung Program Kebaikan*/}
            <article className="relative overflow-visible min-h-[185px] rounded-sm border border-zinc-200 bg-[#F7F7F7] px-4 pb-5 pt-12 md:px-5 md:pb-6 md:pt-14 shadow-[0_2px_6px_rgba(0,0,0,0.08)] text-center flex flex-col items-center">
              <img
                src="/images/icon/Handshake Heart.svg"
                alt="Icon Dukung Program Kebaikan"
                className="absolute -top-6 left-1/2 -translate-x-1/2 h-14 w-14"
              />
              <h3 className="text-2xl font-medium font-poppins text-zinc-900">
                Dukung Program Kebaikan
              </h3>
              <p className="mt-2 text-sm leading-snug text-zinc-700">
                Bantu berbagai program sosial seperti pendidikan, kesehatan, dan
                bantuan kemanusiaan.
              </p>
              <a
                href="#"
                className="mt-auto pt-3 text-sm font-medium text-zinc-900 underline decoration-[#7FC248] underline-offset-4"
              >
                Lihat Program
              </a>
            </article>

            {/* Fundraiser*/}
            <article className="relative overflow-visible min-h-[185px] rounded-sm border border-zinc-200 bg-[#F7F7F7] px-4 pb-5 pt-12 md:px-5 md:pb-6 md:pt-14 shadow-[0_2px_6px_rgba(0,0,0,0.08)] text-center flex flex-col items-center">
              <img
                src="/images/icon/Commercial.svg"
                alt="Icon Fundraiser"
                className="absolute -top-6 left-1/2 -translate-x-1/2 h-14 w-14"
              />
              <h3 className="text-2xl font-medium font-poppins text-zinc-900">
                Fundraiser
              </h3>
              <p className="mt-2 text-sm leading-snug text-zinc-700">
                Mulai kampanye kebaikan Anda dan ajak orang lain berdonasi
              </p>
              <a
                href="#"
                className="mt-auto pt-3 text-sm font-medium text-zinc-900 underline decoration-[#7FC248] underline-offset-4"
              >
                Mulai Fundraiser
              </a>
            </article>

            {/* Ajukan Bantuan*/}
            <article className="relative overflow-visible min-h-[185px] rounded-sm border border-zinc-200 bg-[#F7F7F7] px-4 pb-5 pt-12 md:px-5 md:pb-6 md:pt-14 shadow-[0_2px_6px_rgba(0,0,0,0.08)] text-center flex flex-col items-center">
              <img
                src="/images/icon/Treatment.svg"
                alt="Icon Ajukan Bantuan"
                className="absolute -top-6 left-1/2 -translate-x-1/2 h-14 w-14"
              />
              <h3 className="text-2xl font-medium font-poppins text-zinc-900">
                Ajukan Bantuan
              </h3>
              <p className="mt-2 text-sm leading-snug text-zinc-700">
                Ajukan bantuan untuk diri sendiri atau orang lain yang
                membutuhkan.
              </p>
              <a
                href="/kolaborasi/permohonan-bantuan"
                className="mt-auto pt-3 text-sm font-medium text-zinc-900 underline decoration-[#7FC248] underline-offset-4"
              >
                Ajukan Sekarang
              </a>
            </article>

            {/* Laporan Penyaluran*/}
            <article className="relative overflow-visible min-h-[185px] rounded-sm border border-zinc-200 bg-[#F7F7F7] px-4 pb-5 pt-12 md:px-5 md:pb-6 md:pt-14 shadow-[0_2px_6px_rgba(0,0,0,0.08)] text-center flex flex-col items-center">
              <img
                src="/images/icon/Inscription.svg"
                alt="Icon Laporan Penyaluran"
                className="absolute -top-6 left-1/2 -translate-x-1/2 h-14 w-14"
              />
              <h3 className="text-2xl font-medium font-poppins text-zinc-900">
                Laporan Penyaluran
              </h3>
              <p className="mt-2 text-sm leading-snug text-zinc-700">
                Pantau transparansi dan akuntabilitas penyaluran zakat serta
                donasi Anda secara terbuka.
              </p>
              <a
                href="/tata-kelola"
                className="mt-auto pt-3 text-sm font-medium text-zinc-900 underline decoration-[#7FC248] underline-offset-4"
              >
                Lihat Laporan
              </a>
            </article>

            {/* Legalitas & Transparansi*/}
            <article className="relative overflow-visible min-h-[185px] rounded-sm border border-zinc-200 bg-[#F7F7F7] px-4 pb-5 pt-12 md:px-5 md:pb-6 md:pt-14 shadow-[0_2px_6px_rgba(0,0,0,0.08)] text-center flex flex-col items-center">
              <img
                src="/images/icon/Inscription.svg"
                alt="Icon Legalitas"
                className="absolute -top-6 left-1/2 -translate-x-1/2 h-14 w-14"
              />
              <h3 className="text-2xl font-medium font-poppins text-zinc-900">
                Legalitas & Transparansi
              </h3>
              <p className="mt-2 text-sm leading-snug text-zinc-700">
                Kami berkomitmen menjalankan amanah secara profesional dan
                transparan.
              </p>
              <a
                href="/tata-kelola#hasil-audit"
                className="mt-auto pt-3 text-sm font-medium text-zinc-900 underline decoration-[#7FC248] underline-offset-4"
              >
                Lihat Detail
              </a>
            </article>
          </div>
        </section>
      </main>

      {/* bottom*/}
      {/* <section className="w-full bg-[#F8EED3] py-16 md:py-20 lg:py-24">
        <div className="mx-auto w-full max-w-4xl px-6 text-center">
          <h2 className="font-poppins text-2xl font-medium text-zinc-900">
            You deserve to give with confidence
          </h2>
          <p className="mt-6 text-lg md:text-xl leading-relaxed text-zinc-900">
            All of our operational expenses are funded by a private community of donors, so you can
            trust 100% of your donation will go directly to water solutions, every cent, every time.
            But we do not stop there. From our commitment to equipping local partners, to our tech,
            to the environmental sustainability of our water projects: "good enough" is never good
            enough for us. We are setting new standards for transparency and innovation. These
            companies and organizations agree.
          </p>
        </div>
      </section> */}
      {/* End */}
    </section>
  );
}
