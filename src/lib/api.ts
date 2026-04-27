export const API_URL = process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000/api";

export async function getPageContent(page: string) {
  try {
    const res = await fetch(`${API_URL}/content/${page}`, {
      next: { revalidate: 0 }, // Data selalu fresh
    });

    if (!res.ok) {
      throw new Error(`Failed to fetch content for ${page}`);
    }

    return await res.json();
  } catch (error) {
    console.error("API Error:", error);
    return null;
  }
}
