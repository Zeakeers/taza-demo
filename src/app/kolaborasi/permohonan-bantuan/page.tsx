"use client";

import React, { useState } from 'react';
import Image from 'next/image';

export default function PermohonanBantuanPage() {
  const [formData, setFormData] = useState({
    nama_pemohon: '',
    alamat_domisili: '',
    no_whatsapp: '',
    email: '',
    jenis_pemohon: '',
    sumber_info: '',
    referensi: '',
    pernah_mengajukan: '',
    waktu_terakhir_mengajukan: '',
    deskripsi: '',
    nominal: '',
  });

  const [file, setFile] = useState<File | null>(null);
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState<{ type: 'success' | 'error', text: string } | null>(null);
  const [showSuccessModal, setShowSuccessModal] = useState(false);

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    // Limit nominal input length to prevent SQL out of range errors
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
    setMessage(null);

    try {
      const data = new FormData();
      Object.entries(formData).forEach(([key, value]) => {
        data.append(key, value);
      });
      if (file) {
        data.append('foto_ktp', file);
      }

      const response = await fetch('http://localhost:8000/api/permohonan-bantuan', {
        method: 'POST',
        body: data,
        headers: {
          'Accept': 'application/json',
        }
      });

      if (response.ok) {
        setShowSuccessModal(true);
        setMessage(null);
        setFormData({
          nama_pemohon: '',
          alamat_domisili: '',
          no_whatsapp: '',
          email: '',
          jenis_pemohon: '',
          sumber_info: '',
          referensi: '',
          pernah_mengajukan: '',
          waktu_terakhir_mengajukan: '',
          deskripsi: '',
          nominal: '',
        });
        setFile(null);
        // Reset file input visually
        const fileInput = document.getElementById('foto_ktp') as HTMLInputElement;
        if (fileInput) fileInput.value = '';
      } else {
        const errData = await response.json();
        setMessage({ type: 'error', text: errData.message || 'Terjadi kesalahan saat mengirim data. Silakan periksa kembali form Anda.' });
      }
    } catch (error) {
      console.error('Error submitting form:', error);
      setMessage({ type: 'error', text: 'Terjadi kesalahan jaringan. Silakan coba beberapa saat lagi.' });
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="bg-[#EBF1D5] min-h-screen py-10 md:py-16 px-4 md:px-8 flex items-center justify-center relative overflow-hidden font-poppins">
      <div className="max-w-[600px] w-full z-10">
        {/* Card Container */}
        <div className="bg-white rounded-[32px] md:rounded-[40px] shadow-sm relative pt-12 pb-16 px-6 sm:px-10 md:px-12 mx-auto border border-white/50">
          
          {/* Logo & Title */}
          <div className="flex flex-col items-center mb-10">
             <div className="w-24 h-24 mb-4 relative flex items-center justify-center">
                <Image 
                  src="/images/icon/taman zakat  logo .svg" 
                  alt="Logo Taman Zakat" 
                  width={96} 
                  height={96} 
                  className="w-full h-full object-contain" 
                  priority
                />
             </div>
             <h1 className="text-[20px] sm:text-[22px] md:text-[26px] font-bold text-[#2d7d42] uppercase tracking-wide text-center">
               FORM PERMOHONAN BANTUAN
             </h1>
          </div>

          {message && message.type === 'error' && (
            <div className="mb-6 p-4 rounded-2xl text-center font-medium bg-red-50 text-red-600 border border-red-100">
              {message.text}
            </div>
          )}

          {/* Form */}
          <form onSubmit={handleSubmit} className="flex flex-col gap-5 md:gap-6 relative z-20">
            
            {/* Standard Text Inputs */}
            {[
              { label: 'Nama Pemohon', type: 'text', name: 'nama_pemohon', required: true },
              { label: 'Alamat Domisili', type: 'text', name: 'alamat_domisili', required: true },
              { label: 'No Whatsapp', type: 'text', name: 'no_whatsapp', required: true },
              { label: 'Email', type: 'email', name: 'email', required: false },
              { label: 'Jenis Pemohon', type: 'text', name: 'jenis_pemohon', required: false },
            ].map((field, idx) => (
              <div key={idx} className="flex flex-col">
                <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">{field.label} {field.required && <span className="text-red-500">*</span>}</label>
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

            {/* Radio Source Info */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2.5 ml-1 text-[14px] sm:text-[15px] font-medium leading-tight">
                Darimana Anda Mendapat Info Permohonan Bantuan Taman Zakat ini?
              </label>
              <div className="flex flex-wrap gap-3">
                {[
                  'Media Sosial',
                  'Website Taman Zakat',
                  'LAZ atau Lembaga Sosial Lain',
                  'Lainnya'
                ].map((opt, idx) => (
                  <label key={idx} className="flex items-center gap-2 bg-[#eff4fd] border border-[#d2def2] px-4 py-2.5 rounded-full cursor-pointer text-[13px] sm:text-sm text-zinc-700 hover:bg-[#e0eaf9] transition-colors">
                    <input 
                      type="radio" 
                      name="sumber_info" 
                      value={opt}
                      checked={formData.sumber_info === opt}
                      onChange={handleInputChange}
                      className="accent-[#5DA630] w-4 h-4" 
                    />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
            </div>

            {/* Textarea 1 */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium leading-snug">
                Jika Dapat Info dari referensi/rekomendasi, Tuliskan dengan Format: Nama Referensi/Rekomendasi_Jabatan_Instansi/Perusahaan
              </label>
              <textarea 
                  name="referensi"
                  value={formData.referensi}
                  onChange={handleInputChange}
                  rows={4}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* Radio Previous Request */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2.5 ml-1 text-[14px] sm:text-[15px] font-medium leading-tight">
                Apakah Sebelumnya Anda Pernah Mengajukan Permohonan ke Lembaga Amil Zakat (LAZ) atau Lembaga Sosial lain?
              </label>
              <div className="flex flex-wrap gap-3">
                {['Ya', 'Tidak'].map((opt, idx) => (
                  <label key={idx} className="flex items-center gap-2 bg-[#eff4fd] border border-[#d2def2] px-5 py-2.5 rounded-full cursor-pointer text-[13px] sm:text-sm text-zinc-700 hover:bg-[#e0eaf9] transition-colors">
                    <input 
                      type="radio" 
                      name="pernah_mengajukan" 
                      value={opt}
                      checked={formData.pernah_mengajukan === opt}
                      onChange={handleInputChange}
                      className="accent-[#5DA630] w-4 h-4" 
                    />
                    <span>{opt}</span>
                  </label>
                ))}
              </div>
            </div>

            {/* Textarea 2 */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium leading-snug">
                Jika Sebelumnya Pernah Mengajukan Bantuan di Lembaga Amil Zakat (LAZ) atau Lembaga Sosial Lain, Kira-Kira Kapan Terakhir Kali Anda mengajukan?
              </label>
              <textarea 
                  name="waktu_terakhir_mengajukan"
                  value={formData.waktu_terakhir_mengajukan}
                  onChange={handleInputChange}
                  rows={3}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* File Upload */}
            <div className="flex flex-col mt-1">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium">Upload Foto/Scan KTP Pemohon</label>
              <div className="flex items-center w-full">
                <input 
                  type="file" 
                  id="foto_ktp"
                  onChange={handleFileChange}
                  className="block w-full text-sm text-zinc-500
                  file:mr-4 file:py-2.5 file:px-4
                  file:rounded-sm file:border file:border-[#b4c4dd]
                  file:text-sm file:font-medium
                  file:bg-[#eff4fd] file:text-zinc-700
                  hover:file:bg-[#e0eaf9] file:transition-colors file:cursor-pointer
                  bg-transparent cursor-pointer" 
                  accept="image/*,.pdf"
                />
              </div>
            </div>

            {/* Textarea 3 */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-2 ml-1 text-[14px] sm:text-[15px] font-medium leading-snug">
                Deskripsi Permohonan (Apa Alasan Anda Mengajukan Bantuan di Taman Zakat)
              </label>
              <textarea 
                  name="deskripsi"
                  value={formData.deskripsi}
                  onChange={handleInputChange}
                  rows={4}
                  className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors resize-none"
              ></textarea>
            </div>

            {/* Nominal Input */}
            <div className="flex flex-col">
              <label className="text-zinc-600 mb-1.5 ml-1 text-[14px] sm:text-[15px] font-medium">Nominal Bantuan yang ingin diajukan</label>
              <input 
                type="number" 
                name="nominal"
                value={formData.nominal}
                onChange={handleInputChange}
                className="w-full bg-[#eff4fd] border border-[#d2def2] text-zinc-800 rounded-[18px] px-4 py-3 min-h-[50px] focus:outline-none focus:ring-2 focus:ring-[#5DA630]/30 focus:border-[#5DA630] transition-colors"
              />
            </div>

            {/* Submit Button */}
            <div className="mt-6 flex justify-center w-full">
              <button 
                type="submit" 
                disabled={loading}
                className={`w-full sm:w-auto min-w-[200px] text-white font-semibold py-3.5 px-12 rounded-full transition-colors text-lg shadow-md hover:shadow-lg active:scale-95 flex justify-center items-center gap-2 ${loading ? 'bg-gray-400 cursor-not-allowed' : 'bg-[#E12B5E] hover:bg-[#c72251]'}`}
              >
                {loading ? (
                  <>
                    <svg className="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                      <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengirim...
                  </>
                ) : 'Konfirmasi'}
              </button>
            </div>
            
          </form>

        </div>
      </div>

      {/* Success Modal */}
      {showSuccessModal && (
        <div className="fixed inset-0 z-[9999] flex items-center justify-center p-4">
          {/* Backdrop */}
          <div 
            className="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
            onClick={() => setShowSuccessModal(false)}
          ></div>
          
          {/* Modal Content */}
          <div className="bg-white rounded-[32px] p-8 md:p-10 w-full max-w-md relative z-10 shadow-2xl transform transition-all flex flex-col items-center text-center animate-in fade-in zoom-in-95 duration-300">
            <div className="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mb-6 shadow-inner">
              <svg className="w-10 h-10 text-[#5DA630]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            
            <h3 className="text-2xl font-bold text-zinc-800 mb-3">
              Berhasil Diajukan!
            </h3>
            
            <p className="text-zinc-500 text-[15px] leading-relaxed mb-8">
              Permohonan bantuan Anda berhasil terkirim. Silahkan menunggu info lebih lanjut dari kami. Tim Taman Zakat akan memproses dan menghubungi Anda.
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
