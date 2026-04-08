"use client";

import { useState } from "react";
import Image from "next/image";

// Placeholder untuk menaruh URL gambar masing-masing kategori
// Isi string kosong ("") dengan URL gambar, misalnya: "/images/kesehatan.jpg"
const categories = [
  { id: "Kesehatan", image: "" },
  { id: "Ekonomi", image: "" },
  { id: "Dakwah", image: "" },
  { id: "Sosial", image: "" },
  { id: "Kemanusiaan", image: "" },
  { id: "Pendidikan", image: "" },
];

export default function BerbagiMengubahKehidupan() {
  const [activeCategory, setActiveCategory] = useState("Ekonomi");

  const currentCategory = categories.find((c) => c.id === activeCategory) || categories[1];

  return (
    <section className="mt-12 px-4">
      <div className="text-center mb-8">
        <h2 className="text-sm sm:text-base font-normal tracking-[0.05em] text-black uppercase">
          KEBAIKAN DIMULAI DI SINI
        </h2>
        <h3 className="text-xl sm:text-2xl font-normal text-black mt-1">
          BERBAGI MENGUBAH KEHIDUPAN
        </h3>
      </div>

      <div className="max-w-5xl mx-auto border border-gray-400 flex flex-col justify-between h-[400px] sm:h-[500px] lg:h-[600px] relative bg-white overflow-hidden">
        {/* Background Image Container */}
        <div className="absolute inset-0 bg-gray-50 flex items-center justify-center z-0 transition-opacity duration-500">
          {currentCategory.image ? (
            <Image
              src={currentCategory.image}
              alt={currentCategory.id}
              fill
              className="object-cover"
              priority
            />
          ) : (
            <span className="text-xl sm:text-2xl font-bold text-black opacity-30">
              Change Picture ({currentCategory.id})
            </span>
          )}
        </div>

        {/* Top Buttons inside Grid */}
        <div className="relative z-10 flex flex-wrap justify-center gap-3 sm:gap-4 mt-6 max-w-4xl mx-auto w-full px-4">
          {categories.map((item) => (
            <button
              key={item.id}
              onClick={() => setActiveCategory(item.id)}
              className={`px-4 py-1.5 border rounded-md text-sm font-medium transition-colors ${
                activeCategory === item.id
                  ? "border-gray-500 bg-[#D4E2D8] text-black shadow-sm"
                  : "border-gray-500 bg-white text-black hover:bg-gray-100"
              }`}
            >
              {item.id}
            </button>
          ))}
        </div>

        {/* Bottom Right Info Box inside Grid */}
        <div className="relative z-10 self-end m-6 sm:m-10 bg-[#F5F5F5] p-5 w-72 rounded-md border border-gray-400 shadow-sm">
          <p className="text-xs sm:text-sm text-black leading-relaxed font-medium">
            Akses berbagai layanan zakat digital dalam satu pengalaman yang sederhana dan efisien.
          </p>
          <a
            href="#"
            className="font-semibold text-xs sm:text-sm text-black mt-4 inline-block border-b-2 border-[#7FC248] pb-0.5 hover:text-[#7FC248] transition-colors"
          >
            Learn about lives changed
          </a>
        </div>
      </div>
    </section>
  );
}
