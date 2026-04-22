import RightBarAudit from "@/components/layout/rightbar-audit";

export default function AuditSyariah() {
  return (
    <section className="bg-white min-h-screen p-10 md:p-14 font-poppins">
      {/* isi konten audit */}
      <div className="min-h-[100px] flex flex-col md:flex-row justify-between gap-8 md:gap-4">
        <div className="flex-1">
          <h3 className="mt-10 text-black font-semibold text-xl md:text-2xl text-zinc-black">
            Audit Syariah
          </h3>

          <p className="mt-5 text-base md:text-lg text-black max-w-2xl">
            Taman Zakat sebagai LAZ Nasional berizin resmi dari Kemenag,
            senantiasa berupaya secara maksimal tunduk dan patuh terhadap
            ketentuan perundangan.
          </p>

          <p className="mt-2 mb-8 text-base md:text-lg text-black max-w-2xl">
            Hasil audit keuangan Taman Zakat menunjukkan bahwa pengelolaan dana
            dilakukan secara transparan dan akuntabel.Audit Keuangan oleh KAP
            (Kantor Akuntan Publik) kami lakukan sebagai bentuk upaya pemenuhan
            kepatuhan terhadap ketentuan perundangan sekaligus untuk meyakinkan
            kembali bahwa pengelolaan keuangan ZIS dan DSKL yang telah kami
            lakukan adalah wajar, sesuai dengan prinsip dan standar akuntansi
            yang berlaku di Indonesia.
          </p>

          <a
            href="/tata-kelola/audit"
            className=" bg-[#5DA630] text-white px-7 py-2.5 rounded-full hover:bg-[#4A8A25] transition-colors"
          >
            Detail Audit Syariah
          </a>
        </div>

        {/* kanan */}
        <RightBarAudit />
      </div>
    </section>
  );
}
