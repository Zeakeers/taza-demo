"use client";

import React, { useState } from 'react';
import Image from 'next/image';

export default function KonfirmasiDonasiPage() {
  const [formData, setFormData] = useState({
    nama_lengkap: '',
    no_whatsapp: '',
    tanggal_transfer: '',
    program: '',
    nominal: '',
  });

  const [file, setFile] = useState<File | null>(null);
  const [loading, setLoading] = useState(false);
  const [showSuccessModal, setShowSuccessModal] = useState(false);
  const [errorMsg, setErrorMsg] = useState<string | null>(null);

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    if (name === 'nominal' && value.length > 13) return;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files.length > 0) {
      setFile(e.target.files[0]);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setErrorMsg(null);

    try {
      const data = new FormData();
      Object.entries(formData).forEach(([key, value]) => {
        data.append(key, value);
      });
      if (file) {
        data.append('bukti_pembayaran', file);
      } else {
        setErrorMsg('Bukti pembayaran wajib diunggah.');
        setLoading(false);
        return;
      }

      const apiUrl = `${typeof window === "undefined" ? "http://127.0.0.1:8000/api" : "/api"}`;
      const response = await fetch(`${apiUrl}/konfirmasi-donasi`, {
        method: 'POST',
        body: data,
        headers: {
          'Accept': 'application/json',
        }
      });

      if (response.ok) {
        setShowSuccessModal(true);
        setFormData({
          nama_lengkap: '',
          no_whatsapp: '',
          tanggal_transfer: '',
          program: '',
          nominal: '',
        });
        setFile(null);
        const fileInput = document.getElementById('bukti_pembayaran') as HTMLInputElement;
        if (fileInput) fileInput.value = '';
      } else {
        const errData = await response.json();
        setErrorMsg(errData.message || 'Terjadi kesalahan saat mengirim data.');
      }
    } catch (error) {
      console.error('Error:', error);
      setErrorMsg('Terjadi kesalahan jaringan.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="bg-[#f0f5da] min-h-screen py-16 px-4 md:px-8 flex items-center font-poppins justify-center relative overflow-hidden">
      <div className="max-w-lg w-full z-10">
        {/* Card Container */}
        <div className="bg-white rounded-[32px] md:rounded-[40px] shadow-sm relative pt-12 pb-20 px-6 sm:px-12 md:px-14 mx-auto border border-white/50">

          {/* Logo & Title */}
          <div className="flex flex-col items-center mb-8">
            <div className="w-24 h-24 mb-4 relative flex items-center justify-center">
              {/* Fallback to Taza Logo if specific hexagon is not found */}
              <Image
                src="/images/icon/taman zakat  logo .svg"
                alt="Logo Taman Zakat"
                width={96}
                height={96}
                className="w-full h-full object-contain"
                priority
              />
            </div>
            <h1 className="text-[22px] md:text-[26px] font-bold text-[#2d7d42] uppercase tracking-wide text-center">
              Konfirmasi Donasi
            </h1>
          </div>

          {errorMsg && (
            <div className="mb-6 p-4 rounded-2xl text-center font-medium bg-red-50 text-red-600 border border-red-100">
              {errorMsg}
            </div>
          )}

          {/* Form */}
          <form onSubmit={handleSubmit} className="flex flex-col gap-4 md:gap-5 relative z-20">
            {[
              { label: 'Nama Lengkap', type: 'text', name: 'nama_lengkap', required: true },
              { label: 'No WhatsApp', type: 'text', name: 'no_whatsapp', required: true },
              { label: 'Tanggal Transfer', type: 'date', name: 'tanggal_transfer', required: true },
              { label: 'Program', type: 'text', name: 'program', required: true },
              { label: 'Nominal', type: 'number', name: 'nominal', required: true }
            ].map((field, idx) => (
              <div key={idx} className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[15px] font-medium">
                  {field.label} {field.required && <span className="text-red-500">*</span>}
                </label>
                <input
                  type={field.type}
                  name={field.name}
                  value={formData[field.name as keyof typeof formData]}
                  onChange={handleInputChange}
                  required={field.required}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
                />
              </div>
            ))}

            <div className="flex flex-col mt-1">
              <label className="text-zinc-600 mb-2 ml-1 text-[15px] font-medium">
                Bukti Pembayaran <span className="text-red-500">*</span>
              </label>
              <div className="flex items-center">
                <input type="file"
                  id="bukti_pembayaran"
                  onChange={handleFileChange}
                  required
                  className="block w-full text-sm text-zinc-500
                  file:mr-4 file:py-2 file:px-4
                  file:rounded-sm file:border file:border-[#b4c4dd]
                  file:text-sm file:font-medium
                  file:bg-[#eff4fd] file:text-zinc-700
                  hover:file:bg-[#e0eaf9] file:transition-colors file:cursor-pointer
                  bg-transparent cursor-pointer"
                  accept="image/*,.pdf"
                />
              </div>
            </div>

            <div className="mt-8 flex justify-center">
              <button
                type="submit"
                disabled={loading}
                className={`flex items-center justify-center gap-2 text-white font-semibold py-3.5 px-12 rounded-full transition-colors text-lg shadow-md hover:shadow-lg active:scale-95 w-full md:w-auto min-w-[200px] ${loading ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#ad1a1e] hover:bg-[#911317]'}`}
              >
                {loading ? (
                  <>
                    <svg className="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                      <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengirim...
                  </>
                ) : 'Konfirmasi'}
              </button>
            </div>
          </form>

          {/* Cap Lunas Stamp */}
          <div className="absolute -bottom-6 -right-6 md:-bottom-12 md:-right-12 z-30 w-40 h-40 md:w-52 md:h-52 transform -rotate-12 select-none pointer-events-none opacity-90 drop-shadow-sm">
            <Image
              src="/images/icon/cap lunas.svg"
              alt="Lunas Stamp"
              fill
              className="object-contain"
            />
          </div>
        </div>
      </div>

      {/* Success Modal */}
      {showSuccessModal && (
        <div className="fixed inset-0 z-[9999] flex items-center justify-center p-4">
          <div 
            className="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
            onClick={() => setShowSuccessModal(false)}
          ></div>
          
          <div className="bg-white rounded-[32px] p-8 md:p-10 w-full max-w-md relative z-10 shadow-2xl transform transition-all flex flex-col items-center text-center animate-in fade-in zoom-in-95 duration-300 border-2 border-[#5DA630]/20">
            <div className="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6 shadow-inner relative">
              <svg className="w-10 h-10 text-[#5DA630]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            
            <h3 className="text-2xl font-bold text-zinc-800 mb-3">
              Alhamdulillah!
            </h3>
            
            <p className="text-zinc-500 text-[15px] leading-relaxed mb-8">
              Konfirmasi donasi Anda berhasil terkirim. Semoga Allah memberikan balasan terbaik atas amal kebaikan Anda. Tim kami akan segera memprosesnya.
            </p>
            
            <button 
              onClick={() => {
                setShowSuccessModal(false);
                window.scrollTo({ top: 0, behavior: 'smooth' });
              }}
              className="w-full bg-[#5DA630] hover:bg-[#4d8f28] text-white font-semibold py-3.5 px-6 rounded-full transition-all duration-300 shadow-md hover:shadow-lg active:scale-95 text-lg"
            >
              Tutup & Kembali
            </button>
          </div>
        </div>
      )}
    </div>
  )
}
