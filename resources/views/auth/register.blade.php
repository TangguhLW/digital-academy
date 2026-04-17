<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SPS Modern</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-red-100/50 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-blue-50/50 rounded-full blur-[100px] translate-y-1/3 -translate-x-1/4"></div>

    <div class="w-full max-w-xl bg-white rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.06)] relative z-10 p-8 md:p-12 overflow-hidden group" x-data="{ isSubmitting: false, activeField: null }">
        
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-gradient-primary rounded-2xl mx-auto flex items-center justify-center text-white mb-6 shadow-lg shadow-red-500/20 group-hover:scale-110 transition-transform duration-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Buat Akun Siswa</h1>
            <p class="text-gray-500 font-medium">Lengkapi form di bawah untuk mendaftar.</p>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl">
            <div class="flex gap-3 text-red-600 mb-2">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span class="text-sm font-semibold">Terdapat kesalahan:</span>
            </div>
            <ul class="text-xs text-red-500 list-disc list-inside ml-8 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5" @submit="isSubmitting = true">
            @csrf
            
            <div class="space-y-1.5 transition-all duration-300" :class="activeField === 'nama' ? 'scale-105' : 'scale-100'">
                <label class="block text-sm font-bold" :class="activeField === 'nama' ? 'text-primary' : 'text-gray-700'">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required autofocus
                       @focus="activeField = 'nama'" @blur="activeField = null"
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none font-medium placeholder:font-normal placeholder:text-gray-400"
                       placeholder="Misal: Budi Santoso">
            </div>

            <div class="space-y-1.5 transition-all duration-300" :class="activeField === 'username' ? 'scale-105' : 'scale-100'">
                <label class="block text-sm font-bold" :class="activeField === 'username' ? 'text-primary' : 'text-gray-700'">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required
                       @focus="activeField = 'username'" @blur="activeField = null"
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none font-medium placeholder:font-normal placeholder:text-gray-400"
                       placeholder="Pilih username unik">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1.5 transition-all duration-300" :class="activeField === 'password' ? 'scale-105' : 'scale-100'">
                    <label class="block text-sm font-bold" :class="activeField === 'password' ? 'text-primary' : 'text-gray-700'">Password</label>
                    <input type="password" name="password" required
                           @focus="activeField = 'password'" @blur="activeField = null"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none font-medium placeholder:font-normal placeholder:text-gray-400"
                           placeholder="Minimal 6 karakter">
                </div>

                <div class="space-y-1.5 transition-all duration-300" :class="activeField === 'password_conf' ? 'scale-105' : 'scale-100'">
                    <label class="block text-sm font-bold" :class="activeField === 'password_conf' ? 'text-primary' : 'text-gray-700'">Ulangi Password</label>
                    <input type="password" name="password_confirmation" required
                           @focus="activeField = 'password_conf'" @blur="activeField = null"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none font-medium placeholder:font-normal placeholder:text-gray-400"
                           placeholder="Ketik ulang password">
                </div>
            </div>

            <button type="submit" class="mt-8 w-full flex items-center justify-center gap-2 py-4 bg-gradient-primary text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 transition-all duration-300 relative overflow-hidden" :class="isSubmitting ? 'opacity-80 pointer-events-none' : 'hover:-translate-y-0.5'">
                <span x-show="!isSubmitting">Buat Akun Sekarang</span>
                <span x-show="isSubmitting" x-cloak class="flex items-center gap-2">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    Mendaftarkan...
                </span>
            </button>
        </form>

        <p class="mt-8 text-center text-sm font-medium text-gray-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-primary hover:text-red-700 font-bold ml-1 transition-colors">Masuk di sini</a>
        </p>
    </div>

</body>
</html>
