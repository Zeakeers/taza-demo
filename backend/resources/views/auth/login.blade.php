<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Taman Zakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5DA630',
                        secondary: '#7FC248',
                        dark: '#002B0F',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F4FAF0] min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-10">
            <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-xl shadow-primary/10 p-2 mb-4">
                <img src="{{ asset('images/logo.svg') }}" alt="Taman Zakat" class="w-full h-full object-contain">
            </div>
            <h1 class="text-2xl font-bold text-dark">Admin Dashboard</h1>
            <p class="text-gray-500">Silakan login untuk mengelola konten</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-primary/5 p-10 relative overflow-hidden border border-white">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-secondary"></div>
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 text-red-500 p-4 rounded-2xl text-sm border border-red-100 flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                        placeholder="admin@tamanzakat.org">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-100 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between ml-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="remember" class="peer hidden">
                            <div class="w-5 h-5 border-2 border-gray-300 rounded-md peer-checked:bg-primary peer-checked:border-primary transition-all"></div>
                            <svg class="absolute top-0.5 left-0.5 w-4 h-4 text-white opacity-0 peer-checked:opacity-100 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-sm text-gray-600 group-hover:text-primary transition-colors">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" 
                    class="w-full bg-primary hover:bg-dark text-white font-bold py-5 rounded-3xl shadow-lg shadow-primary/20 hover:shadow-dark/20 transform hover:-translate-y-1 transition-all">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <p class="text-center mt-10 text-sm text-gray-400">
            &copy; 2026 Admin Taman Zakat. Semua Hak Dilindungi.
        </p>
    </div>
</body>
</html>
