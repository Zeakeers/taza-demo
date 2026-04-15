export default function RightBarAudit() {
  return (
    <div className="mx-auto md:ml-auto md:mr-0 py-3 md:py-12 px-6 mt-2 md:mt-10 md:border md:border-green-200 text-black md:rounded-md flex flex-col items-center text-sm h-fit shrink-0 w-full max-w-65">
      <a href="/tata-kelola#hasil-audit" className="w-full ">
        <div className="rounded-full font-semibold border border-zinc-200 p-2 text-center hover:bg-green-50 transition-colors">
          Audit Keuangan
        </div>
      </a>
      <a href="/tata-kelola/audit-syariah" className="w-full">
        <div className="mt-4 rounded-full font-semibold border border-zinc-200 p-2 text-center hover:bg-green-50 transition-colors">
          Audit Syariah
        </div>
      </a>
      <a href="/tata-kelola/audit-iso" className="w-full">
        <div className="mt-4 rounded-full font-semibold border border-zinc-200 p-2 text-center hover:bg-green-50 transition-colors">
          Audit ISO
        </div>
      </a>
    </div>
  );
}
