"use client";

import Link from "next/link";
import Image from "next/image";
import { Home, ArrowLeft } from "lucide-react";

export default function NotFound() {
  return (
    <div className="min-h-[80vh] flex flex-col items-center justify-center bg-white px-4 sm:px-6 lg:px-8 py-20 text-center">
      {/* 404 Graphic Area */}
      <div className="relative mb-8 flex items-center justify-center min-h-[200px] md:min-h-[280px]">
        <h1 className="absolute text-[160px] md:text-[250px] font-extrabold text-[#F2F9EC] leading-none mb-0 select-none z-0">
          404
        </h1>
        <div className="relative z-10 flex items-center justify-center">
          <Image
            src="/images/icon/Taman zakat hijau hitam.png"
            alt="Logo Taman Zakat"
            width={400}
            height={100}
            className="h-16 md:h-24 w-auto drop-shadow-sm"
          />
        </div>
      </div>

      {/* Main Content */}
      <h2 className="text-2xl md:text-4xl font-bold text-zinc-900 mb-4 tracking-tight">
        Halaman Tidak Ditemukan
      </h2>
      
      <p className="text-zinc-500 text-base md:text-lg max-w-md mx-auto mb-10 leading-relaxed">
        Maaf, halaman yang Anda cari mungkin telah dipindahkan, 
        dihapus, atau Anda salah memasukkan alamat URL.
      </p>

      {/* Action Buttons */}
      <div className="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
        <button 
          onClick={() => window.history.back()}
          className="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-zinc-700 bg-zinc-100 hover:bg-zinc-200 hover:text-zinc-900 transition-all font-semibold"
        >
          <ArrowLeft className="w-5 h-5" />
          Kembali
        </button>

        <Link 
          href="/" 
          className="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-white bg-[#5DA630] hover:bg-[#4d8a28] shadow-lg shadow-[#5DA630]/30 hover:shadow-[#5DA630]/50 hover:-translate-y-0.5 transition-all font-semibold"
        >
          <Home className="w-5 h-5" />
          Halaman Utama
        </Link>
      </div>
    </div>
  );
}
