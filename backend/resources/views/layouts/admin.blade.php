<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Taman Zakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .sidebar-scroll::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .sidebar-scroll {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5DA630',
                        secondary: '#7FC248',
                        dark: '#0D2B05',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#F4FAF0] flex h-screen overflow-hidden text-zinc-800">
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 shrink-0">
            <div>
                <h1 class="text-2xl font-bold text-zinc-800">@yield('header', 'Dashboard')</h1>
                <p class="text-gray-400 text-xs mt-0.5">Kelola konten website Anda dengan mudah.</p>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <button
                        class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-primary/10 hover:text-primary transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <div class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></div>
                </div>
                <a href="/" target="_blank"
                    class="px-5 py-2.5 rounded-xl border border-primary text-primary text-sm font-bold hover:bg-primary hover:text-white transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Lihat Web
                </a>
            </div>
        </header>

        <div id="main-content-area" class="flex-1 overflow-y-auto p-10 bg-white/50">
            @yield('content')
        </div>

        <!-- Footer / Signature -->
        <footer class="p-6 text-center text-gray-400 text-xs">
            &copy;2026 Taman Zakat. Dikembangkan oleh tim web Developer Zamedia.
        </footer>
    </main>
</body>

</html>