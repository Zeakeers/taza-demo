"use client";

import Image from "next/image";

interface TestimoniItem {
  image?: string;
  name: string;
  role: string;
  quote: string;
}

export default function TestimoniSlider({ data }: { data: TestimoniItem[] }) {
  if (!data || data.length === 0) return null;

  // Duplicate data to ensure seamless loop
  // We double the data to create the infinite effect
  const displayData = [...data, ...data, ...data, ...data];

  return (
    <section className="w-full py-20 bg-[#F9FBF8] overflow-hidden">
      <div className="max-w-6xl mx-auto px-4 text-center mb-16">
        <h2 className="text-3xl sm:text-4xl font-extrabold text-black mb-4">
          Apa Kata Mereka?
        </h2>
        <p className="text-zinc-500 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
          Kisah nyata dari para donatur dan penerima manfaat yang telah bersama-sama mengalirkan kebaikan melalui Taman Zakat.
        </p>
      </div>

      <div className="relative flex overflow-x-hidden group">
        <div className="animate-marquee whitespace-nowrap py-4 group-hover:[animation-play-state:paused]">
          {displayData.map((item, idx) => (
            <div
              key={idx}
              className="w-[320px] sm:w-[400px] bg-white border border-zinc-100 rounded-[2.5rem] p-8 sm:p-10 shadow-[0_10px_30px_rgba(0,0,0,0.03)] flex flex-col items-center text-center shrink-0 mx-4 whitespace-normal transition-transform hover:scale-[1.02] duration-300"
            >
              <div className="w-20 h-20 rounded-full overflow-hidden mb-6 ring-4 ring-[#7FC248]/10 shadow-lg">
                <Image
                  src={item.image || "/images/placeholder.png"}
                  alt={item.name}
                  width={80}
                  height={80}
                  className="object-cover w-full h-full"
                />
              </div>

              <div className="mb-8 relative">
                <svg className="absolute -top-4 -left-4 w-8 h-8 text-[#7FC248]/10" fill="currentColor" viewBox="0 0 32 32">
                  <path d="M10 8v8H6v-8h4zm12 0v8h-4v-8h4zM4 16h8v8H4v-8zm12 0h8v8h-8v-8z" />
                </svg>
                <p className="text-zinc-600 italic leading-relaxed text-sm sm:text-base relative z-10">
                  "{item.quote}"
                </p>
              </div>

              <div className="mt-auto">
                <h4 className="font-bold text-black text-lg">{item.name}</h4>
                <div className="h-1 w-12 bg-[#7FC248] mx-auto my-3 rounded-full"></div>
                <p className="text-xs font-bold text-[#7FC248] uppercase tracking-widest">{item.role}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
