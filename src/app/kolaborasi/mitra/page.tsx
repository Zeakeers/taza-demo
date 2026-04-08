import React from 'react';
import Image from 'next/image';

export default function MitraPage() {
  return (
    <div className="bg-white min-h-screen overflow-hidden relative">

      <div className="max-w-[1200px] mx-auto px-4 md:px-8 py-16 md:py-24">
        
        {/* Section 1: Stakeholder Support & Partners */}
        <div className="w-full flex flex-col md:flex-row justify-between mb-16 gap-8 relative items-start">
          

          <div className="w-full md:w-[40%] static md:sticky top-0 md:top-[300px] flex justify-center md:justify-start items-center mb-10 md:mb-0">
            <h1 className="text-3xl md:text-[40px] font-bold text-black leading-tight max-w-[423px] text-center md:text-left">
              Trusted by our<br />
              Stakeholder Support<br />
              & Partners
            </h1>
          </div>


          <div className="w-full md:w-[55%] flex justify-end">
            <Image
              src="/images/icon/trusted-partners.svg"
              alt="Trusted by our Stakeholder Support & Partners"
              width={775}
              height={1964}
              className="w-full max-w-[775px] h-auto object-contain"
              priority
            />
          </div>
        </div>

        {/* Separator 1 */}
        <div className="w-full flex justify-end mb-20 md:mr-[-2%]">
          <div className="w-full max-w-[800px] flex flex-col gap-[28px] md:gap-[36px] relative py-4">
            <div className="w-[80%] h-[2.5px] bg-[#d1d5db] ml-[20%] rounded-full"></div>
            <div className="w-[95%] h-[2.5px] bg-[#d1d5db] ml-[25%] rounded-full"></div>
            <div className="w-[105%] h-[2.5px] bg-[#d1d5db] ml-[-18%] rounded-full"></div>
          </div>
        </div>
        
        {/* Section 2: Media Partner */}
        <div className="relative w-full py-10 mb-20 flex flex-col-reverse md:flex-row justify-between items-center min-h-[400px] gap-8">
          

          <div className="absolute inset-0 z-0 flex items-center justify-center opacity-90 pointer-events-none overflow-hidden md:overflow-visible">

             <div className="relative w-full h-full max-w-[1200px]">

                <Image src="/images/icon/koran 1.svg" alt="" width={400} height={400} className="absolute right-[-25%] md:right-[-25%] top-[30%] md:top-[5%] object-contain object-right w-[200px] md:w-[450px] h-auto" />
                

                <Image src="/images/icon/koran 2.svg" alt="" width={700} height={400} className="absolute left-[5%] md:left-[15%] top-[30%] md:top-[5%] object-contain w-[300px] md:w-[750px] h-auto" />
                

                <Image src="/images/icon/koran 3.svg" alt="" width={150} height={150} className="absolute left-[-5%] md:left-[0%] bottom-[-5%] md:bottom-[-20%] object-contain w-[80px] md:w-[140px] h-auto" />
                

                <Image src="/images/icon/koran 4.svg" alt="" width={120} height={120} className="absolute right-[5%] md:right-[20%] bottom-[0%] md:bottom-[10%] object-contain w-[70px] md:w-[120px] h-auto" />
             </div>
          </div>


          <div className="relative z-10 w-full md:w-[60%] flex justify-start items-center">
            <Image
              src="/images/icon/Media Partner.svg"
              alt="Media Partner Logos"
              width={800}
              height={400}
              className="w-full h-auto object-contain object-center md:object-left"
            />
          </div>
          

          <div className="relative z-10 w-full md:w-[35%] flex justify-center md:justify-end items-center mt-4 md:mt-0 md:pr-8 mb-6 md:mb-0">
            <h2 className="text-3xl md:text-[40px] font-bold text-black text-center md:text-right">
              Media Partner
            </h2>
          </div>
        </div>

        {/* Separator 2 */}
        <div className="w-full flex justify-start mb-24 md:ml-[-2%]">
          <div className="w-full max-w-[800px] flex flex-col gap-[28px] md:gap-[36px] relative py-4">
            <div className="w-[80%] h-[2.5px] bg-[#d1d5db] mr-[20%] ml-auto rounded-full"></div>
            <div className="w-[95%] h-[2.5px] bg-[#d1d5db] mr-[25%] ml-auto rounded-full"></div>
            <div className="w-[105%] h-[2.5px] bg-[#d1d5db] mr-[-18%] ml-auto rounded-full"></div>
          </div>
        </div>

        {/* Section 3: Mitra Payment */}
        <div className="relative w-full pb-10 pt-10 px-4 md:px-0 z-10">
          

          <div className="flex flex-col md:flex-row items-center justify-between w-full md:gap-16 gap-10">
             

             <div className="w-full md:w-[35%] flex justify-center md:justify-start">
                <h2 className="text-3xl md:text-[40px] font-bold text-black text-center md:text-left">
                  Mitra Payment
                </h2>
             </div>
             

             <div className="grid grid-cols-3 gap-y-10 gap-x-6 md:gap-x-12 w-full md:w-[65%] place-items-center mb-10 md:mb-0">
               <Image src="/images/logo bank/bank-negara-indonesia-(bni)-logo 2.svg" alt="BNI" width={140} height={50} className="w-[80px] md:w-[130px] h-auto object-contain" />
               <Image src="/images/logo bank/bank-rakyat-indonesia-(bri)-logo 1.svg" alt="BRI" width={140} height={50} className="w-[80px] md:w-[130px] h-auto object-contain" />
               <Image src="/images/logo bank/bank-central-asia-(bca)-logo 1.svg" alt="BCA" width={110} height={50} className="w-[80px] md:w-[110px] h-auto object-contain" />
               
               <Image src="/images/logo bank/bank-bsi-logo 1.svg" alt="BSI" width={140} height={50} className="w-[80px] md:w-[140px] h-auto object-contain" />
               <Image src="/images/logo bank/bank mandiri.svg" alt="Mandiri" width={130} height={50} className="w-[80px] md:w-[130px] h-auto object-contain" />
               <Image src="/images/logo bank/bank-jatim-logo 1.svg" alt="Bank Jatim" width={120} height={50} className="w-[80px] md:w-[120px] h-auto object-contain" />
             </div>
          </div>
        </div>

      </div>


      <div className="absolute left-0 bottom-0 w-[100px] md:w-[120px] lg:w-[150px] z-20 pointer-events-none">
        <Image
          src="/images/icon/qris.svg"
          alt="QRIS"
          width={150}
          height={150}
          className="w-full h-auto object-contain object-bottom object-left"
        />
      </div>
      
      <div className="absolute right-0 bottom-0 w-[120px] md:w-[160px] lg:w-[200px] z-20 pointer-events-none">
        <Image
          src="/images/icon/atm.svg"
          alt="ATM"
          width={200}
          height={200}
          className="w-full h-auto object-contain object-bottom object-right"
        />
      </div>

    </div>
  );
}
