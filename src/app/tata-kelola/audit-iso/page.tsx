import RightBarAudit from "@/components/layout/rightbar-audit";

export default function AuditISO() {
    return (
      <section className="bg-white min-h-screen p-10 md:p-14">
        {/* isi konten audit */}
        <div className="min-h-[100px] flex flex-col md:flex-row justify-between gap-8 md:gap-4">
          <div className="">
            <h3 className="mt-10 text-black font-semibold text-xl md:text-2xl text-zinc-black">
              Audit ISO
            </h3>

            <p className="mt-5 text-base md:text-lg text-black max-w-2xl">
              Dengan mengusung semangat continuous improvement untuk menjaga
              kepercayaan dari para stakeholder, Rumah Zakat senantiasa terus
              berbenah dalam banyak aspek, salah satunya dalam perbaikan system
              management. Semangat tersebut kami wujudkan dengan menerapkan
              standar internasional ISO sejak tahun 2012.
            </p>

            <p className="mt-2 mb-5 text-base md:text-lg text-black max-w-2xl">
              Rumah Zakat pertama kali menerapkan standar QMS (quality
              management system) ISO 9001:2008 untuk lingkup zakat distribution
              di tahun 2012, yang kemudian dilakukan upgrade sesuai standar ISO
              9001:2015 sejak tahun 2017.{" "}
              <span className="text-[#7fc248]">
                Klik Sertifikat ISO 9001 Zakat Distribution
              </span>
            </p>

            <p className="mt-2 mb-5 text-base md:text-lg text-black max-w-2xl">
              Pada tahun 2018, setelah 6 tahun menerapakan standar QMS ISO 9001
              untuk lingkup zakat distribution, Rumah Zakat menerapkan standar
              ISO yang sama untuk lingkup customer relationship management for
              donors.{" "}
              <span className="text-[#7fc248]">
                Klik Sertifikat ISO 9001 Customer Relationship Management for
                Donors
              </span>
            </p>

            <p className="mt-2 mb-5 text-base md:text-lg text-black max-w-2xl">
              Sejak tahun 2021, Rumah Zakat menerapkan standar ABMS
              (anti-bribery management system) ISO 37001:2016 untuk lingkup
              operational activities for human capital management process and
              procurement process. Di tahun 2025, lingkup sertifikasi difokuskan
              pada salah satu kegiatan utama yaitu “Unrestricted Zakat
              Distribution”.
              <span className="text-[#7fc248]">
                Klik Sertifikat ISO 37001 Unrestricted Zakat Distribution
              </span>
            </p>
          </div>

          {/* kanan */}
          <RightBarAudit />
        </div>
      </section>
    );
}