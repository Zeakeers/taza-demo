export default function IndonesiaMap() {
  return (
    <div className="flex items-center justify-center w-full">
      <div className="w-full max-w-4xl relative" style={{ aspectRatio: "792/316" }}>
        <object
          data="/maps/indonesia.svg?v=5"
          type="image/svg+xml"
          className="absolute inset-0 w-full h-full filter drop-shadow-lg"
          aria-label="Peta interaktif Indonesia"
        >
          Peta Indonesia tidak dapat dimuat.
        </object>
      </div>
    </div>
  );
}
