"use client";

import { useState, useRef, useEffect } from "react";
import Image from "next/image";
import Link from "next/link";
import { BookOpen, HeartHandshake, Phone, TriangleAlert, Calculator, RotateCcw, HandHeart, ChevronDown } from "lucide-react";

const API_URL = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`;

export default function HitungZakatPage() {
  const [jenisZakat, setJenisZakat] = useState("PENGHASILAN");
  const [gaji, setGaji] = useState("");
  const [penghasilanLain, setPenghasilanLain] = useState("");
  const [jumlahEmas, setJumlahEmas] = useState("");
  const [hargaEmas, setHargaEmas] = useState("2.864.143");
  const [jumlahJiwa, setJumlahJiwa] = useState("1");
  const [hargaBeras, setHargaBeras] = useState("50.000");

  const [showResult, setShowResult] = useState(false);
  const [zakatResult, setZakatResult] = useState(0);
  const [isNisab, setIsNisab] = useState(false);
  const [isDropdownOpen, setIsDropdownOpen] = useState(false);
  const dropdownRef = useRef<HTMLDivElement>(null);

  // Dynamic content from API
  const [heading, setHeading] = useState("TUNAIKAN ZAKAT, INFAK, DAN SEDEKAH ANDA DENGAN AMAN DAN MUDAH");
  const [kalkulatorTitle, setKalkulatorTitle] = useState("Kalkulator Zakat");
  const [kalkulatorDescription, setKalkulatorDescription] = useState(
    "Kalkulator zakat adalah layanan untuk mempermudah perhitungan jumlah zakat yang harus ditunaikan oleh setiap umat muslim sesuai ketetapan syariah. Oleh karena itu, bagi Anda yang ingin mengetahui berapa jumlah zakat yang harus ditunaikan, silahkan gunakan fasilitas Kalkulator Zakat dibawah ini."
  );
  const [disclaimerItems, setDisclaimerItems] = useState<string[]>([
    "Fatwa MUI No. 3 Tahun 2003 tentang Zakat Penghasilan",
    "Keputusan Majma' Fiqih Islami (OKI) tentang Zakat Kontemporer",
    "Pendapat mayoritas ulama kontemporer (Dr. Yusuf Qardhawi, dll)",
  ]);

  useEffect(() => {
    async function fetchContent() {
      try {
        const res = await fetch(`${API_URL}/content/layanan`);
        if (res.ok) {
          const data = await res.json();
          if (data?.hitung_zakat) {
            const hz = data.hitung_zakat;
            if (hz.heading) setHeading(hz.heading);
            if (hz.kalkulator_title) setKalkulatorTitle(hz.kalkulator_title);
            if (hz.kalkulator_description) setKalkulatorDescription(hz.kalkulator_description);
            if (hz.default_harga_emas) setHargaEmas(hz.default_harga_emas);
            if (hz.default_harga_beras) setHargaBeras(hz.default_harga_beras);
            if (hz.disclaimer_items && hz.disclaimer_items.length > 0) setDisclaimerItems(hz.disclaimer_items);
          }
        }
      } catch (e) {
        console.error("Failed to fetch hitung zakat content:", e);
      }
    }
    fetchContent();
  }, []);

  useEffect(() => {
    function handleClickOutside(event: MouseEvent) {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target as Node)) {
        setIsDropdownOpen(false);
      }
    }
    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  // Asumsi nisab 85 gram emas setahun / 12 bulan
  // ~ Rp 8.000.000 (Asumsi) / bulan
  const NISHAB_PER_BULAN = 8000000;

  const formatRupiah = (value: string) => {
    return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  };

  const handleGajiChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setGaji(formatRupiah(e.target.value));
  };

  const handlePenghasilanLainChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPenghasilanLain(formatRupiah(e.target.value));
  };

  const handleHitung = () => {
    if (jenisZakat === "PENGHASILAN") {
      const totalGaji = parseInt(gaji.replace(/\D/g, "") || "0", 10);
      const totalLain = parseInt(penghasilanLain.replace(/\D/g, "") || "0", 10);

      if (!gaji) {
        alert("Mohon isi Gaji per bulan Anda.");
        return;
      }

      const total = totalGaji + totalLain;
      const result = Math.floor(total * 0.025);

      setZakatResult(result);
      setIsNisab(total >= NISHAB_PER_BULAN);
      setShowResult(true);
    } else if (jenisZakat === "EMAS") {
      const beratEmas = parseFloat(jumlahEmas) || 0;
      const nominalHargaEmas = parseInt(hargaEmas.replace(/\D/g, "") || "0", 10);

      if (!jumlahEmas) {
        alert("Mohon isi Jumlah Emas yang dimiliki.");
        return;
      }

      const totalNilai = beratEmas * nominalHargaEmas;
      const result = Math.floor(totalNilai * 0.025);

      setZakatResult(result);
      setIsNisab(beratEmas >= 85);
      setShowResult(true);
    } else if (jenisZakat === "FITRAH") {
      const jiwa = parseInt(jumlahJiwa.replace(/\D/g, "") || "0", 10);
      const nominalBeras = parseInt(hargaBeras.replace(/\D/g, "") || "0", 10);

      if (!jiwa || jiwa < 1) {
        alert("Mohon isi Jumlah Jiwa minimal 1 orang.");
        return;
      }

      const totalFitrah = jiwa * nominalBeras;

      setZakatResult(totalFitrah);
      setIsNisab(true); // Fitrah wajib bagi seluruh muslim
      setShowResult(true);
    }
  };

  const handleReset = () => {
    setGaji("");
    setPenghasilanLain("");
    setJumlahEmas("");
    setJumlahJiwa("1");
    setHargaBeras("45.000");
    setShowResult(false);
    setZakatResult(0);
    setIsNisab(false);
  };

  return (
    <div className="min-h-screen bg-white font-poppins">
      {/* Container utama dengan max-width */}
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        {/* Header Section */}
        <div className="text-center mb-10 flex flex-col items-center">
          <Image
            src="/images/icon/Taman zakat hijau hitam.png"
            alt="Logo Taman Zakat"
            width={320}
            height={80}
            className="h-14 md:h-20 w-auto mb-6"
          />
          <h1 className="text-xl md:text-2xl font-bold text-zinc-900 uppercase tracking-wide max-w-2xl">
            {heading.includes("AMAN DAN MUDAH") ? (
              <>{heading.split("AMAN DAN MUDAH")[0]}<span className="text-[#5DA630]">AMAN DAN MUDAH</span></>
            ) : heading}
          </h1>
        </div>

        {/* Content Section */}
        <div className="max-w-3xl mx-auto">
          {/* Kalkulator Header */}
          <div className="mb-6">
            <h2 className="text-2xl font-bold text-[#5DA630] mb-3 border-b-2 border-[#5DA630] inline-block pb-1">
              {kalkulatorTitle}
            </h2>
            <p className="text-zinc-700 text-[15px] leading-relaxed">
              {kalkulatorDescription}
            </p>
          </div>

          <div className="flex flex-col sm:flex-row justify-center items-center gap-3 mb-10 z-10 relative">
            <span className="text-zinc-900 font-semibold text-lg">
              Jenis Zakat :
            </span>

            <div className="relative" ref={dropdownRef}>
              <button
                onClick={() => setIsDropdownOpen(!isDropdownOpen)}
                className="flex items-center justify-between gap-3 bg-[#2a6d40] hover:bg-[#205531] text-white text-[15px] font-semibold py-2.5 px-6 rounded-full outline-none cursor-pointer transition-all min-w-[220px] shadow-sm border border-[#1e4e2d]"
              >
                {jenisZakat}
                <ChevronDown
                  className={`w-4 h-4 transition-transform duration-300 ${isDropdownOpen ? "rotate-180" : ""}`}
                  strokeWidth={3}
                />
              </button>

              <div
                className={`absolute top-full left-0 mt-2 w-full bg-white border border-zinc-200 rounded-xl shadow-xl overflow-hidden z-20 transition-all duration-300 origin-top ${isDropdownOpen ? "opacity-100 scale-y-100" : "opacity-0 scale-y-0 pointer-events-none"}`}
              >
                {["PENGHASILAN", "EMAS", "FITRAH"].map((option) => (
                  <button
                    key={option}
                    onClick={() => {
                      setJenisZakat(option);
                      setIsDropdownOpen(false);
                      setShowResult(false); // Sembunyikan hasil kalau ganti jenis
                    }}
                    className={`w-full text-left px-5 py-3.5 text-[14px] font-semibold transition-colors ${jenisZakat === option ? "bg-[#F2F9EC] text-[#2a6d40]" : "text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900"} border-b border-zinc-100 last:border-b-0`}
                  >
                    {option}
                  </button>
                ))}
              </div>
            </div>
          </div>

          {/* Form Container */}
          <div className="border border-zinc-200 rounded-xl overflow-hidden bg-white shadow-sm mb-8">
            {/* Description Box */}
            <div className="bg-[#F2F9EC] p-5 md:p-6 border-b border-zinc-200 border-l-4 border-l-[#0B9B43]">
              {jenisZakat === "PENGHASILAN" ? (
                <p className="text-zinc-700 text-sm md:text-[15px] leading-relaxed">
                  Zakat penghasilan atau yang dikenal juga sebagai zakat profesi
                  adalah bagian dari zakat mal yang wajib dikeluarkan atas harta
                  yang berasal dari pendapatan / penghasilan rutin dari
                  pekerjaan yang tidak melanggar syariah. Nishab zakat
                  penghasilan sebesar 85 gram emas per tahun. Kadar zakat
                  penghasilan senilai 2,5%. Dalam praktiknya, zakat penghasilan
                  dapat ditunaikan setiap bulan dengan nilai nishab per bulannya
                  adalah setara dengan nilai seperduabelas dari 85 gram emas,
                  dengan kadar 2.5%. Jadi apabila penghasilan setiap bulan telah
                  melebihi nilai nishab bulanan, maka wajib dikeluarkan zakatnya
                  sebesar 2,5% dari penghasilannya tersebut.
                </p>
              ) : jenisZakat === "EMAS" ? (
                <div className="space-y-1">
                  <p className="text-zinc-800 font-semibold text-[15px]">
                    Rumus :{" "}
                    <span className="font-normal text-zinc-700">
                      Jumlah Emas (gram) × Harga Emas × 2.5%
                    </span>
                  </p>
                  <p className="text-zinc-800 font-semibold text-[15px]">
                    Nisab :{" "}
                    <span className="font-normal text-zinc-700">
                      85 gram Emas
                    </span>
                  </p>
                </div>
              ) : (
                <div className="space-y-1">
                  <p className="text-zinc-800 font-semibold text-[15px]">
                    Rumus :{" "}
                    <span className="font-normal text-zinc-700">
                      Jumlah Jiwa × Harga Beras (per jiwa)
                    </span>
                  </p>
                  <p className="text-sm text-zinc-600 mt-2 leading-relaxed">
                    Zakat Fitrah wajib bagi setiap muslim yang hidup pada bulan
                    Ramadhan. Besarannya setara dengan 2,5 kg atau 3,5 liter
                    beras/makanan pokok yang biasa dikonsumsi. Nominal harga
                    dapat disesuaikan dengan nilai beras di domisili Anda.
                  </p>
                </div>
              )}
            </div>

            {/* Inputs Box */}
            <div className="p-5 md:p-8">
              <div className="space-y-5">
                {jenisZakat === "PENGHASILAN" && (
                  <>
                    <div>
                      <label className="block text-zinc-800 font-medium mb-2">
                        Gaji saya per bulan
                      </label>
                      <div className="flex items-center border border-zinc-300 rounded-lg overflow-hidden focus-within:border-[#5DA630] focus-within:ring-1 focus-within:ring-[#5DA630] transition-all">
                        <span className="bg-zinc-50 px-4 py-2.5 text-zinc-600 font-medium border-r border-zinc-300">
                          Rp.
                        </span>
                        <input
                          type="text"
                          value={gaji}
                          onChange={handleGajiChange}
                          placeholder="0"
                          className="w-full px-4 py-2.5 text-zinc-900 font-semibold outline-none"
                        />
                      </div>
                    </div>

                    <div>
                      <label className="block text-zinc-800 font-medium mb-2">
                        Penghasilan lain-lain per bulan
                      </label>
                      <div className="flex items-center border border-zinc-300 rounded-lg overflow-hidden focus-within:border-[#5DA630] focus-within:ring-1 focus-within:ring-[#5DA630] transition-all">
                        <span className="bg-zinc-50 px-4 py-2.5 text-zinc-600 font-medium border-r border-zinc-300">
                          Rp.
                        </span>
                        <input
                          type="text"
                          value={penghasilanLain}
                          onChange={handlePenghasilanLainChange}
                          placeholder="0"
                          className="w-full px-4 py-2.5 text-zinc-900 font-semibold outline-none"
                        />
                      </div>
                    </div>
                  </>
                )}

                {jenisZakat === "EMAS" && (
                  <>
                    <div>
                      <label className="block text-zinc-800 font-medium mb-2">
                        Jumlah Emas yang dimiliki
                      </label>
                      <div className="flex items-center border border-zinc-300 rounded-lg overflow-hidden focus-within:border-[#5DA630] focus-within:ring-1 focus-within:ring-[#5DA630] transition-all">
                        <input
                          type="number"
                          value={jumlahEmas}
                          onChange={(e) => setJumlahEmas(e.target.value)}
                          placeholder="0"
                          className="w-full px-4 py-2.5 text-zinc-900 font-semibold outline-none"
                        />
                        <span className="bg-zinc-200 px-4 py-2.5 text-zinc-700 font-medium border-l border-zinc-300">
                          gram
                        </span>
                      </div>
                    </div>

                    <div>
                      <label className="block text-zinc-800 font-medium mb-2">
                        Harga Emas Saat Ini (per gram)
                      </label>
                      <div className="flex items-center border border-zinc-300 rounded-lg overflow-hidden focus-within:border-[#5DA630] focus-within:ring-1 focus-within:ring-[#5DA630] transition-all bg-white">
                        <span className="bg-zinc-50 px-4 py-2.5 text-zinc-600 font-medium border-r border-zinc-300">
                          Rp.
                        </span>
                        <input
                          type="text"
                          value={hargaEmas}
                          onChange={(e) =>
                            setHargaEmas(formatRupiah(e.target.value))
                          }
                          placeholder="0"
                          className="w-full px-4 py-2.5 text-zinc-900 font-semibold outline-none"
                        />
                      </div>
                      <p className="text-xs text-zinc-500 mt-2">
                        *Harga emas ini dapat Anda edit secara manual sesuai
                        dengan harga emas per hari ini.
                      </p>
                    </div>
                  </>
                )}

                {jenisZakat === "FITRAH" && (
                  <>
                    <div>
                      <label className="block text-zinc-800 font-medium mb-2">
                        Jumlah Jiwa (Orang)
                      </label>
                      <div className="flex items-center border border-zinc-300 rounded-lg overflow-hidden focus-within:border-[#5DA630] focus-within:ring-1 focus-within:ring-[#5DA630] transition-all">
                        <input
                          type="number"
                          value={jumlahJiwa}
                          onChange={(e) => setJumlahJiwa(e.target.value)}
                          placeholder="1"
                          min="1"
                          className="w-full px-4 py-2.5 text-zinc-900 font-semibold outline-none"
                        />
                        <span className="bg-zinc-200 px-4 py-2.5 text-zinc-700 font-medium border-l border-zinc-300">
                          Orang
                        </span>
                      </div>
                    </div>

                    <div>
                      <label className="block text-zinc-800 font-medium mb-2">
                        Harga Beras / Makanan Pokok (per Jiwa)
                      </label>
                      <div className="flex items-center border border-zinc-300 rounded-lg overflow-hidden focus-within:border-[#5DA630] focus-within:ring-1 focus-within:ring-[#5DA630] transition-all bg-white">
                        <span className="bg-zinc-50 px-4 py-2.5 text-zinc-600 font-medium border-r border-zinc-300">
                          Rp.
                        </span>
                        <input
                          type="text"
                          value={hargaBeras}
                          onChange={(e) =>
                            setHargaBeras(formatRupiah(e.target.value))
                          }
                          placeholder="0"
                          className="w-full px-4 py-2.5 text-zinc-900 font-semibold outline-none"
                        />
                      </div>
                      <p className="text-xs text-zinc-500 mt-2">
                        *Nilai default ini (Rp 50.000) adalah estimasi dari
                        BAZNAS untuk sebagian besar wilayah. Silakan ganti
                        sesuai harga beras 2.5kg di kota Anda (misal Rp 55.000,
                        Rp 60.000, dll).
                      </p>
                    </div>
                  </>
                )}

                <div className="pt-4 flex flex-wrap gap-3">
                  <button
                    onClick={handleHitung}
                    className="flex items-center gap-2 bg-[#0B9B43] hover:bg-[#098338] text-white font-medium py-2.5 px-6 rounded-md transition-colors"
                  >
                    <Calculator className="w-5 h-5" />
                    Hitung Zakat
                  </button>
                  <button
                    onClick={handleReset}
                    className="flex items-center gap-2 bg-zinc-500 hover:bg-zinc-600 text-white font-medium py-2.5 px-6 rounded-md transition-colors"
                  >
                    <RotateCcw className="w-5 h-5" />
                    Reset
                  </button>
                </div>
              </div>
            </div>
          </div>

          {/* Conditional Result Box */}
          {showResult && (
            <div className="bg-[#7fc248] rounded-xl p-6 md:p-8 text-center text-white mb-10 shadow-lg animate-in slide-in-from-bottom-4 fade-in duration-500">
              <h3 className="text-xl md:text-2xl font-bold mb-2">
                {isNisab
                  ? jenisZakat === "EMAS"
                    ? "Zakat Emas Anda"
                    : jenisZakat === "FITRAH"
                      ? "Zakat Fitrah Anda"
                      : "Zakat Penghasilan Anda"
                  : jenisZakat === "EMAS"
                    ? "Sedekah Emas Anda"
                    : "Sedekah Penghasilan Anda"}
              </h3>
              <div className="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-4">
                Rp {formatRupiah(zakatResult.toString())}
              </div>

              {!isNisab ? (
                <div className="flex flex-col items-center">
                  <div className="flex items-start md:items-center gap-2 text-sm md:text-base text-white/90 max-w-xl mx-auto text-left md:text-center">
                    <div className="mt-1 md:mt-0 flex-shrink-0 w-2 h-2 rounded-full bg-white/80" />
                    <p className="font-medium">
                      {jenisZakat === "EMAS" ? (
                        <>
                          <span className="font-extrabold uppercase tracking-wide">
                            Emas Anda Belum Mencapai Nisab.
                          </span>{" "}
                          Namun Anda Bisa Tetap Melakukan Kebaikan Dengan
                          Bersedekah.
                        </>
                      ) : (
                        <>
                          <span className="font-extrabold uppercase tracking-wide">
                            Penghasilan Anda Belum Mencapai Nisab.
                          </span>{" "}
                          Namun Anda Bisa Tetap Melakukan Kebaikan Dengan
                          Bersedekah.
                        </>
                      )}
                    </p>
                  </div>
                </div>
              ) : (
                <div className="flex flex-col items-center">
                  <div className="flex items-start md:items-center gap-2 text-sm md:text-base text-white/90 max-w-xl mx-auto text-left md:text-center">
                    <p className="font-medium">
                      {jenisZakat === "FITRAH" ? (
                        "Mari sucikan diri dan sempurnakan ibadah dengan menunaikan Zakat Fitrah Anda."
                      ) : (
                        <>
                          Alhamdulillah,{" "}
                          <span className="font-extrabold uppercase tracking-wide">
                            harta Anda telah mencapai nisab.
                          </span>{" "}
                          Mari tunaikan kewajiban zakat Anda.
                        </>
                      )}
                    </p>
                  </div>
                </div>
              )}

              <div className="mt-6">
                <Link
                  href="/layanan/konfirmasi-donasi"
                  className="inline-flex items-center gap-2 bg-white text-zinc-900 font-bold py-3 px-8 rounded-md hover:bg-zinc-100 hover:scale-105 transition-all"
                >
                  <HandHeart className="w-5 h-5" />
                  {isNisab ? "Zakat Sekarang" : "Sedekah Sekarang"}
                </Link>
              </div>
            </div>
          )}

          {/* Bottom Info Icons */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 py-10 border-t border-zinc-200 text-center">
            <div className="flex flex-col items-center">
              <BookOpen
                className="w-12 h-12 text-[#0B9B43] mb-4"
                strokeWidth={1.5}
              />
              <h4 className="font-bold text-zinc-900 mb-2">Ketentuan Zakat</h4>
              <p className="text-zinc-600 text-sm">
                Nisab : 85 gram emas | Haul : 1 tahun | Tarif: 2,5%
              </p>
            </div>

            <div className="flex flex-col items-center">
              <HeartHandshake
                className="w-12 h-12 text-[#0B9B43] mb-4"
                strokeWidth={1.5}
              />
              <h4 className="font-bold text-zinc-900 mb-2">Manfaat Zakat</h4>
              <p className="text-zinc-600 text-sm">
                Zakat menyucikan harta dan membantu sesama
              </p>
            </div>

            <div className="flex flex-col items-center">
              <Phone
                className="w-12 h-12 text-[#0B9B43] mb-4"
                strokeWidth={1.5}
              />
              <h4 className="font-bold text-zinc-900 mb-2">Konsultasi</h4>
              <p className="text-zinc-600 text-sm">
                Hubungi TAZA untuk konsultasi lebih lanjut
              </p>
            </div>
          </div>

          {/* Warning / Disclaimer */}
          <div className="border border-[#F2C94C] border-l-[10px] bg-white p-6 md:p-8 rounded-[28px] shadow-sm mb-10">
            <div className="flex items-center gap-3 mb-4">
              <TriangleAlert
                className="w-7 h-7 text-white"
                fill="#F2C94C"
                strokeWidth={2.5}
              />
              <h4 className="text-lg md:text-xl font-bold text-zinc-900">
                Disclaimer Penting
              </h4>
            </div>
            <p className="text-zinc-800 font-semibold mb-3 text-[15px] md:text-base">
              Perhitungan ini menggunakan :
            </p>
            <ul className="list-disc list-outside ml-6 text-zinc-700 text-[14px] md:text-[15px] space-y-2 marker:text-zinc-500 font-medium">
              {disclaimerItems.map((item, idx) => (
                <li key={idx}>{item}</li>
              ))}
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
}
