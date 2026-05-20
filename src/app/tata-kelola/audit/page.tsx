"use client";

import RightBarAudit from "@/components/layout/rightbar-audit";
import { useEffect, useState } from "react";

export default function AuditKeuangan() {
  const [reports, setReports] = useState<any[]>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const url = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`;
        const res = await fetch(`${url}/tata-kelola/financial-report`);
        if (res.ok) setReports(await res.json());
      } catch (err) {
        console.error("Failed to fetch financial reports", err);
      }
    };
    fetchData();
  }, []);

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
              {reports.map((report) => (
                <li key={report.id}>
                  {report.file_url ? (
                    <a href={report.file_url} target="_blank" rel="noopener noreferrer" className="hover:underline">
                      {report.title} {report.year}
                    </a>
                  ) : (
                    <span>{report.title} {report.year}</span>
                  )}
                </li>
              ))}
              {reports.length === 0 && (
                <li className="text-gray-400">Belum ada laporan finansial.</li>
              )}
            </ul>
          </div>
        </div>

        {/* kanan */}
        <RightBarAudit />
      </div>
    </section>
  );
}
