'use client'
import { useState } from 'react'

const WA_NUMBER = '628511990024'
const WA_MESSAGE = 'Halo Taman Zakat, saya ingin bertanya tentang program yang ada. 😊'
const WA_LINK = `https://wa.me/${WA_NUMBER}?text=${encodeURIComponent(WA_MESSAGE)}`

export default function WhatsAppFloat() {
  const [hovered, setHovered] = useState(false)

  return (
    <div className="fixed bottom-6 right-6 z-50 flex items-center justify-end gap-3">

      {/* tooltip label */}
      <div
        className={`
          bg-white text-zinc-700 text-sm font-medium px-4 py-2.5 rounded-2xl shadow-lg
          border border-zinc-100 whitespace-nowrap
          transition-all duration-300 ease-out
          ${hovered ? 'opacity-100 translate-x-0 pointer-events-auto' : 'opacity-0 translate-x-3 pointer-events-none'}
        `}
      >
        <span className="block text-xs text-zinc-400 font-normal mb-0.5">Butuh bantuan?</span>
        <span className="font-semibold text-[#25D366]">Chat CS Kami</span>
      </div>

      {/* main button */}
      <a
        href={WA_LINK}
        target="_blank"
        rel="noopener noreferrer"
        onMouseEnter={() => setHovered(true)}
        onMouseLeave={() => setHovered(false)}
        aria-label="Hubungi CS via WhatsApp"
        className="
          relative flex items-center justify-center
          w-14 h-14 rounded-full
          bg-[#25D366] hover:bg-[#1ebe5d]
          shadow-[0_4px_20px_rgba(37,211,102,0.45)]
          hover:shadow-[0_6px_28px_rgba(37,211,102,0.6)]
          transition-all duration-200 active:scale-95 hover:scale-105
          group
        "
      >
        {/* pulse ring — slow, subtle */}
        <span className="absolute inset-0 rounded-full bg-[#25D366] opacity-20 pointer-events-none animate-[ping_2.5s_ease-out_infinite]" />

        {/* WhatsApp SVG */}
        <svg
          viewBox="0 0 32 32"
          className="w-7 h-7 fill-white relative z-10"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path d="M16 2C8.268 2 2 8.268 2 16c0 2.442.644 4.733 1.77 6.72L2 30l7.495-1.742A13.94 13.94 0 0016 30c7.732 0 14-6.268 14-14S23.732 2 16 2zm0 25.5a11.44 11.44 0 01-5.83-1.594l-.418-.248-4.45 1.034 1.062-4.33-.272-.443A11.46 11.46 0 014.5 16C4.5 9.649 9.649 4.5 16 4.5S27.5 9.649 27.5 16 22.351 27.5 16 27.5zm6.29-8.61c-.345-.172-2.04-1.006-2.356-1.12-.317-.113-.547-.172-.777.172-.23.345-.892 1.12-1.093 1.35-.2.23-.402.258-.747.086-.345-.172-1.456-.537-2.773-1.712-1.025-.913-1.717-2.04-1.918-2.385-.2-.345-.021-.531.15-.703.155-.154.345-.402.517-.603.172-.2.23-.345.345-.575.115-.23.057-.431-.028-.603-.086-.172-.777-1.873-1.065-2.564-.28-.673-.565-.582-.777-.593l-.662-.011c-.23 0-.603.086-.919.431-.316.345-1.207 1.179-1.207 2.876 0 1.697 1.236 3.337 1.408 3.567.172.23 2.432 3.713 5.893 5.206.824.356 1.467.569 1.969.728.827.264 1.58.226 2.175.137.663-.1 2.04-.833 2.328-1.638.287-.805.287-1.495.2-1.638-.086-.143-.316-.23-.661-.402z"/>
        </svg>
      </a>
    </div>
  )
}
