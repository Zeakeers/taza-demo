import Image from "next/image";

const BADGE_TEXT = "Taman Zakat - Indonesia - taza -";

export default function DesaPeloporPage() {
  return (
    <section className="min-h-screen w-full bg-white overflow-x-hidden">
      <header className="w-full bg-[#222520] py-10 md:py-20 px-3 gap-5 flex flex-col items-center justify-center">
        {/* judul */}
        <div className="inline-block">
          <h1 className="text-white text-xl md:text-2xl font-newsreader font-bold">Desa Pelopor</h1>
          <hr className="w-full border-t-2 border-[#7FC248] mt-2" />
        </div>
        <p className="text-center max-w-full md:max-w-6xl mx-auto text-white">
          adalah Program pemberdayaan dalam cangkupan wilayah desa (dan sebagian kelurahan), melalui
          pendekatan terintegrasi yaitu, Program pembinaan masyarakat , ekonomi, pendidikan,
          kesehatan, lingkungan hingga kesiapsiagaan bencana, dengan target tumbuh dan berkembangnya
          kelembagaan lokal. Untuk mengatasi permasalahannya sendiri serta berkolaborasi denga pihak
          lain terutama pemerintah desa.
        </p>
      </header>
      {/* bener kecil */}
      <section className="relative w-full bg-[#FAF7F0] px-4 pt-12 pb-12 md:pt-14 md:pb-16">
        {/* start bulat */}
        <div className="pointer-events-none absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2">
          <div className="relative h-[56px] w-[56px] md:h-[68px] md:w-[68px]">
            <div
              aria-hidden
              className="absolute -top-[2px] left-[2px] h-full w-full rounded-full border border-black bg-transparent rotate-[-6deg]"
            />

            <div className="relative z-10 flex h-full w-full items-center justify-center rounded-full border border-black bg-[#7FC248]">
              <svg
                viewBox="0 0 300 300"
                aria-hidden
                className="absolute inset-0 h-full w-full fill-black"
              >
                <defs>
                  <path
                    id="desa-pelopor-badge-path"
                    d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224"
                  />
                </defs>
                <text fontSize="30" fontWeight="500" className="font-newsreader">
                  <textPath
                    href="#desa-pelopor-badge-path"
                    startOffset="50%"
                    textAnchor="middle"
                    textLength="680"
                    lengthAdjust="spacing"
                  >
                    {BADGE_TEXT}
                  </textPath>
                </text>
              </svg>

              <div className="relative z-10 flex h-[26px] w-[26px] items-center justify-center rounded-full border-[2px] border-black bg-[#7FC248] md:h-[32px] md:w-[32px]">
                <Image
                  src="/images/icon/hitam logo taza 1.svg"
                  alt="Logo Taza hitam"
                  width={26}
                  height={30}
                  className="h-[18px] w-auto md:h-[22px]"
                  priority
                />
              </div>
            </div>
          </div>
        </div>
        {/* end bulat */}

        {/* gambar atas + description*/}
        <div className="mx-auto mt-2 flex w-full max-w-6xl flex-col gap-8 md:mt-4 md:flex-row md:items-center md:gap-10">
          <figure className="w-full md:w-[48%]">
            <Image
              src="/images/gambardetaile/gambar desapelopor atas.svg"
              alt="Diagram Mengapa Program Desa Pelopor"
              width={520}
              height={330}
              className="mx-auto h-auto w-full max-w-[520px]"
              priority
            />
          </figure>

          <article className="w-full text-center text-black md:w-[52%]">
            <h2 className="font-newsreader text-xl font-semibold leading-tight md:text-2xl">
              The 100% Model is powered by a small and dedicated group of private donors
            </h2>
            <p className="mx-auto mt-4 max-w-[62ch] text-sm leading-relaxed md:text-xl">
              These entrepreneurs, artists, musicians and business leaders fund our operating costs
              - costs that include office rent, staff salaries and benefits, flights and even the
              toner for our copy machine. By committing multi-year support for operations funding,
              Well Members allow us to plan for the future, creating efficiency and stability. And
              Members of The Well provide more than just financial support - they are also some of
              our most loyal teammates, our most visionary partners, and our most outspoken
              champions.
            </p>
          </article>
        </div>

        {/* gambar bawah + description*/}
        <div className="mx-auto mt-10 flex w-full max-w-6xl flex-col gap-8 md:mt-28 md:flex-row md:items-center md:gap-10">
          <article className="w-full text-center text-black md:w-[52%]">
            <h2 className="font-newsreader text-xl font-semibold leading-tight md:text-2xl">
              The 100% Model is powered by a small and dedicated group of private donors
            </h2>
            <p className="mx-auto mt-4 max-w-[62ch] text-sm leading-relaxed md:text-xl">
              These entrepreneurs, artists, musicians and business leaders fund our operating costs
              - costs that include office rent, staff salaries and benefits, flights and even the
              toner for our copy machine. By committing multi-year support for operations funding,
              Well Members allow us to plan for the future, creating efficiency and stability. And
              Members of The Well provide more than just financial support - they are also some of
              our most loyal teammates, our most visionary partners, and our most outspoken
              champions.
            </p>
          </article>

          <figure className="w-full md:w-[48%]">
            <Image
              src="/images/gambardetaile/desapelopor bawah.svg"
              alt="Diagram Mengapa Program Desa Pelopor"
              width={520}
              height={330}
              className="mx-auto h-auto w-full max-w-[520px]"
              priority
            />
          </figure>
        </div>
      </section>

      {/* SOCIOENTERPRENEUR & FIELD INSPECTOR DI DESA */}
      <section className="w-full bg-white px-4 pb-12 pt-8 md:pb-16 md:pt-12">
        <div className="mx-auto w-full max-w-6xl">
          <h2 className="text-center font-newsreader text-xl font-semibold uppercase tracking-wide text-black md:text-2xl">
            Socioenterpreneur &amp; Field Inspector Di Desa
          </h2>

          <div className="mt-8 grid grid-cols-1 gap-8 md:mt-10 md:grid-cols-2 md:gap-10">
            <figure className="w-full">
              <Image
                src="/images/gambardetaile/kiri%201.svg"
                alt="Diagram Menjadi Socioenterpreneur di Desa"
                width={560}
                height={340}
                className="mx-auto h-auto w-full max-w-[560px]"
              />
            </figure>

            <figure className="w-full">
              <Image
                src="/images/gambardetaile/kanan%202.svg"
                alt="Diagram Menjadi Field Inspector di Desa"
                width={560}
                height={340}
                className="mx-auto h-auto w-full max-w-[560px]"
              />
            </figure>
          </div>
        </div>
      </section>

      {/* KEPELOPORAN */}
      <section className="w-full bg-[#FAF7F0] px-4 py-12 md:py-16">
        <div className="mx-auto flex w-full max-w-6xl flex-col gap-8 md:flex-row md:items-center md:gap-12">
          <figure className="w-full md:w-1/2">
            <Image
              src="/images/gambardetaile/sapu.svg"
              alt="Kegiatan kepeloporan Desa Pelopor"
              width={600}
              height={500}
              className="mx-auto h-auto w-full max-w-[560px]"
            />
          </figure>

          <article className="w-full text-center text-black md:w-1/2">
            <h2 className="font-newsreader text-2xl font-semibold md:text-2xl">Kepeloporan</h2>
            <p className="mx-auto mt-4 max-w-[58ch] text-sm leading-relaxed md:text-lg">
              Angel Investors and entrepreneurs, Michael and Xochi Birch joined our mission in 2008,
              just two years into charity: water&apos;s existence. They became the first family to
              donate a one-time gift of $1 million to support operations, at a critical time in the
              organization&apos;s growth. Their radical generosity allowed us to focus on building
              an innovative and inspiring brand that would one day reinvent charity for millions.
            </p>
          </article>
        </div>
      </section>
    </section>
  );
}
