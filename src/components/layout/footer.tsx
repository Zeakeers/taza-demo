import Image from "next/image";
import Link from "next/link";

const infoLinks = ["Profile Lembaga", "Berita", "Artikel", "Mitra Korporat"];

export default function Footer() {
  return (
    <footer className="w-full text-zinc-900">
      {/* Bahian Atas */}
      <section className="w-full bg-[#1F4E27]">
        <div className="mx-auto w-full max-w-[1200px] px-6 py-12 md:px-10 md:py-14 lg:px-12 lg:py-12">
          <div className="grid grid-cols-1 items-center gap-8 lg:grid-cols-[1fr_1.35fr] lg:gap-12">
            <div>
              <h2 className="text-2xl leading-[1.05] font-medium text-white md:text-3xl">
                Stay in touch
              </h2>
              <p className="mt-4 text-lg text-zinc-100/95 md:text-xl md:leading-[1.1]">
                xxxxxxxxxxxxxxxxxxxxxxxx
                <br />
                xxxxxxxxxxxxxxxxxxxx
              </p>
            </div>

            <form className="w-full max-w-md md:max-w-lg lg:max-w-lg justify-self-end rounded-md bg-white p-2 shadow-sm">
              <label htmlFor="footer-email" className="sr-only">
                Enter Your Email Addres
              </label>
              <div className="flex items-center gap-3">
                <Image
                  src="/images/icon/email.svg"
                  alt="Email icon"
                  width={24}
                  height={24}
                  className=" w-9 object-contain"
                />

                <input
                  id="footer-email"
                  type="email"
                  placeholder="Enter Your Email Addres"
                  className="h-10 w-full min-w-0 border-none bg-transparent px-1 text-sm text-zinc-600 outline-none placeholder:text-sm placeholder:text-zinc-500 md:text-base md:placeholder:text-base"
                />

                <button
                  type="submit"
                  className="h-10 shrink-0 rounded-full bg-[#7FC248] px-4 text-xs font-semibold text-white shadow-[0_2px_6px_rgba(0,0,0,0.25)] transition hover:brightness-95 md:text-sm"
                >
                  subscribe
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>

      {/* Bagian Bawah */}
      <section className="w-full bg-white px-5 py-4">
        {/*Logo  taman zakat */}
        <div>
          <img
            src="/images/icon/Taman zakat hijau hitam.png"
            alt="Icon Taman Zakat"
            className="w-36 object-contain md:w-32"
          />
        </div>

        {/* grid 3 dibawah*/}
        <div>
          <div className="mt-2 mb-4 grid grid-cols-1 gap-8 md:grid-cols-3">
            {/* Grid 1 */}
            <div className="w-full">
              <div className="space-y-3">
                <h3 className="text-[#196135] text-lg font-semibold">
                  Yayasan Taman Zakat Indonesia
                </h3>
                <div className="flex items-center">
                  {/* Garis */}
                  <div className="flex-1 h-[2px] bg-black"></div>

                  {/* Lingkaran */}
                  <div className="w-1 h-1 bg-black rounded-full"></div>
                </div>
                <p className="text-black text-base ">
                  Lembaga Filantropi Profesional dan terpercaya yang berfokus pada Sarana dakwah
                  untuk Pengembangan Alqur’an, Pendidikan, Kesehatan dan Kemanusiaan.
                </p>
              </div>
              {/* Medsos */}
              <div className="flex gap-5 md:gap-7 mt-6 md:mt-12">
                {/* Youtube */}
                <a href="#" className="w-12 h-12 bg-red-600 rounded-full"></a>
                {/* instagram */}
                <a href="#" className="w-12 h-12 bg-blue-600 rounded-full"></a>
                {/* instagram */}
                <a href="#" className="w-12 h-12 bg-amber-400 rounded-full"></a>
              </div>
            </div>
            {/* Grid 2 */}
            <div className="w-full">
              <div className="space-y-3">
                <h3 className="text-black text-lg font-semibold">Informasi Kami</h3>
                <div className="flex items-center">
                  {/* Garis */}
                  <div className="flex-1 h-[2px] bg-black"></div>

                  {/* Lingkaran */}
                  <div className="w-1 h-1 bg-black rounded-full"></div>
                </div>
                {/* Redirect */}
                <div className="flex flex-col gap-2 text-base text-zinc-800 font-medium md:text-lg">
                  <a href="">Profile Lembaga</a>
                  <a href="">Berita</a>
                  <a href="">Artikel</a>
                  <a href="">Mitra Korporat</a>
                </div>
              </div>
            </div>
            {/* Grid 3 */}
            <div className="w-full">
              <div className="space-y-3">
                <h3 className="text-black text-lg font-semibold">Kantor Layanan</h3>
                <div className="flex items-center">
                  {/* Garis */}
                  <div className="flex-1 h-[2px] bg-black"></div>

                  {/* Lingkaran */}
                  <div className="w-1 h-1 bg-black rounded-full"></div>
                </div>
                {/* Alamat */}
                <p className="text-black text-base">
                  Kantor Pusat : Jl. Wisma Trosobo IV No. 33 , Kel. Trosobo, Kec. Taman, Kab.
                  Sidoarjo, Prov. Jawa Timur
                </p>
              </div>
              {/* Kotak iframe maps */}
              <div className="w-full bg-black h-56 mt-6 rounded-md overflow-hidden">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7913.660161193402!2d112.63428567770998!3d-7.372933699999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e34e63a9d993%3A0xf355095502d2e683!2sTaman%20Zakat%20Pusat!5e0!3m2!1sid!2sid!4v1771820846657!5m2!1sid!2sid"
                  width="600"
                  height="450"
                  style={{ border: 0 }}
                  allowFullScreen
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                  className="w-full h-full"
                />
              </div>
            </div>

            {/* End Grid */}
          </div>
        </div>
      </section>

      <section className="w-full bg-black py-2">
        <p className="text-center text-sm text-zinc-100">
          © 2026 Taman Zakat. Designed by Taman Zakat Team.
        </p>
      </section>
    </footer>
  );
}
