import React from 'react';
import { Phone, Mail, MessageCircle } from 'lucide-react';
import { getPageContent } from '@/lib/api';

export const metadata = {
  title: 'Kantor Layanan - Taman Zakat Indonesia',
  description: 'Informasi lokasi dan kontak kantor layanan Taman Zakat Indonesia.',
};

interface Office {
  name: string;
  address: string;
  phone: string;
  email: string;
  whatsapp: string;
  map_embed: string;
}

const defaultOffices: Office[] = [
  {
    name: 'Kantor Pusat',
    address: 'Jl. Wisma Trosobo IV No 33, Kec. Taman, Kab. Sidoarjo – Jawa Timur',
    phone: '031 - 99 787 999',
    email: 'mail@tamanzakat.org',
    whatsapp: '082230099009',
    map_embed: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d369.32459085071827!2d112.64360415494198!3d-7.373014410096162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e34e63a9d993%3A0xf355095502d2e683!2sTaman%20Zakat%20Pusat!5e0!3m2!1sid!2sid!4v1774665427828!5m2!1sid!2sid',
  },
  {
    name: 'Kantor Cabang Sidoarjo',
    address: 'Taman Zakat Kantor Cabang Sidoarjo, Kec. Taman, Kab. Sidoarjo – Jawa Timur',
    phone: '031 - 99 787 999',
    email: 'mail@tamanzakat.org',
    whatsapp: '082230099009',
    map_embed: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.7908134902405!2d112.6617935!3d-7.377326599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e3006092e95b%3A0xb794ac1846fd4a7b!2sTaman%20Zakat%20Kantor%20Cabang%20Sidoarjo!5e0!3m2!1sid!2sid!4v1776226256516!5m2!1sid!2sid',
  },
  {
    name: 'Kantor Cabang Surabaya',
    address: 'Graha Tanmiyatul Iman Lt. 3 Jl. Ahmad Yani No.153, Gayungan, Wonocolo, Surabaya, Jawa Timur 60235',
    phone: '031 - 99 787 999',
    email: 'mail@tamanzakat.org',
    whatsapp: '082230099009',
    map_embed: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2170121953236!2d112.72919137584181!3d-7.3295067720868845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb4238d41a77%3A0xd47fd941882891f9!2sGraha%20Tanmiyatul%20Iman!5e0!3m2!1sid!2sid!4v1774665568300!5m2!1sid!2sid',
  },
  {
    name: 'Kantor Cabang Probolinggo',
    address: 'Komplek Masjid Asshobirin Bengawan Solo Residence C9 Jalan Bengawan Solo Kademangan Kota Probolinggo Jawa Timur',
    phone: '031 - 99 787 999',
    email: 'mail@tamanzakat.org',
    whatsapp: '082230099009',
    map_embed: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1165554745885!2d113.19299687584727!3d-7.777464277163349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ad6947e2d727%3A0x1a6914f11e8b5a5f!2sThe%20Bengawan%20Solo%20Residence!5e0!3m2!1sid!2sid!4v1774665646186!5m2!1sid!2sid',
  },
];

export default async function KantorLayananPage() {
  const pageData = await getPageContent('layanan');
  const data = pageData?.kantor;

  const title = data?.header?.title || 'Kantor Layanan';
  const description = data?.header?.description || 'Bagi anda yang ingin berkonsultasi mengenai Program Taman Zakat dan lainnya, Anda bisa menghubungi kami:';
  const offices: Office[] = data?.offices?.length > 0 ? data.offices : defaultOffices;

  return (
    <div className="min-h-screen bg-white font-poppins">
      <div className="pt-20 md:pt-32 pb-16 px-4 md:px-8 lg:px-16 max-w-7xl mx-auto">
        <div className="text-center mb-16">
          <h1 className="text-3xl md:text-4xl font-bold text-zinc-900 mb-6">{title}</h1>
          <p className="text-zinc-700 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            {description}
          </p>
        </div>

        {/* Content Wrapper with left line */}
        <div className="relative pl-6 md:pl-16">
          {/* Vertical left line */}
          <div className="absolute left-0 top-0 bottom-0 w-[2px] bg-black rounded-lg"></div>

          {offices.map((office, idx) => {
            const isEven = idx % 2 === 0;
            return (
              <div key={idx} className="border-t-[1.5px] border-black pt-16 pb-16">
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
                  {/* Text Block */}
                  <div className={`flex flex-col ${isEven ? 'text-right lg:order-1' : 'text-left lg:order-2'} order-2 space-y-6`}>
                    <div className={`flex items-center ${isEven ? 'justify-end' : 'justify-start'} gap-3`}>
                      {isEven && (
                        <span className="text-red-500">
                          <svg viewBox="0 0 24 24" fill="currentColor" className="w-8 h-8">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                          </svg>
                        </span>
                      )}
                      <h2 className="text-2xl font-bold text-zinc-900">{office.name}</h2>
                      {!isEven && (
                        <span className="text-red-500">
                          <svg viewBox="0 0 24 24" fill="currentColor" className="w-8 h-8">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                          </svg>
                        </span>
                      )}
                    </div>
                    <p className={`text-zinc-800 text-base md:text-lg leading-relaxed ${!isEven ? 'max-w-md' : ''}`}>
                      {office.address}
                    </p>
                    <div className="flex flex-col space-y-3 font-medium text-zinc-800">
                      <div className={`flex items-center ${isEven ? 'justify-end' : 'justify-start'} gap-3 text-sm md:text-base`}>
                        {isEven && <span>{office.phone}</span>}
                        <Phone className="w-5 h-5 text-green-600" />
                        {!isEven && <span>{office.phone}</span>}
                      </div>
                      <div className={`flex items-center ${isEven ? 'justify-end' : 'justify-start'} gap-3 text-sm md:text-base`}>
                        {isEven && <span>{office.email}</span>}
                        <Mail className="w-5 h-5 text-green-600" />
                        {!isEven && <span>{office.email}</span>}
                      </div>
                      <div className={`flex items-center ${isEven ? 'justify-end' : 'justify-start'} gap-3 text-sm md:text-base`}>
                        {isEven && <span>{office.whatsapp}</span>}
                        <MessageCircle className="w-5 h-5 text-green-600" />
                        {!isEven && <span>{office.whatsapp}</span>}
                      </div>
                    </div>
                  </div>

                  {/* Map Block */}
                  <div className={`${isEven ? 'lg:order-2' : 'lg:order-1'} order-1 w-full bg-black aspect-[4/3] md:aspect-video lg:aspect-auto lg:h-80 rounded-md overflow-hidden relative flex items-center justify-center`}>
                    <span className="text-white text-3xl font-bold absolute pointer-events-none">MAP</span>
                    {office.map_embed && (
                      <iframe
                        src={office.map_embed}
                        width="600"
                        height="450"
                        style={{ border: 0 }}
                        allowFullScreen
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                        className="absolute inset-0 w-full h-full"
                      />
                    )}
                  </div>
                </div>
              </div>
            );
          })}

        </div>
      </div>
    </div>
  );
}
