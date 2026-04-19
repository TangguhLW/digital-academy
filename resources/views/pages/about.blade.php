@extends('layouts.app')

@section('title', 'Tentang Website - SPS Modern')
@section('page-title', 'Tentang Kami')

@section('content')
<div class="max-w-5xl mx-auto space-y-12 pb-10">

    <!-- Hero / About Section -->
    <div class="bg-surface rounded-3xl border border-gray-100 overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.04)] relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-full blur-3xl opacity-50 -mt-20 -mr-20"></div>
        <div class="relative p-8 md:p-12 flex flex-col md:flex-row items-center gap-10">
            <div class="w-full md:w-1/2">
                <h2 class="text-sm font-bold text-primary tracking-wider uppercase mb-3">Tentang Website</h2>
                <h1 class="text-3xl md:text-4xl font-bold font-heading text-gray-900 mb-6 leading-tight">Platform Pengaduan Siswa <span class="text-primary">Modern</span></h1>
                <p class="text-gray-600 leading-relaxed text-lg mb-6">
                    Website ini merupakan sistem pengaduan siswa yang bertujuan untuk memfasilitasi siswa dalam menyampaikan keluhan, aspirasi, dan laporan secara mudah, cepat, dan transparan.
                </p>
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-4">
                        @foreach($recentUsers as $user)
                            @if($user->avatar && file_exists(public_path('storage/' . $user->avatar)))
                                <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->nama }}">
                            @elseif($user->avatar && str_starts_with($user->avatar, 'http'))
                                <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="{{ $user->avatar }}" alt="{{ $user->nama }}">
                            @else
                                <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-primary flex items-center justify-center text-white text-xs font-bold">{{ strtoupper(substr($user->nama, 0, 1)) }}</div>
                            @endif
                        @endforeach
                        @if($totalUsers > 3)
                        <div class="flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full">
                            +{{ $totalUsers - 3 }}
                        </div>
                        @endif
                    </div>
                    <span class="text-sm font-medium text-gray-500">Bergabung bersama siswa lainnya</span>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
                <!-- Decorative SVG / Illustration -->
                <div class="w-64 h-64 bg-gradient-to-br from-red-100 to-red-50 rounded-full flex items-center justify-center relative">
                    <div class="absolute inset-0 bg-white/40 rounded-full backdrop-blur-sm shadow-inner"></div>
                    <svg class="w-32 h-32 text-primary relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Vision & Mission -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-4">
        <!-- Visi -->
        <div class="bg-surface rounded-3xl p-8 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:-translate-y-1 transition-transform duration-300">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-primary mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </div>
            <h3 class="text-2xl font-bold font-heading text-gray-900 mb-4">Visi Kami</h3>
            <p class="text-gray-600 leading-relaxed">
                Menjadi platform pengaduan siswa yang modern, transparan, dan terpercaya dalam meningkatkan kualitas lingkungan sekolah dan mendengarkan setiap aspirasi.
            </p>
        </div>

        <!-- Misi -->
        <div class="bg-surface rounded-3xl p-8 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:-translate-y-1 transition-transform duration-300">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-primary mb-6">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3 class="text-2xl font-bold font-heading text-gray-900 mb-4">Misi Kami</h3>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Memberikan sarana pengaduan yang mudah diakses dari mana saja.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Meningkatkan komunikasi efektif antara siswa dan pihak sekolah.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Menjamin kerahasiaan dan keamanan data pengguna sistem.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Memberikan respon cepat terhadap setiap pengaduan yang masuk.
                </li>
            </ul>
        </div>
    </div>

    <!-- Creator Section -->
    <div class="mt-20">
        <h3 class="text-xl font-bold font-heading text-gray-900 mb-8 text-center"></h3>
        <div class="max-w-xl mx-auto">
            <div class="bg-surface rounded-3xl p-6 md:p-8 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)] flex flex-col md:flex-row items-center gap-6 md:gap-8 transform hover:scale-105 transition-transform duration-300">
                <div class="shrink-0">
                    <div class="w-24 h-24 bg-gradient-primary rounded-full shadow-lg flex items-center justify-center text-white">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <h4 class="text-xl md:text-2xl font-bold text-gray-900">Tangguh Lambang Wibawa</h4>
                    <p class="text-primary font-bold text-sm mt-1 mb-4">Developer Sistem</p>
                    <div class="py-2.5 px-4 bg-gray-50 rounded-xl inline-flex items-center gap-2.5 text-sm text-gray-600 font-medium border border-gray-100">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        SMKN 6 Tangerang Selatan
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
