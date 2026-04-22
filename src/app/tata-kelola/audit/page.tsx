import RightBarAudit from "@/components/layout/rightbar-audit";

export default function AuditKeuangan() {
  return (
    <section className="bg-white min-h-screen p-10 font-poppins">
      <div className="flex flex-col md:flex-row items-center md:items-start justify-center md:justify-between gap-10 w-full">
        {/* kiri */}
        <div className="w-full md:flex-1 md:flex md:justify-center">
          <div className="w-full max-w-2xl">
            <h2 className="text-black text-3xl font-semibold">
              Financial Report
            </h2>
            <ul className="list-disc list-inside space-y-2 text-[#666699] ml-2 mt-4">
              <li>Laporan Keuangan Rumah Zakat 2017</li>
              <li>Laporan Keuangan Rumah Zakat 2018</li>
              <li>Laporan Keuangan Rumah Zakat 2019</li>
              <li>Laporan Keuangan Rumah Zakat 2020</li>
              <li>Laporan Keuangan Rumah Zakat 2021</li>
              <li>Laporan Keuangan Rumah Zakat 2022</li>
              <li>Laporan Keuangan Rumah Zakat 2023</li>
              <li>Laporan Keuangan Rumah Zakat 2024</li>
              <li>Laporan Keuangan Rumah Zakat 2025</li>
            </ul>
          </div>
        </div>

        {/* kanan */}
        <RightBarAudit />
      </div>
    </section>
  );
}
