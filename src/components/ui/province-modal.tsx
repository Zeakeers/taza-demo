"use client";
import React, { useEffect, useState } from "react";
import { createPortal } from "react-dom";
import { motion, AnimatePresence } from "framer-motion";
import Image from "next/image";
import { ProvinceData } from "@/data/province-data";

interface ProvinceModalProps {
  province: ProvinceData | null;
  isActive: boolean;
  onClose: () => void;
}

export default function ProvinceModal({ province, isActive, onClose }: ProvinceModalProps) {
  const [mounted, setMounted] = useState(false);
  const [orientations, setOrientations] = useState<Record<number, 'portrait' | 'landscape'>>({});

  useEffect(() => {
    setMounted(true);
    if (province) {
      document.body.style.overflow = "hidden";
      // Reset orientations when a new province is opened
      setOrientations({});
    } else {
      document.body.style.overflow = "unset";
    }
    return () => {
      document.body.style.overflow = "unset";
    };
  }, [province]);

  if (!mounted || !province) return null;

  const modalContent = (
    <AnimatePresence>
      <div className="fixed inset-0 z-[99999] flex items-center justify-center p-4 md:p-10">
        {/* Backdrop */}
        <motion.div
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          exit={{ opacity: 0 }}
          onClick={onClose}
          className="absolute inset-0 bg-black/85 backdrop-blur-md"
        />

        {/* Modal Container */}
        <motion.div
          initial={{ opacity: 0, scale: 0.95, y: 20 }}
          animate={{ opacity: 1, scale: 1, y: 0 }}
          exit={{ opacity: 0, scale: 0.95, y: 20 }}
          transition={{ type: "spring", damping: 30, stiffness: 300 }}
          className={`relative w-full ${isActive ? 'max-w-7xl h-auto max-h-[90vh] md:h-full md:max-h-[80vh] flex-col' : 'max-w-lg md:max-w-xl h-auto flex-col'} bg-white rounded-[2.5rem] md:rounded-[3rem] shadow-[0_32px_80px_-16px_rgba(0,0,0,0.6)] flex md:flex-row overflow-y-auto md:overflow-hidden transition-all duration-500`}
        >
          {/* Close Button */}
          <button
            onClick={onClose}
            className="absolute top-6 right-6 md:top-8 md:right-8 z-50 w-10 h-10 md:w-12 md:h-12 rounded-full bg-gray-100 flex items-center justify-center hover:bg-[#3B7A1C] hover:text-white text-gray-500 transition-all hover:rotate-90 active:scale-90 shadow-sm border border-gray-200/50"
          >
            <span className="text-2xl md:text-3xl leading-none font-light">&times;</span>
          </button>

          {/* Info Section */}
          <div className={`w-full ${isActive ? 'md:w-[38%] p-8 md:p-14 border-b md:border-b-0 md:border-r h-full' : 'w-full p-10 md:p-16 text-center'} flex flex-col bg-gray-50/50 border-gray-100 shrink-0`}>
            <div className={`${isActive ? 'md:flex-1' : ''} flex flex-col ${!isActive ? 'items-center justify-center' : ''}`}>
              <span className="text-[#3B7A1C] text-[9px] md:text-[10px] font-black tracking-[0.5em] uppercase mb-4 block">WILAYAH PENYALURAN</span>
              <h2 className={`text-4xl md:text-6xl font-black text-black leading-[0.9] tracking-tighter ${isActive ? 'mb-10 text-left' : 'mb-8 text-center'}`}>
                {province.name}
              </h2>

              {isActive ? (
                <div className="space-y-8 md:space-y-10 text-left">
                  <div className="flex flex-col">
                    <span className="text-gray-400 text-[9px] md:text-[10px] font-bold uppercase tracking-[0.2em] mb-3">Penerima Manfaat</span>
                    <div className="flex items-baseline gap-3">
                      <span className="text-5xl font-black text-[#7FC248] tracking-tighter">{province.beneficiaries}</span>
                      <span className="text-gray-400 font-bold text-base uppercase">Jiwa</span>
                    </div>
                  </div>

                  <div className="flex flex-col">
                    <span className="text-gray-400 text-[9px] md:text-[10px] font-bold uppercase tracking-[0.2em] mb-3">Dana Disalurkan</span>
                    <span className="text-5xl font-black text-gray-900 tracking-tighter">{province.funds}</span>
                  </div>
                </div>
              ) : (
                <div className="flex flex-col items-center">
                  <div className="w-20 h-20 bg-[#7FC248]/10 rounded-[2rem] flex items-center justify-center mb-8">
                    <svg className="w-10 h-10 text-[#3B7A1C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                  </div>
                  <h3 className="text-3xl font-black text-gray-900 mb-4">Belum Ada Penyaluran</h3>
                  <p className="text-gray-500 max-w-sm leading-relaxed text-base mb-12">
                    Saat ini Taman Zakat belum beroperasi secara resmi di <span className="font-bold text-black">{province.name}</span>. Dukung kami agar program kebaikan bisa menjangkau wilayah ini segera!
                  </p>
                  <button
                    onClick={onClose}
                    className="bg-[#7FC248] text-white font-black px-12 py-5 rounded-2xl hover:bg-[#3B7A1C] transition-all shadow-xl hover:shadow-[#7FC248]/30 uppercase tracking-widest text-[11px] w-full md:w-auto"
                  >
                    Dukung Sekarang
                  </button>
                </div>
              )}
            </div>

            {isActive && (
              <div className="mt-10 hidden md:block">
                <div className="p-8 bg-[#7FC248]/5 rounded-[2.5rem] border border-[#7FC248]/10 relative overflow-hidden group">
                  <p className="text-base font-bold text-[#3B7A1C] italic leading-relaxed relative z-10">
                    &quot;{province.quote || `Setiap rupiah yang Anda salurkan menjadi harapan baru bagi saudara-saudara kita di ${province.name}.`}&quot;
                  </p>
                </div>
              </div>
            )}
          </div>

          {/* Right: Gallery Section (Desktop Only) */}
          {isActive && (
            <div className="w-full md:w-[62%] p-10 md:p-16 bg-white md:overflow-y-auto md:h-full scrollbar-none" style={{ scrollbarWidth: 'none', msOverflowStyle: 'none' }}>
              <style jsx>{`
                 .scrollbar-none::-webkit-scrollbar {
                   display: none;
                 }
               `}</style>
              <div className="flex items-center justify-between mb-10">
                <span className="text-gray-400 text-[10px] md:text-[11px] font-black tracking-[0.4em] uppercase">DOKUMENTASI AKSI NYATA</span>
              </div>

              {(() => {
                const images = province.images || [];

                return (
                  <div className="grid grid-cols-2 gap-4 md:gap-6 auto-rows-[140px] md:auto-rows-[180px] grid-flow-dense">
                    {images.map((img, i) => {
                      const orient = orientations[i] || 'landscape'; // default landscape
                      
                      let gridClass = "";
                      if (orient === 'portrait') {
                        // Portrait: 1 kolom lebar, 2 baris tinggi
                        gridClass = "col-span-1 row-span-2";
                      } else {
                        // Landscape
                        if (i === 0) {
                          // Gambar pertama landscape dibuat besar (featured)
                          gridClass = "col-span-2 row-span-2";
                        } else {
                          // Landscape lainnya dibuat kecil agar bisa mengisi slot kosong di mobile & desktop
                          gridClass = "col-span-1 row-span-1";
                        }
                      }

                      return (
                        <motion.div
                          key={i}
                          whileHover={{ scale: 0.98, rotate: i % 2 === 0 ? -1 : 1 }}
                          className={`relative rounded-[2rem] md:rounded-[2.5rem] overflow-hidden shadow-xl md:shadow-2xl border border-gray-100 group/img ${gridClass}`}
                        >
                          <Image
                            src={img}
                            alt={`Aksi Taman Zakat ${province.name} ${i + 1}`}
                            fill
                            className="object-cover transition-transform duration-1000 group-hover/img:scale-110"
                            onLoad={(e) => {
                              const { naturalWidth, naturalHeight } = e.currentTarget;
                              setOrientations(prev => ({
                                ...prev,
                                [i]: naturalWidth >= naturalHeight ? 'landscape' : 'portrait'
                              }));
                            }}
                          />
                          <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 md:p-8">
                            <p className="text-white font-bold text-[10px] md:text-sm tracking-wide">Penyaluran Program #{i + 1}</p>
                          </div>
                        </motion.div>
                      );
                    })}
                  </div>
                );
              })()}

              <div className="mt-12 md:mt-16 border-t border-gray-100 pt-10 text-center">
                <p className="text-xs md:text-sm text-gray-300 font-bold uppercase tracking-[0.3em]">Terima kasih atas kebaikan Anda</p>
              </div>
            </div>
          )}
        </motion.div>
      </div>
    </AnimatePresence>
  );

  return createPortal(modalContent, document.body);
}

