import Image from "next/image";

const BADGE_TEXT = "Taman Zakat - Indonesia - taza -";

export default function BeasiswaBintangPage() {
  return (
    <section className="min-h-screen w-full bg-white overflow-x-hidden">
      <header className="w-full bg-[#222520] py-10 md:py-20 px-3 gap-5 flex flex-col items-center justify-center">
        {/* judul */}
        <div className="inline-block">
          <h1 className="text-white text-xl md:text-2xl font-newsreader font-bold">
            Beasiswa Bintang
          </h1>
          <hr className="w-full border-t-2 border-[#7FC248] mt-2" />
        </div>
        <p className="text-center max-w-full md:max-w-6xl mx-auto text-white">
          Sejahterakan Pendidikan Anak Bangsa Mari menjadi bagian dari Keluarga Besar Taman Zakat
          untuk menebar hikmah menuju peradaban dunia yang lebih baik melalui program Beasiswa
          Bintang untuk siswa-siswi berprestasi. Melalui Beasiswa Bintang, anda juga membantu
          anak-anak yatim menyongsong masa depan yang gemilang 
        </p>

        {/* Tombol donasi */}
        <div className="relative inline-block mt-6 md:mt-8 transition-transform duration-150 hover:-translate-y-0.5">
          {/* BORDER HITAM */}
          <div
            aria-hidden
            className="pointer-events-none absolute inset-0 z-20 -translate-x-1 rotate-[-1deg] rounded-sm border-2 border-white"
          />

          <a href="#" className="relative z-10 inline-block">
            <div className="relative rounded-sm bg-[#7FC248] px-3 md:px-5 py-2">
              <div className="relative z-10 inline-flex items-center gap-2 text-base font-semibold font-newsreader text-white">
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
          </a>
        </div>
      </header>
      <main className="w-full bg-white px-4 py-12 md:py-16">
        <div className="mx-auto flex w-full max-w-6xl flex-col gap-8 md:flex-row md:items-start md:gap-12">
          <div className="w-full md:w-1/2">
            <div className="relative w-full max-w-[460px]">
              <Image
                src="/images/gambardetaile/beasiswa-santri 1.svg"
                alt="Program Beasiswa Santri"
                width={600}
                height={360}
                className="h-auto w-full rounded-md"
                priority
              />

              {/* Badge bulat */}
              <div className="pointer-events-none absolute right-0 top-0 translate-x-3 -translate-y-3 md:translate-x-1/4 md:-translate-y-1/3">
                <div className="relative h-[44px] w-[44px] md:h-[52px] md:w-[52px]">
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
                          id="beasiswa-badge-path"
                          d="M150,150 m0,-112 a112,112 0 1,1 0,224 a112,112 0 1,1 0,-224"
                        />
                      </defs>
                      <text fontSize="30" fontWeight="500" className="font-newsreader">
                        <textPath
                          href="#beasiswa-badge-path"
                          startOffset="50%"
                          textAnchor="middle"
                          textLength="680"
                          lengthAdjust="spacing"
                        >
                          {BADGE_TEXT}
                        </textPath>
                      </text>
                    </svg>

                    <div className="relative z-10 flex h-[20px] w-[20px] items-center justify-center rounded-full border-[2px] border-black bg-[#7FC248] md:h-[24px] md:w-[24px]">
                      <Image
                        src="/images/icon/hitam logo taza 1.svg"
                        alt="Logo Taza hitam"
                        width={20}
                        height={22}
                        className="h-[14px] w-auto md:h-[16px]"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <article className="w-full text-black md:w-1/2">
            <h2 className="font-newsreader text-lg font-semibold leading-tight md:text-2xl">
              Dekat dengan Rasulullah lewat Amalan ini...
            </h2>
            <p className="mt-3 text-xs leading-relaxed md:text-base">
              Jumlah Angka Putus Sekolah di Indonesia meningkat hingga 22,31% begitu juga dengan
              Angka Buta Huruf mencapai 10,8 juta orang. Hal ini adalah bukti bahwa masih banyak
              anak-anak Indonesia yang perlu dibantu bersama.
            </p>
            <p className="mt-4 text-xs leading-relaxed md:text-base">
              Sobat Zakat, Rasulullah bersabda bahwa orang-orang muslim yang memelihara anak yatim
              maka akan berada bersama beliau seperti jari telunjuk dan jari tengah. Betapa
              dekatnya...
            </p>
            <p className="mt-4 text-xs leading-relaxed md:text-base">
              Hanya dengan 50 ribu anda bisa ikut berpartisipasi mengantarkan anak-anak yatim dhuafa
              dan anak berprestasi memperoleh masa depan gemilang di hari mendatang.
            </p>
            <a
              href="#"
              className="mt-6 inline-block font-newsreader text-base text-[#3a5f2a] underline decoration-1 underline-offset-4"
            >
              Donasi Disini
            </a>
          </article>
        </div>

        {/* Sebaran Aksi Taman Zakat */}
        <section className="flex flex-col items-center mt-12 md:mt-24">
          <h2 className="font-newsreader font-semibold text-xl md:text-2xl text-black">
            Sebaran Aksi Taman Zakat
          </h2>
          <p className="text-black font-light text-sm md:text-base mb-2 md:mb-4">Tahun 2020</p>
          <Image
            src="/images/gambardetaile/map beasiswa.svg"
            alt="Sebaran Aksi Taman Zakat"
            width={800}
            height={400}
            className="h-auto w-full max-w-[800px]"
          />
          <p className="text-black text-center mt-5 md:mt-8 font-light text-sm md:text-base mb-2 md:mb-4">
            Sebanyak 22.107 Penerima manfaat telah terberdayakan melalui program Taman Zakat
          </p>

          <a href="#" className="inline-block">
            <h1 className="text-zinc-700 text-base md:text-lg font-newsreader font-medium">
              Lihat Detail Disini
            </h1>
            <hr className="w-full border-t-2 border-[#7FC248] mt-1 md:mt-0" />
          </a>
        </section>
      </main>

      {/* Bukti Penyaluran */}
      <section className="w-full py-14 px-4 md:px-0 bg-[#FAF7F0]">
        <div className="max-w-6xl mx-auto flex flex-col lg:flex-row items-center gap-12">
          {/* KIRI: TEXT */}
          <div className="lg:w-1/2">
            <h4 className="text-black text-base text-center md:text-start md:text-xl font-semibold">
              Ready to give the gift of clean water?
            </h4>
            <p className="text-black mt-2 md:mt-1 text-center md:text-start text-base md:text-lg md:max-w-lg font-light">
              Every $40 can end a walk for water, and 100% of your donation will fund clean
              water projects.
            </p>
            {/* Tombol donasi */}
            <div className="flex items-center justify-center md:items-start md:justify-start">
              <div className="relative inline-block mt-6 md:mt-8 transition-transform duration-150 hover:-translate-y-0.5">
                {/* BORDER HITAM */}
                <div
                  aria-hidden
                  className="pointer-events-none absolute inset-0 z-20 -translate-x-1 rotate-[-1deg] rounded-sm border-2 border-zinc-600"
                />

                <a href="#" className="relative z-10 inline-block">
                  <div className="relative rounded-sm bg-[#7FC248] px-3 md:px-5 py-2">
                    <div className="relative z-10 inline-flex items-center gap-2 text-base font-semibold font-newsreader text-white">
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
                </a>
              </div>
            </div>
          </div>

          {/* Grid Foto Kolase */}
          <div className="relative mt-4 md:mt-6 h-[550px] w-full max-w-full overflow-visible md:h-[500px] lg:ml-auto lg:mt-0 lg:h-[700px] lg:w-1/2">
            {/* Panduan cepat kolase:
                - Posisi: ubah `top-*`, `right-*`, `left-*`, `bottom-*`
                - Rotasi: ubah `rotate-*` / `-rotate-*`
                - Layer: ubah `z-*` (angka lebih besar = lebih depan)
                - Ukuran: ubah `w-*` (mobile / md / lg) */}
            {/* Paling atas */}
            {/* Foto 1: kanan atas, paling depan */}
            <Image
              src="/images/gambardetaile/kasih ke anak sma 1.svg"
              alt="Bukti penyaluran siswa"
              width={417}
              height={313}
              className="absolute left-0 md:left-8 top-0 z-40 h-auto w-[225px] -rotate-[3.5deg] rounded-md shadow-[0_10px_22px_rgba(0,0,0,0.2)] md:w-[250px] lg:w-[310px]"
            />

            {/* Foto 2: kiri tengah, di bawah foto kanan tengah */}
            <Image
              src="/images/gambardetaile/sedekah ramene rek 1.svg"
              alt="Bukti penyaluran warga"
              width={382}
              height={287}
              className="absolute right-0 top-[117px] z-20 h-auto w-[230px] -rotate-[1.5deg] rounded-md shadow-[0_10px_22px_rgba(0,0,0,0.2)] md:top-[170px] md:w-[310px] lg:w-[300px]"
            />

            {/* Foto 3: kanan tengah, di atas foto kiri tengah */}
            <Image
              src="/images/gambardetaile/Yatim-Beasiswa-Sekolah-Yatimn 1.svg"
              alt="Bukti penyaluran beasiswa"
              width={372}
              height={279}
              className="absolute left-0 top-64 z-30 h-auto w-[210px] -rotate-[1.5deg] rounded-md shadow-[0_10px_22px_rgba(0,0,0,0.2)] md:-left-7 md:top-[210px] md:w-[240px] lg:w-[295px]"
            />

            {/* Foto 4: bawah tengah, paling belakang */}
            <Image
              src="/images/gambardetaile/diberi taza 1.svg"
              alt="Penerima manfaat"
              width={358}
              height={269}
              className="absolute bottom-0 md:bottom-12 right-0 z-10 h-auto w-[230px] -rotate-[2.2deg] rounded-md shadow-[0_10px_22px_rgba(0,0,0,0.2)] md:left-[108px] md:w-[300px] lg:left-[118px] lg:w-[320px]"
            />
          </div>
        </div>
      </section>
    </section>
  );
}
