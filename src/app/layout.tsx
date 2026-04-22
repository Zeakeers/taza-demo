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
      <body className={`${poppins.className} ${poppins.variable} ${awalRamadhan.variable} antialiased bg-white text-zinc-900`}>
        <Navbar />

        <main className="min-h-screen">{children}</main>

        <Footer />
        <WhatsAppFloat />
      </body>
    </html>
  );
}
