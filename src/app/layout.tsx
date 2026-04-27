import type { Metadata } from "next";
import { Poppins } from "next/font/google";
import localFont from "next/font/local";

import Navbar from "@/components/layout/Navbar";
import Footer from "@/components/layout/footer";
import WhatsAppFloat from "@/components/ui/whatsapp-float";
import "./styles/globals.css";

const poppins = Poppins({
  subsets: ["latin"],
  weight: ["300", "400", "500", "600", "700", "800", "900"],
  variable: "--font-poppins",
  display: "swap",
});

const awalRamadhan = localFont({
  src: "../../public/font/a_awal_ramadhan/aAwalRamadhan.ttf",
  variable: "--font-ramadhan-local",
  display: "swap",
});

export const metadata: Metadata = {
  title: {
    default: "Taman Zakat Indonesia | Lembaga Amil Zakat Terpercaya",
    template: "%s | Taman Zakat Indonesia",
  },
  description:
    "Taman Zakat Indonesia adalah Lembaga Amil Zakat (LAZ) terpercaya untuk menyalurkan donasi, zakat, infak, dan sedekah Anda. Mari berbagi kebaikan untuk masyarakat yang membutuhkan.",
  keywords: [
    "donasi zakat",
    "bayar zakat online",
    "sedekah online",
    "lembaga amil zakat",
    "infak",
    "wakaf",
    "taman zakat indonesia",
    "zakat mal",
    "zakat fitrah",
    "donasi kemanusiaan",
  ],
  authors: [{ name: "Taman Zakat Indonesia" }],
  creator: "Taman Zakat Indonesia",
  publisher: "Taman Zakat Indonesia",
  formatDetection: {
    email: false,
    address: false,
    telephone: false,
  },
  icons: {
    icon: "/images/icon/taman zakat  logo .svg",
    apple: "/images/icon/taman zakat  logo .svg",
  },
  openGraph: {
    type: "website",
    locale: "id_ID",
    url: "https://tamanzakat.org",
    siteName: "Taman Zakat Indonesia",
    title: "Taman Zakat Indonesia | Berbagi Kebaikan Lewat Zakat & Donasi",
    description:
      " 플랫폼 untuk menyalurkan zakat, infak, dan sedekah secara aman dan transparan bersama Taman Zakat Indonesia.",
    images: [
      {
        url: "/images/og-image.jpg", // Pastikan file ini ada atau buat nanti
        width: 1200,
        height: 630,
        alt: "Taman Zakat Indonesia",
      },
    ],
  },
  twitter: {
    card: "summary_large_image",
    title: "Taman Zakat Indonesia",
    description: "Lembaga Amil Zakat terpercaya untuk berbagi kebaikan.",
    images: ["/images/og-image.jpg"],
  },
  robots: {
    index: true,
    follow: true,
    googleBot: {
      index: true,
      follow: true,
      "max-video-preview": -1,
      "max-image-preview": "large",
      "max-snippet": -1,
    },
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id">
      <body className={`${poppins.className} ${poppins.variable} ${awalRamadhan.variable} antialiased bg-white text-zinc-900`}>
        <Navbar />

        <main className="min-h-screen">{children}</main>

        <Footer />
        <WhatsAppFloat />
      </body>
    </html>
  );
}
