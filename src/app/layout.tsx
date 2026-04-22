import type { Metadata } from "next";
<<<<<<< HEAD
import { Newsreader, Noto_Sans, Poppins } from "next/font/google";
=======
import { Poppins } from "next/font/google";
>>>>>>> adi
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

const poppins = Poppins({
  subsets: ["latin"],
  weight: ["400", "500", "600", "700", "800", "900"],
  variable: "--font-poppins-google",
  display: "swap",
});

const awalRamadhan = localFont({
  src: "../../public/font/a_awal_ramadhan/aAwalRamadhan.ttf",
  variable: "--font-ramadhan-local",
  display: "swap",
});

export const metadata: Metadata = {
  title: "Taman Zakat Indonesia",
  description:
    "Website resmi Taman Zakat Indonesia sebagai media informasi dan penyaluran donasi.",
  icons: {
    icon: "/images/icon/taman zakat  logo .svg",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id">
<<<<<<< HEAD
      <body
        className={`${notoSans.className} ${newsreader.variable} ${poppins.variable} ${awalRamadhan.variable} antialiased bg-white text-zinc-900`}
      >
=======
      <body className={`${poppins.className} ${poppins.variable} ${awalRamadhan.variable} antialiased bg-white text-zinc-900`}>
>>>>>>> adi
        <Navbar />

        <main className="min-h-screen">{children}</main>

        <Footer />
        <WhatsAppFloat />
      </body>
    </html>
  );
}
