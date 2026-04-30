export interface ProvinceImage {
  url: string;
  title?: string;
  description?: string;
}

export interface ProvinceData {
  id: string;
  name: string;
  beneficiaries: string;
  funds: string;
  images: (string | ProvinceImage)[];
  quote?: string;
}

export const provinceData: Record<string, ProvinceData> = {
  "ID-AC": {
    id: "ID-AC",
    name: "Aceh",
    beneficiaries: "12,450",
    funds: "Rp 1.2M",
    images: ["/images/campaign/1.jpg", "/images/campaign/2.jpg", "/images/campaign/3.jpg", "/images/campaign/4.jpg"]
  },
  "ID-SU": {
    id: "ID-SU",
    name: "Sumatera Utara",
    beneficiaries: "18,200",
    funds: "Rp 1.8M",
    images: ["/images/campaign/5.jpg", "/images/campaign/6.jpg", "/images/campaign/7.jpg"]
  },
  "ID-SB": {
    id: "ID-SB",
    name: "Sumatera Barat",
    beneficiaries: "9,800",
    funds: "Rp 950JT",
    images: ["/images/campaign/1.jpg", "/images/campaign/4.jpg", "/images/campaign/7.jpg"]
  },
  "ID-JK": {
    id: "ID-JK",
    name: "DKI Jakarta",
    beneficiaries: "45,000",
    funds: "Rp 4.5M",
    images: ["/images/campaign/2.jpg", "/images/campaign/3.jpg", "/images/campaign/5.jpg", "/images/campaign/6.jpg"]
  },
  "ID-JB": {
    id: "ID-JB",
    name: "Jawa Barat",
    beneficiaries: "32,100",
    funds: "Rp 3.1M",
    images: ["/images/campaign/1.jpg", "/images/campaign/3.jpg", "/images/campaign/6.jpg"]
  },
  "ID-JT": {
    id: "ID-JT",
    name: "Jawa Tengah",
    beneficiaries: "28,400",
    funds: "Rp 2.7M",
    images: ["/images/campaign/4.jpg", "/images/campaign/2.jpg", "/images/campaign/7.jpg"]
  },
  "ID-JI": {
    id: "ID-JI",
    name: "Jawa Timur",
    beneficiaries: "38,900",
    funds: "Rp 3.8M",
    images: ["/images/campaign/1.jpg", "/images/campaign/5.jpg", "/images/campaign/3.jpg", "/images/campaign/6.jpg"]
  },
  "ID-BA": {
    id: "ID-BA",
    name: "Bali",
    beneficiaries: "7,500",
    funds: "Rp 800JT",
    images: ["/images/campaign/6.jpg", "/images/campaign/7.jpg"]
  },
  "ID-SS": {
    id: "ID-SS",
    name: "Sumatera Selatan",
    beneficiaries: "11,200",
    funds: "Rp 1.1M",
    images: ["/images/campaign/2.jpg", "/images/campaign/4.jpg"]
  }
};

// Default data for provinces not explicitly defined
export const getDefaultData = (id: string, name: string): ProvinceData => ({
  id,
  name,
  beneficiaries: "2,500+",
  funds: "Rp 250JT+",
  images: ["/images/campaign/1.jpg", "/images/campaign/3.jpg", "/images/campaign/5.jpg"]
});
