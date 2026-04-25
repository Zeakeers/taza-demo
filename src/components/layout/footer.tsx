import Image from "next/image";
import Link from "next/link";

export default function Footer() {
  return (
    <footer className="w-full text-zinc-900">
      {/* Bagian Atas / Newsletter */}
      <section className="w-full bg-[#1F4E27]">
        <div className="mx-auto w-full max-w-[1200px] px-6 py-12 md:px-10 lg:px-12 lg:py-14">
          <div className="grid grid-cols-1 items-center gap-8 lg:grid-cols-[1fr_1.35fr] lg:gap-12">
            <div>
              <h2 className="text-2xl leading-[1.1] font-bold text-white md:text-3xl">
                Terhubung dalam Kebaikan
              </h2>
              <p className="mt-3 text-base md:text-lg text-zinc-200/90 leading-relaxed max-w-xl">
                Dapatkan update program terbaru, laporan penyaluran dana, dan
                berbagai kisah inspiratif seputar kebaikan langsung ke email
                Anda.
              </p>
            </div>

            <form className="w-full max-w-md md:max-w-xl justify-self-start lg:justify-self-end rounded-xl bg-white/10 backdrop-blur-md focus-within:bg-white focus-within:ring-2 ring-[#7FC248] p-2 shadow-sm transition-all duration-300">
              <label htmlFor="footer-email" className="sr-only">
                Masukkan Alamat Email
              </label>
              <div className="flex items-center gap-3 w-full">
                <div className="pl-3 hidden sm:block">
                  <svg
                    className="w-6 h-6 text-[#7FC248]"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                    />
                  </svg>
                </div>
                <input
                  id="footer-email"
                  type="email"
                  placeholder="Masukkan Alamat Email Anda..."
                  className="h-11 w-full min-w-0 border-none bg-transparent px-3 text-sm text-zinc-100 focus-within:text-zinc-800 outline-none placeholder:text-zinc-200 focus-within:placeholder:text-zinc-400 md:text-base transition-colors"
                  required
                />
                <button
                  type="submit"
                  className="h-11 shrink-0 rounded-lg bg-[#7FC248] px-6 text-sm font-bold text-white shadow-lg transition-transform hover:scale-[1.02] active:scale-[0.98] outline-none"
                >
                  Langganan
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>

      {/* Bagian Bawah / Main Footer */}
      <section className="w-full bg-[#FAF7F0] px-5 py-12 md:py-16">
        <div className="mx-auto max-w-[1200px]">
          {/* Grid Utama */}
          <div className="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-14">
            {/* Grid 1: Profil & Sosial Media */}
            <div className="md:col-span-3 flex flex-col gap-6">
              <Image
                src="/images/icon/Taman zakat hijau hitam.png"
                alt="Logo Taman Zakat"
                width={200}
                height={56}
                className="w-40 object-contain"
              />
              <p className="text-zinc-600 text-[15px] leading-relaxed">
                Lembaga Filantropi Profesional dan terpercaya yang berfokus pada
                sarana dakwah untuk Pengembangan Al-Qur&apos;an, Pendidikan,
                Kesehatan, dan Kemanusiaan.
              </p>

              {/* Media Sosial Bar */}
              <div className="flex gap-4 mt-2">
                {/* instagram */}
                <a
                  href="https://www.instagram.com/tamanzakat/?hl=id"
                  aria-label="Instagram"
                  className="w-10 h-10 rounded-full bg-white shadow-sm border border-[#7fc248] flex items-center justify-center text-[#7fc248] hover:text-[#E1306C] hover:border-[#E1306C] hover:shadow-md transition-all duration-300"
                >
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                  </svg>
                </a>
                {/* tiktok */}
                <a
                  href="https://www.tiktok.com/@taman.zakat?is_from_webapp=1&sender_device=pc"
                  aria-label="TikTok"
                  className="w-10 h-10 rounded-full bg-white shadow-sm border border-[#7fc248] flex items-center justify-center text-[#7fc248] hover:text-[#000000] hover:border-[#000000] hover:shadow-md transition-all duration-300"
                >
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z" />
                  </svg>
                </a>
                {/* Twiter */}
                <a
                  href="https://twitter.com/taman_zakat"
                  aria-label="Twitter / X"
                  className="w-10 h-10 rounded-full bg-white shadow-sm border border-[#7fc248] flex items-center justify-center text-[#7fc248] hover:text-[#000000] hover:border-[#000000] hover:shadow-md transition-all duration-300"
                >
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.849L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                  </svg>
                </a>
                {/* Youtube */}
                <a
                  href="https://www.youtube.com/channel/UCDQFsZ5snlKXvaA5lrfQEUg?sub_confirmation=1"
                  aria-label="YouTube"
                  className="w-10 h-10 rounded-full bg-white shadow-sm border border-[#7fc248] flex items-center justify-center text-[#7fc248] hover:text-[#FF0000] hover:border-[#FF0000] hover:shadow-md transition-all duration-300"
                >
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                  </svg>
                </a>
                {/* Facebook */}
                <a
                  href="https://www.facebook.com/tamanzakatindonesia"
                  aria-label="Facebook"
                  className="w-10 h-10 rounded-full bg-white shadow-sm border border-[#7fc248] flex items-center justify-center text-[#7fc248] hover:text-[#1877F2] hover:border-[#1877F2] hover:shadow-md transition-all duration-300"
                >
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                  </svg>
                </a>
              </div>
            </div>

            {/* Grid 2: Navigasi Cepat */}
            <div className="md:col-span-2 flex flex-col pt-2">
              <h3 className="text-zinc-900 text-lg font-bold flex items-center gap-2 mb-6">
                <span className="w-8 h-1 bg-[#5DA630] rounded-full"></span>
                Navigasi
              </h3>
              <ul className="flex flex-col gap-3">
                {[
                  { label: "Program", href: "/program" },
                  { label: "Berita", href: "/berita" },
                  { label: "Layanan", href: "/layanan" },
                  { label: "Artikel", href: "/artikel" },
                  { label: "Syarat & Ketentuan", href: "/syarat-ketentuan" },
                ].map((item) => (
                  <li key={item.href}>
                    <Link
                      href={item.href}
                      className="text-zinc-600 hover:text-[#5DA630] text-[15px] font-medium transition-colors flex items-center gap-2 group"
                    >
                      <span className="w-1.5 h-1.5 rounded-full bg-[#5DA630] shrink-0 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                      {item.label}
                    </Link>
                  </li>
                ))}
              </ul>
            </div>

            {/* Grid 3: Kontak Kami */}
            <div className="md:col-span-3 flex flex-col pt-2">
              <h3 className="text-zinc-900 text-lg font-bold flex items-center gap-2 mb-6">
                <span className="w-8 h-1 bg-[#5DA630] rounded-full"></span>
                Kontak Kami
              </h3>
              <div className="flex flex-col gap-4">
                <a
                  href="https://wa.me/6285119990024"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="group flex items-center gap-3 text-zinc-600 hover:text-[#25D366] transition-colors"
                >
                  <span className="w-9 h-9 rounded-full bg-white shadow-sm border border-zinc-200 flex items-center justify-center text-zinc-400 group-hover:text-[#25D366] group-hover:border-[#25D366] transition-all shrink-0">
                    <svg
                      className="w-5 h-5"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                  </span>
                  <span className="font-medium text-[15px]">
                    0851-1999-0024
                  </span>
                </a>

                <a
                  href="mailto:mail@tamanzakat.org"
                  className="group flex items-center gap-3 text-zinc-600 hover:text-[#5DA630] transition-colors"
                >
                  <span className="w-9 h-9 rounded-full bg-white shadow-sm border border-zinc-200 flex items-center justify-center text-zinc-400 group-hover:text-[#5DA630] group-hover:border-[#5DA630] transition-all shrink-0">
                    <svg
                      className="w-5 h-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                      />
                    </svg>
                  </span>
                  <span className="font-medium text-[15px]">
                    mail@tamanzakat.org
                  </span>
                </a>
              </div>
            </div>

            {/* Grid 4: Kantor Layanan & Maps */}
            <div className="md:col-span-4 flex flex-col pt-2">
              <h3 className="text-zinc-900 text-lg font-bold flex items-center gap-2 mb-6">
                <span className="w-8 h-1 bg-[#5DA630] rounded-full"></span>
                Kantor Layanan
              </h3>

              <div className="text-zinc-600 mb-6 flex flex-col gap-3">
                <p className="text-[15px] leading-relaxed font-medium">
                  <strong className="text-zinc-800 flex items-center gap-2 mb-1 cursor-default">
                    <svg
                      className="w-[18px] h-[18px] text-[#5DA630]"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2.5}
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"
                      />
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2.5}
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                      />
                    </svg>
                    Kantor Pusat:
                  </strong>
                  Jl. Wisma Trosobo IV No. 33, Kel. Trosobo,
                  <br />
                  Kec. Taman, Kab. Sidoarjo, Prov. Jawa Timur
                </p>
              </div>

              {/* Kotak iframe maps */}
              <div className="w-full h-48 md:h-60 rounded-xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-white relative group">
                <div className="absolute inset-0 bg-[#5DA630]/10 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-300 z-10"></div>
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7913.660161193402!2d112.63428567770998!3d-7.372933699999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e34e63a9d993%3A0xf355095502d2e683!2sTaman%20Zakat%20Pusat!5e0!3m2!1sid!2sid!4v1771820846657!5m2!1sid!2sid"
                  width="100%"
                  height="100%"
                  style={{ border: 0 }}
                  allowFullScreen
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Copyright */}
      <section className="w-full bg-[#194020] py-4">
        <div className="mx-auto max-w-[1200px] px-6 text-center">
          <p className="text-sm font-medium text-zinc-300/80">
            © 2026 Taman Zakat. Dikembangkan oleh tim web Developer Zamedia.
          </p>
        </div>
      </section>
    </footer>
  );
}
