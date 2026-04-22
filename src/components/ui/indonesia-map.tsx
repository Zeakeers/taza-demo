"use client";
import React, { useState } from "react";
import { motion, AnimatePresence } from "framer-motion";
import ProvinceModal from "./province-modal";
import { provinceData, getDefaultData } from "@/data/province-data";
import { INDONESIA_PATHS } from "@/data/indonesia-paths";

export default function IndonesiaMap() {
  const [selectedId, setSelectedId] = useState<string | null>(null);
  const [zoomingId, setZoomingId] = useState<string | null>(null);

  const handleProvinceClick = (province: typeof INDONESIA_PATHS[0]) => {
    setZoomingId(province.id);
    // After animation, show modal
    setTimeout(() => {
      setSelectedId(province.id);
      setZoomingId(null);
    }, 600);
  };

  const selectedData = selectedId ? (provinceData[selectedId] || getDefaultData(selectedId, INDONESIA_PATHS.find(p => p.id === selectedId)?.title || "Provinsi")) : null;

  return (
    <div className="flex flex-col items-center justify-center w-full mb-20 md:mb-24 px-4 md:px-0">
      <div className="w-full max-w-7xl relative group/map overflow-x-auto md:overflow-x-visible no-scrollbar pb-16">
        <div className="min-w-[750px] md:min-w-0 w-full aspect-[792/316] relative transition-all duration-500">
          <svg
            viewBox="0 0 792 316"
            className="w-full h-full filter drop-shadow-2xl"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            {/* Static Background Layer */}
            <rect width="792" height="316" fill="transparent" />
            
            <AnimatePresence>
              {INDONESIA_PATHS.map((province) => {
                const isActive = !!provinceData[province.id];
                const activeColor = "#3B7A1C"; // Ijo Tua
                const inactiveColor = "#A2D57D"; // Ijo Muda
                
                return (
                  <motion.path
                    key={province.id}
                    d={province.d}
                    initial={{ 
                      fill: isActive ? activeColor : inactiveColor, 
                      opacity: 0.8, 
                      stroke: "#ffffff", 
                      strokeWidth: 0.5 
                    }}
                    whileHover={{ 
                      fill: "#7FC248", 
                      opacity: 1, 
                      scale: 1.05,
                      zIndex: 20,
                      stroke: "#ffffff",
                      strokeWidth: 1,
                      filter: "drop-shadow(0 0 8px rgba(127, 194, 72, 0.5))"
                    }}
                    animate={
                      zoomingId === province.id
                        ? { 
                            scale: 12, 
                            opacity: 0, 
                            transition: { duration: 0.6, ease: [0.32, 0, 0.67, 0] } 
                          }
                        : { 
                            scale: 1, 
                            opacity: 0.8,
                            fill: isActive ? activeColor : inactiveColor,
                            stroke: "#ffffff",
                            strokeWidth: 0.5,
                            transition: { duration: 0.3 }
                          }
                    }
                    onClick={() => handleProvinceClick(province)}
                    className="cursor-pointer transition-colors duration-300 outline-none"
                    style={{ transformOrigin: "center", transformBox: "fill-box" }}
                  >
                    <title>{province.title}</title>
                  </motion.path>
                );
              })}
            </AnimatePresence>
          </svg>
        </div>

        {/* Mobile Scroll Hint */}
        <div className="md:hidden flex justify-center items-center gap-2 mt-4 text-gray-400">
           <svg className="w-5 h-5 animate-bounce-x" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
           </svg>
           <p className="text-[10px] font-bold uppercase tracking-widest">Geser untuk jelajahi pulau</p>
        </div>

        {/* Hover Hint - Desktop Only */}
        <div className="hidden md:block absolute bottom-0 left-1/2 -translate-x-1/2 bg-[#3B7A1C]/10 backdrop-blur-md px-6 py-3 rounded-full border border-[#3B7A1C]/20 opacity-60 group-hover/map:opacity-100 transition-all duration-500 pointer-events-none shadow-sm">
           <p className="text-[10px] text-[#3B7A1C] font-black tracking-[0.2em] uppercase whitespace-nowrap">Klik wilayah untuk melihat jejak kebaikan</p>
        </div>
      </div>

      <ProvinceModal 
        province={selectedData} 
        isActive={!!selectedId && !!provinceData[selectedId]}
        onClose={() => setSelectedId(null)} 
      />
    </div>
  );
}
