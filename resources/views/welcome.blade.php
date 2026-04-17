<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digital Academy - Sistem Pengaduan Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased overflow-x-hidden selection:bg-red-500 selection:text-white" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 border-b" :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm py-4 border-gray-100' : 'bg-transparent py-6 border-transparent'">
        <div class="max-w-7xl mx-auto px-6 md:px-12 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-primary flex items-center justify-center text-white shadow-lg shadow-red-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <span class="text-2xl font-bold font-heading text-gray-900 tracking-tight">SPS <span class="text-primary">Modern</span></span>
            </div>
            
            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-gradient-primary text-white rounded-xl font-semibold shadow-md shadow-red-500/20 hover:shadow-lg hover:shadow-red-500/30 hover:-translate-y-0.5 transition-all duration-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-gray-600 font-semibold hover:text-primary transition-colors hidden sm:block">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-primary text-white rounded-xl font-semibold shadow-md shadow-red-500/20 hover:shadow-lg hover:shadow-red-500/30 hover:-translate-y-0.5 transition-all duration-300">Daftar Sekarang</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-40 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 right-0 -z-10 translate-x-1/3 -translate-y-1/4">
            <div class="w-[800px] h-[800px] rounded-full bg-red-100/60 blur-[120px]"></div>
        </div>
        <div class="absolute bottom-0 left-0 -z-10 -translate-x-1/3 translate-y-1/4">
            <div class="w-[600px] h-[600px] rounded-full bg-blue-50/60 blur-[100px]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Hero Content -->
            <div class="text-center lg:text-left z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-primary font-bold text-xs uppercase tracking-wider mb-8 border border-red-100/50 shadow-sm">
                    <span class="flex w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    Layanan Pengaduan Siswa v2.0
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold font-heading text-gray-900 leading-[1.1] mb-6">
                    Sampaikan Aspirasi <br class="hidden lg:block"/>
                    <span class="text-transparent bg-clip-text bg-gradient-primary">Tanpa Ragu</span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto lg:mx-0 font-light leading-relaxed">
                    Platform pengaduan siswa yang modern, aman, dan responsif. Kami mendengar setiap suara Anda demi sekolah yang lebih baik.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-primary text-white rounded-2xl font-bold text-lg shadow-xl shadow-red-500/30 hover:shadow-2xl hover:shadow-red-500/40 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group">
                        Mulai Lapor
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-white border border-gray-200 text-gray-700 rounded-2xl font-bold text-lg shadow-sm hover:bg-gray-50 transition-all duration-300 text-center">
                        Pelajari Fitur
                    </a>
                </div>
            </div>

            <!-- Hero Image/Mockup -->
            <div class="relative z-10 w-full max-w-lg mx-auto lg:max-w-none">
                <!-- Abstract Card Layout Mockup -->
                <div class="relative w-full aspect-square md:aspect-[4/3] lg:aspect-square">
                    <!-- Base Layer Card -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-[80%] bg-white rounded-[40px] shadow-[0_20px_80px_rgba(0,0,0,0.06)] border border-white rotate-3"></div>
                    
                    <!-- Top Layer Card -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-[80%] bg-white rounded-[40px] shadow-[0_30px_100px_rgba(220,38,38,0.1)] border border-gray-50 flex flex-col overflow-hidden -rotate-3 transition-transform duration-700 hover:rotate-0">
                        
                        <!-- Header Mockup -->
                        <div class="h-24 bg-gradient-primary p-6 flex items-center justify-between">
                            <div>
                                <div class="h-4 w-32 bg-white/30 rounded-full mb-2"></div>
                                <div class="h-3 w-48 bg-white/20 rounded-full"></div>
                            </div>
                            <div class="w-12 h-12 bg-white/20 rounded-full"></div>
                        </div>
                        
                        <!-- Body Mockup -->
                        <div class="p-8 flex-1 flex flex-col gap-6">
                            <!-- Input -->
                            <div class="w-full h-14 bg-gray-50 rounded-xl border border-gray-100 flex items-center px-4 gap-4">
                                <div class="w-6 h-6 rounded bg-gray-200"></div>
                                <div class="h-3 w-40 bg-gray-200 rounded-full"></div>
                            </div>
                            <!-- Input -->
                            <div class="w-full h-32 bg-gray-50 rounded-xl border border-gray-100 p-4">
                                <div class="h-3 w-1/3 bg-gray-200 rounded-full mb-4"></div>
                                <div class="h-2 w-full bg-gray-200 rounded-full mb-2"></div>
                                <div class="h-2 w-5/6 bg-gray-200 rounded-full"></div>
                            </div>
                            <!-- Button -->
                            <div class="mt-auto w-full h-14 bg-gradient-primary rounded-xl flex items-center justify-center opacity-90 shadow-md">
                                <div class="h-4 w-24 bg-white/80 rounded-full"></div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Floating Element 1 -->
                    <div class="absolute top-[10%] -left-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-50 flex items-center gap-4 animate-[bounce_4s_infinite]">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <div class="h-2.5 w-16 bg-gray-300 rounded-full mb-1.5"></div>
                            <div class="h-2 w-24 bg-gray-200 rounded-full"></div>
                        </div>
                    </div>
                    
                    <!-- Floating Element 2 -->
                    <div class="absolute bottom-[20%] -right-6 bg-white p-4 rounded-2xl shadow-xl border border-gray-50 flex items-center gap-4 animate-[bounce_5s_infinite_1s]">
                        <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="h-2.5 w-20 bg-gray-300 rounded-full mb-1.5"></div>
                            <div class="h-2 w-16 bg-gray-200 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-4xl font-bold font-heading text-gray-900 mb-4">Mengapa Menggunakan SPS Modern?</h2>
                <p class="text-gray-500 text-lg">Kami mendesain ulang pengalaman pengaduan untuk menjadi lebih transparan, responsif, dan melindungi privasi Anda sepenuhnya.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl hover:bg-white hover:border-red-100 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-red-100 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Privasi</h3>
                    <p class="text-gray-500 leading-relaxed">Opsi pengiriman laporan anonim melindungi identitas Anda saat memberikan laporan sensitif tanpa rasa takut.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl hover:bg-white hover:border-red-100 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-red-100 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tindak Lanjut Cepat</h3>
                    <p class="text-gray-500 leading-relaxed">Sistem notifikasi real-time ke administrator memastikan laporan Anda langsung masuk ke antrian untuk segera diproses.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-xl hover:bg-white hover:border-red-100 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-red-100 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transparansi Proses</h3>
                    <p class="text-gray-500 leading-relaxed">Pantau terus status laporan Anda dari mulai masuk, diproses, hingga selesai diselesaikan langsung dari dashboard Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 md:px-12 text-center flex flex-col items-center">
            <div class="w-12 h-12 rounded-xl bg-gradient-primary flex items-center justify-center text-white shadow-lg mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h2 class="text-2xl font-bold font-heading mb-4">Digital Academy</h2>
            <p class="text-gray-400 mb-8 max-w-md">Layanan Sistem Pengaduan Siswa berbasis SaaS Modern. Mari wujudkan masa depan pendidikan yang lebih baik.</p>
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Digital Academy. Hak cipta dilindungi undang-undang.</p>
        </div>
    </footer>

</body>
</html>
