import type { Metadata } from "next";
import { Newsreader, Noto_Sans } from "next/font/google";
import localFont from "next/font/local";

import Navbar from "@/components/layout/Navbar";
import Footer from "@/components/layout/footer";
import "./globals.css";

const notoSans = Noto_Sans({
  subsets: ["latin"],
  weight: ["400", "500", "600", "700"],
  display: "swap",
});

const newsreader = Newsreader({
  subsets: ["latin"],
  weight: ["400", "500", "600", "700"],
  variable: "--font-newsreader-google",
  display: "swap",
});

const awalRamadhan = localFont({
  src: "../../public/font/a_awal_ramadhan/aAwalRamadhan.ttf",
  variable: "--font-ramadhan-local",
  display: "swap",
});

export const metadata: Metadata = {
  title: "Taman Zakat Indonesia",
  description: "Website resmi Taman Zakat Indonesia sebagai media informasi dan penyaluran donasi.",
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="id">
      <body className={`${notoSans.className} ${newsreader.variable} ${awalRamadhan.variable} antialiased bg-white text-zinc-900`}>
        <Navbar />

        <main className="min-h-screen">{children}</main>

        <Footer />
      </body>
    </html>
  );
}
