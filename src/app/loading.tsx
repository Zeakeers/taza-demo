import Image from "next/image";

export default function Loading() {
  return (
    <div className="fixed inset-0 z-[9999] flex flex-col items-center justify-center w-full h-screen bg-white overflow-hidden">
      {/* Background Logo */}
      <div className="absolute inset-0 flex items-center justify-center opacity-[0.05] pointer-events-none">
        <Image
          src="/images/icon/taman zakat  logo .svg"
          alt="Taman Zakat Background"
          width={500}
          height={500}
          className="w-[250px] h-[250px] md:w-[400px] md:h-[400px] object-contain"
          priority
        />
      </div>

      <div className="relative z-10 flex items-center justify-center">
        <div className="w-12 h-12 border-4 border-[#F2F9EC] border-t-[#5DA630] rounded-full animate-spin shadow-sm"></div>
        <p className="absolute top-full mt-3 text-[#5DA630]/80 font-medium animate-pulse text-sm md:text-base">Memuat...</p>
      </div>
    </div>
  );
}
