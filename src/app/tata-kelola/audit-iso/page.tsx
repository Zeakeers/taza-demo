"use client";

import RightBarAudit from "@/components/layout/rightbar-audit";
import { useEffect, useState } from "react";

export default function AuditISO() {
  const [items, setItems] = useState<any[]>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const url = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`;
        const res = await fetch(`${url}/tata-kelola/audit-iso`);
        if (res.ok) setItems(await res.json());
      } catch (err) {
        console.error("Failed to fetch audit iso data", err);
      }
    };
    fetchData();
  }, []);

  return (
    <section className="bg-white min-h-screen p-10 md:p-14 font-poppins">
      <div className="min-h-[100px] flex flex-col md:flex-row justify-between gap-8 md:gap-4">
        <div className="">
          <h3 className="mt-10 text-black font-semibold text-xl md:text-2xl text-zinc-black">
            Audit ISO
          </h3>

          {items.map((item) => (
            <p key={item.id} className="mt-5 mb-5 text-base md:text-lg text-black max-w-2xl whitespace-pre-wrap">
              {item.description}{" "}
              {item.link_text && (
                <a 
                  href={item.file_url || "#"} 
                  target={item.file_url ? "_blank" : "_self"} 
                  rel={item.file_url ? "noopener noreferrer" : ""} 
                  className="text-[#7fc248] hover:underline cursor-pointer"
                  onClick={(e) => {
                    if (!item.file_url) {
                      e.preventDefault();
                      alert('File sertifikat belum diunggah oleh admin.');
                    }
                  }}
                >
                  {item.link_text}
                </a>
              )}
            </p>
          ))}
          {items.length === 0 && (
            <p className="mt-5 text-gray-400">Belum ada data Audit ISO.</p>
          )}
        </div>

        {/* kanan */}
        <RightBarAudit />
      </div>
    </section>
  );
}
