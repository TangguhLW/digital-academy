<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk / Daftar - SPS Modern</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        
        /* Flip Card Base CSS */
        .perspective-1000 { perspective: 1000px; }
        .transform-style-3d { transform-style: preserve-3d; }
        .backface-hidden { backface-visibility: hidden; }
        .rotate-y-180 { transform: rotateY(180deg); }
        .transition-transform-600 { transition: transform 0.6s cubic-bezier(0.4, 0.2, 0.2, 1); }
    </style>
</head>
<body class="bg-gray-50 relative overflow-x-hidden antialiased" x-data="{ isFlipped: {{ request()->routeIs('register') || $errors->has('nama') || $errors->has('email') && !$errors->has('login') ? 'true' : 'false' }}, isPasswordVisible: false, isRegisterPasswordVisible: false, isRegisterConfirmVisible: false }">

    <!-- Decorative Background -->
    <div class="fixed top-0 right-0 -z-10 translate-x-1/3 -translate-y-1/4">
        <div class="w-[800px] h-[800px] rounded-full bg-red-100/60 blur-[120px]"></div>
    </div>
    <div class="fixed bottom-0 left-0 -z-10 -translate-x-1/3 translate-y-1/4">
        <div class="w-[600px] h-[600px] rounded-full bg-blue-50/60 blur-[100px]"></div>
    </div>

    <!-- Centering Wrapper -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 w-full">
        <!-- Main Container -->
        <div class="w-full max-w-[1000px] mx-auto flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12 z-10">
        
        <!-- Welcome Text (Left Side Desktop) -->
        <div class="w-full md:w-1/2 text-center md:text-left hidden md:block">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-primary font-bold text-xs uppercase tracking-wider mb-6 border border-red-100 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Digital Academy
            </div>
            
            <h1 class="text-4xl lg:text-5xl font-extrabold font-heading text-gray-900 leading-[1.15] mb-6">
                Sistem <br/>Pengaduan <span class="text-transparent bg-clip-text bg-gradient-primary">Siswa</span>
            </h1>
            <p class="text-gray-600 text-lg font-light leading-relaxed max-w-md">
                Mari wujudkan lingkungan sekolah yang lebih baik dengan menyampaikan aspirasi dan laporan Anda secara aman dan transparan.
            </p>
        </div>

        <!-- 3D Flip Card Container -->
        <div class="w-full md:w-1/2 max-w-md mx-auto perspective-1000">
            
            <!-- Card Inner -->
            <div class="grid w-full transition-transform-600 transform-style-3d" :class="isFlipped ? 'rotate-y-180' : ''">
                
                <!-- FRONT: LOGIN FORM -->
                <div class="col-start-1 row-start-1 w-full h-full bg-white rounded-[24px] shadow-[0_20px_60px_rgba(220,38,38,0.08)] border border-white backface-hidden flex flex-col overflow-hidden min-h-[560px]">
                    <div class="p-8 md:p-10 flex-1 flex flex-col">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-bold font-heading text-gray-900 mb-2">Selamat Datang 👋</h2>
                            <p class="text-gray-500 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Login Error -->
                        @if ($errors->has('login') || $errors->has('username'))
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-sm font-medium flex items-start gap-3">
                            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span>{{ $errors->first('login') ?: $errors->first('username') }}</span>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="flex-1 flex flex-col">
                            @csrf
                            <div class="space-y-5">
                                <!-- Email/Username -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email / Username</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <input type="text" name="login" value="{{ old('login') }}" required autofocus class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none" placeholder="Masukkan email atau username">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <label class="text-sm font-semibold text-gray-700">Password</label>
                                        <a href="#" class="text-xs font-semibold text-primary hover:text-red-700 transition-colors">Lupa Password?</a>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </div>
                                        <input :type="isPasswordVisible ? 'text' : 'password'" name="password" required class="w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none" placeholder="••••••••">
                                        <button type="button" @click="isPasswordVisible = !isPasswordVisible" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary transition-colors focus:outline-none">
                                            <svg x-show="!isPasswordVisible" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg x-show="isPasswordVisible" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Remember Me -->
                                <div class="flex items-center">
                                    <input id="remember" type="checkbox" name="remember" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary focus:ring-2 cursor-pointer">
                                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer select-none">Ingat saya</label>
                                </div>
                            </div>

                            <div class="mt-8 space-y-4">
                                <button type="submit" class="w-full py-3.5 bg-gradient-primary text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2 group relative overflow-hidden" x-data="{ loading: false }" @click="loading = true">
                                    <span x-show="!loading" class="flex items-center gap-2">
                                        Masuk Sekarang
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </span>
                                    <span x-show="loading" class="flex items-center gap-2" x-cloak>
                                        <svg class="animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Memproses...
                                    </span>
                                </button>

                                <div class="flex items-center justify-center gap-4 text-sm text-gray-400">
                                    <span class="h-px w-full bg-gray-200"></span>
                                    <span>ATAU</span>
                                    <span class="h-px w-full bg-gray-200"></span>
                                </div>

                                <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:shadow-sm transition-all duration-300">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Lanjutkan dengan Google
                                </a>
                            </div>
                        </form>

                        <div class="mt-8 text-center">
                            <p class="text-sm text-gray-600">
                                Belum punya akun? 
                                <button type="button" @click="isFlipped = true" class="font-bold text-primary hover:text-red-700 transition-colors focus:outline-none">Daftar Sekarang</button>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- BACK: REGISTER FORM -->
                <div class="col-start-1 row-start-1 w-full h-full bg-white rounded-[24px] shadow-[0_20px_60px_rgba(220,38,38,0.08)] border border-white backface-hidden rotate-y-180 flex flex-col overflow-hidden min-h-[560px]">
                    <div class="p-8 md:p-10 flex-1 flex flex-col">
                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-bold font-heading text-gray-900 mb-2">Buat Akun Baru ✨</h2>
                            <p class="text-gray-500 text-sm">Bergabunglah dan sampaikan aspirasi Anda</p>
                        </div>

                        <!-- Register Error -->
                        @if ($errors->any() && ($errors->has('nama') || $errors->has('email') || $errors->has('password')))
                        <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-100 text-red-600 text-xs font-medium flex items-start gap-3">
                            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <ul class="list-disc pl-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" class="flex-1 flex flex-col">
                            @csrf
                            <div class="space-y-4">
                                <!-- Nama -->
                                <div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none" placeholder="Nama Lengkap">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none" placeholder="Alamat Email">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        </div>
                                        <input :type="isRegisterPasswordVisible ? 'text' : 'password'" name="password" required class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none" placeholder="Password (Min. 8 karakter)">
                                        <button type="button" @click="isRegisterPasswordVisible = !isRegisterPasswordVisible" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary transition-colors focus:outline-none">
                                            <svg x-show="!isRegisterPasswordVisible" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg x-show="isRegisterPasswordVisible" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        </div>
                                        <input :type="isRegisterConfirmVisible ? 'text' : 'password'" name="password_confirmation" required class="w-full pl-10 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none" placeholder="Konfirmasi Password">
                                        <button type="button" @click="isRegisterConfirmVisible = !isRegisterConfirmVisible" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-primary transition-colors focus:outline-none">
                                            <svg x-show="!isRegisterConfirmVisible" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <svg x-show="isRegisterConfirmVisible" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 space-y-4">
                                <button type="submit" class="w-full py-3 bg-gradient-primary text-white rounded-xl font-bold shadow-md shadow-red-500/30 hover:shadow-lg hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2 group" x-data="{ loading: false }" @click="loading = true">
                                    <span x-show="!loading" class="flex items-center gap-2">
                                        Daftar Sekarang
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </span>
                                    <span x-show="loading" class="flex items-center gap-2" x-cloak>
                                        <svg class="animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Memproses...
                                    </span>
                                </button>

                                <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 bg-white border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:shadow-sm transition-all duration-300">
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                                    Daftar dengan Google
                                </a>
                            </div>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">
                                Sudah punya akun? 
                                <button type="button" @click="isFlipped = false" class="font-bold text-primary hover:text-red-700 transition-colors focus:outline-none">Login Disini</button>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>

</body>
</html>
