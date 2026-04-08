import React from 'react';
import Link from 'next/link';
import { MapPin, Phone, Mail, MessageCircle } from 'lucide-react';

export const metadata = {
  title: 'Kantor Layanan - Taman Zakat Indonesia',
  description: 'Informasi lokasi dan kontak kantor layanan Taman Zakat Indonesia.',
};

export default function KantorLayananPage() {
  return (
    <div className="min-h-screen bg-[#EAF1B1]">
      {/* Header Space filler if needed, but navbar is sticky top-0 */}
      <div className="pt-20 md:pt-32 pb-16 px-4 md:px-8 lg:px-16 max-w-7xl mx-auto">
        <div className="text-center mb-16">
          <h1 className="text-3xl md:text-4xl font-bold text-zinc-900 mb-6">Kantor Layanan</h1>
          <p className="text-zinc-700 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            Bagi anda yang ingin berkonsultasi mengenai Program Taman Zakat dan lainnya, Anda bisa menghubungi kami:
          </p>
        </div>

        {/* Content Wrapper with left line */}
        <div className="relative pl-6 md:pl-16">
          {/* Vertical left line */}
          <div className="absolute left-0 top-0 bottom-0 w-[2px] bg-black rounded-lg"></div>

          {/* Sidoarjo Section */}
          <div className="border-t-[1.5px] border-black pt-16 pb-16">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
              {/* Text Block - Right Aligned on Desktop */}
              <div className="flex flex-col text-right lg:order-1 order-2 space-y-6">
                <div className="flex items-center justify-end gap-3">
                  <span className="text-red-500">
                    <svg viewBox="0 0 24 24" fill="currentColor" className="w-8 h-8">
                       <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                  </span>
                  <h2 className="text-2xl font-bold text-zinc-900">Sidoarjo</h2>
                </div>
                <p className="text-zinc-800 text-base md:text-lg leading-relaxed">
                  Jl. Wisma Trosobo IV No 33, Kec. Taman, Kab.<br />
                  Sidoarjo – Jawa Timur
                </p>
                <div className="flex flex-col space-y-3 font-medium text-zinc-800">
                  <div className="flex items-center justify-end gap-3 text-sm md:text-base">
                    <span>031 - 99 787 999</span>
                    <Phone className="w-5 h-5 text-green-600" />
                  </div>
                  <div className="flex items-center justify-end gap-3 text-sm md:text-base">
                    <span>mail@tamanzakat.org</span>
                    <Mail className="w-5 h-5 text-green-600" />
                  </div>
                  <div className="flex items-center justify-end gap-3 text-sm md:text-base">
                    <span>082230099009</span>
                    <MessageCircle className="w-5 h-5 text-green-600" />
                  </div>
                </div>
              </div>
              
              {/* Map Block */}
              <div className="lg:order-2 order-1 w-full bg-black aspect-[4/3] md:aspect-video lg:aspect-auto lg:h-80 rounded-md overflow-hidden relative flex items-center justify-center">
                 <span className="text-white text-3xl font-bold absolute pointer-events-none">MAP</span>
                 <iframe 
                   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d369.32459085071827!2d112.64360415494198!3d-7.373014410096162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e34e63a9d993%3A0xf355095502d2e683!2sTaman%20Zakat%20Pusat!5e0!3m2!1sid!2sid!4v1774665427828!5m2!1sid!2sid" 
                   width="600"
                   height="450"
                   style={{ border: 0 }}
                   allowFullScreen
                   loading="lazy" 
                   referrerPolicy="no-referrer-when-downgrade"
                   className="absolute inset-0 w-full h-full"
                 />
              </div>
            </div>
          </div>

          {/* Surabaya Section */}
          <div className="border-t-[1.5px] border-black pt-16 pb-16">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
              {/* Map Block */}
              <div className="lg:order-1 order-1 w-full bg-black aspect-[4/3] md:aspect-video lg:aspect-auto lg:h-80 rounded-md overflow-hidden relative flex items-center justify-center">
                 <span className="text-white text-3xl font-bold absolute pointer-events-none">MAP</span>
                 <iframe 
                   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2170121953236!2d112.72919137584181!3d-7.3295067720868845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb4238d41a77%3A0xd47fd941882891f9!2sGraha%20Tanmiyatul%20Iman!5e0!3m2!1sid!2sid!4v1774665568300!5m2!1sid!2sid" 
                   width="600"
                   height="450"
                   style={{ border: 0 }}
                   allowFullScreen
                   loading="lazy" 
                   referrerPolicy="no-referrer-when-downgrade"
                   className="absolute inset-0 w-full h-full"
                 />
              </div>

              {/* Text Block - Left Aligned */}
              <div className="flex flex-col text-left lg:order-2 order-2 space-y-6">
                <div className="flex items-center justify-start gap-3">
                  <h2 className="text-2xl font-bold text-zinc-900">Surabaya</h2>
                  <span className="text-red-500">
                    <svg viewBox="0 0 24 24" fill="currentColor" className="w-8 h-8">
                       <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                  </span>
                </div>
                <p className="text-zinc-800 text-base md:text-lg leading-relaxed max-w-md">
                  Graha Tanmiyatul Iman Lt. 3 Jl. Ahmad Yani No.153,
                  Gayungan, Wonocolo, Surabaya, Jawa Timur 60235
                </p>
                <div className="flex flex-col space-y-3 font-medium text-zinc-800">
                  <div className="flex items-center justify-start gap-3 text-sm md:text-base">
                    <Phone className="w-5 h-5 text-green-600" />
                    <span>031 - 99 787 999</span>
                  </div>
                  <div className="flex items-center justify-start gap-3 text-sm md:text-base">
                    <Mail className="w-5 h-5 text-green-600" />
                    <span>mail@tamanzakat.org</span>
                  </div>
                  <div className="flex items-center justify-start gap-3 text-sm md:text-base">
                    <MessageCircle className="w-5 h-5 text-green-600" />
                    <span>082230099009</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Probolinggo Section */}
          <div className="border-t-[1.5px] border-black pt-16 pb-16">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
              {/* Text Block - Right Aligned on Desktop */}
              <div className="flex flex-col text-right lg:order-1 order-2 space-y-6">
                <div className="flex items-center justify-end gap-3">
                  <span className="text-red-500">
                    <svg viewBox="0 0 24 24" fill="currentColor" className="w-8 h-8">
                       <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                  </span>
                  <h2 className="text-2xl font-bold text-zinc-900">Probolinggo</h2>
                </div>
                <p className="text-zinc-800 text-base md:text-lg leading-relaxed">
                  Komplek Masjid Asshobirin Bengawan Solo<br/>
                  Residence C9 Jalan Bengawan Solo Kademangan<br/>
                  Kota Probolinggo Jawa Timur
                </p>
                <div className="flex flex-col space-y-3 font-medium text-zinc-800">
                  <div className="flex items-center justify-end gap-3 text-sm md:text-base">
                    <span>031 - 99 787 999</span>
                    <Phone className="w-5 h-5 text-green-600" />
                  </div>
                  <div className="flex items-center justify-end gap-3 text-sm md:text-base">
                    <span>mail@tamanzakat.org</span>
                    <Mail className="w-5 h-5 text-green-600" />
                  </div>
                  <div className="flex items-center justify-end gap-3 text-sm md:text-base">
                    <span>082230099009</span>
                    <MessageCircle className="w-5 h-5 text-green-600" />
                  </div>
                </div>
              </div>
              
              {/* Map Block */}
              <div className="lg:order-2 order-1 w-full bg-black aspect-[4/3] md:aspect-video lg:aspect-auto lg:h-80 rounded-md overflow-hidden relative flex items-center justify-center">
                 <span className="text-white text-3xl font-bold absolute pointer-events-none">MAP</span>
                 <iframe 
                   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1165554745885!2d113.19299687584727!3d-7.777464277163349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ad6947e2d727%3A0x1a6914f11e8b5a5f!2sThe%20Bengawan%20Solo%20Residence!5e0!3m2!1sid!2sid!4v1774665646186!5m2!1sid!2sid" 
                   width="600"
                   height="450"
                   style={{ border: 0 }}
                   allowFullScreen
                   loading="lazy" 
                   referrerPolicy="no-referrer-when-downgrade"
                   className="absolute inset-0 w-full h-full"
                 />
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
}
