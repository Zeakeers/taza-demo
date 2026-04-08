import React from 'react';

export default function QRCodeDonasiPage() {
  return (
    <div className="bg-white text-zinc-800 min-h-screen relative overflow-hidden">
      <div className="mx-auto max-w-[1280px] px-4 md:px-8 lg:px-12 py-12 md:py-20 relative min-h-[800px]">
        
        {/* Decorative Vertical Line */}
        <div className="absolute left-[8%] md:left-[10%] lg:left-[12%] top-12 bottom-0 w-[2px] bg-[#54752b]"></div>
        
        {/* Decorative Horizontal Lines - top left */}
        <div className="absolute left-0 right-[60%] md:right-[50%] lg:right-[35%] top-32 h-[2px] bg-[#eef6e1]"></div>
        
        {/* Main Content Container */}
        <div className="relative z-10 w-full flex flex-col items-center justify-center pl-[8%] md:pl-[10%] lg:pl-[12%] pt-8">
          
          {/* Titles */}
          <div className="text-center mb-8 relative z-20">
            {/* To mask the line under the title if it overlaps, though the bg is white */}
            <div className="bg-white inline-block px-4">
              <h1 className="text-2xl md:text-3xl lg:text-4xl font-sans font-bold text-black mb-4">
                Satu Scan, Banyak Kebaikan
              </h1>
              <p className="text-base md:text-lg lg:text-[20px] font-sans text-zinc-800 max-w-[700px] mx-auto leading-relaxed">
                Berbagi kini semakin mudah. Dukung berbagai program
                <br className="hidden md:block" />
                {" "}kebaikan melalui satu QR code sederhana.
              </p>
            </div>
          </div>

          {/* QR Code Section */}
          <div className="relative mt-8 md:mt-12 w-full max-w-[320px] md:max-w-[420px] lg:max-w-[500px] mx-auto z-10 flex justify-center">
            
            <div className="relative w-full bg-white p-[28px] md:p-[36px]">
              
              {/* --- OLIVE GREEN LINES --- */}
              <div className="absolute top-[8px] md:top-[11px] bottom-[8px] md:bottom-[11px] left-0 w-[2.5px] md:w-[3px] bg-[#92AA56] z-10 pointer-events-none"></div>
              <div className="absolute top-[8px] md:top-[11px] bottom-[8px] md:bottom-[11px] right-0 w-[2.5px] md:w-[3px] bg-[#92AA56] z-10 pointer-events-none"></div>

              <div className="absolute left-0 right-0 top-[8px] md:top-[11px] h-[2.5px] md:h-[3px] bg-[#92AA56] z-10 pointer-events-none"></div>
              <div className="absolute left-0 right-0 bottom-[8px] md:bottom-[11px] h-[2.5px] md:h-[3px] bg-[#92AA56] z-10 pointer-events-none"></div>

              {/* --- DARK GREEN LINES --- */}
              <div className="absolute left-[8px] md:left-[11px] right-[8px] md:right-[11px] top-0 h-[2.5px] md:h-[3px] bg-[#29421A] z-20 pointer-events-none"></div>
              <div className="absolute left-[8px] md:left-[11px] right-[8px] md:right-[11px] bottom-0 h-[2.5px] md:h-[3px] bg-[#29421A] z-20 pointer-events-none"></div>

              <div className="absolute top-0 bottom-0 left-[8px] md:left-[11px] w-[2.5px] md:w-[3px] bg-[#29421A] z-20 pointer-events-none"></div>
              <div className="absolute top-0 bottom-0 right-[8px] md:right-[11px] w-[2.5px] md:w-[3px] bg-[#29421A] z-20 pointer-events-none"></div>

              {/* --- LIGHT GREEN BOX --- */}
              <div className="absolute top-[16px] md:top-[22px] right-[16px] md:right-[22px] bottom-[16px] md:bottom-[22px] left-[16px] md:left-[22px] border-[2.5px] md:border-[3px] border-[#E4EFCA] z-30 pointer-events-none"></div>

              {/* Center Image */}
              <div className="relative z-40 bg-white">
                <img 
                  src="/images/gambardetaile/qr 1.svg" 
                  alt="QR Code Donasi Taman Zakat" 
                  className="w-full h-auto object-contain relative mx-auto shadow-sm"
                  style={{ aspectRatio: '729/1027' }}
                />
              </div>

            </div>

          </div>
          
        </div>

        {/* Decorative Horizontal Lines - right center */}
        <div className="absolute right-[5%] lg:right-[8%] top-[55%] w-[15%] lg:w-[20%] h-[2px] bg-[#eef6e1] z-0"></div>
        <div className="absolute right-[2%] lg:right-[5%] top-[58%] w-[10%] lg:w-[15%] h-[2px] bg-[#eef6e1] z-0"></div>
        
      </div>
    </div>
  );
}
