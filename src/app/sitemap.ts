import { MetadataRoute } from "next";

export default function sitemap(): MetadataRoute.Sitemap {
  const baseUrl = "https://tamanzakat.org";

  const mainPages = [
    "",
    "/about",
    "/layanan",
    "/kolaborasi",
    "/news",
    "/tata-kelola",
    "/program",
  ].map((route) => ({
    url: `${baseUrl}${route}`,
    lastModified: new Date(),
    changeFrequency: "weekly" as const,
    priority: route === "" ? 1 : 0.8,
  }));

  const subPages = [
    "/layanan/konfirmasi-donasi",
    "/layanan/qr-code-donasi",
    "/layanan/kantor-layanan",
    "/layanan/hitung-zakat",
    "/layanan/no-rekening",
    "/layanan/faq",
    "/kolaborasi/mitra",
    "/kolaborasi/permohonan-bantuan",
    "/kolaborasi/volunteer",
    "/program/dakwah",
    "/program/ekonomi",
    "/program/kemanusiaan",
    "/program/kesehatan",
    "/program/pendidikan",
  ].map((route) => ({
    url: `${baseUrl}${route}`,
    lastModified: new Date(),
    changeFrequency: "monthly" as const,
    priority: 0.6,
  }));

  return [...mainPages, ...subPages];
}
