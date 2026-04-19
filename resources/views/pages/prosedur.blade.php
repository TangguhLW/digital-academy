@extends('layouts.app')

@section('title', 'Prosedur Pengaduan Siswa')
@section('page-title', 'Prosedur Pengaduan')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold font-heading text-gray-900 mb-4 tracking-tight">Alur Pengaduan <span class="text-primary">Siswa</span></h2>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg">Pahami langkah-langkah dalam menyampaikan pengaduan atau aspirasi Anda melalui sistem ini untuk memastikan proses berjalan dengan cepat dan tepat.</p>
    </div>

    <!-- Timeline Container -->
    <div class="relative wrap overflow-hidden p-4 md:p-10 h-full">

        <!-- Step 1 -->
        <div class="mb-8 flex justify-between items-center w-full right-timeline">
            <div class="order-1 w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center order-1 bg-gradient-primary shadow-xl w-12 h-12 rounded-full">
                <h1 class="mx-auto font-semibold text-lg text-white">1</h1>
            </div>
            <div class="order-1 bg-surface border border-gray-100 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] w-full md:w-5/12 px-6 py-6 transition-transform hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(220,38,38,0.1)]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl">Login / Registrasi</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Siswa harus memiliki akun dan login ke dalam sistem untuk dapat mengakses fitur pembuatan laporan pengaduan dengan aman.</p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
            <div class="order-1 w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center order-1 bg-gradient-primary shadow-xl w-12 h-12 rounded-full">
                <h1 class="mx-auto text-white font-semibold text-lg">2</h1>
            </div>
            <div class="order-1 bg-surface border border-gray-100 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] w-full md:w-5/12 px-6 py-6 transition-transform hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(220,38,38,0.1)]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl">Isi Form Pengaduan</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Masukkan detail laporan termasuk judul, deskripsi lengkap, tanggal kejadian, dan upload foto bukti jika tersedia untuk memperkuat laporan.</p>
            </div>
        </div>
        
        <!-- Step 3 -->
        <div class="mb-8 flex justify-between items-center w-full right-timeline">
            <div class="order-1 w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center order-1 bg-gradient-primary shadow-xl w-12 h-12 rounded-full">
                <h1 class="mx-auto font-semibold text-lg text-white">3</h1>
            </div>
            <div class="order-1 bg-surface border border-gray-100 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] w-full md:w-5/12 px-6 py-6 transition-transform hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(220,38,38,0.1)]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl">Pengaduan Dikirim</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Sistem akan menyimpan laporan Anda dengan status 'Pending'. Laporan ini kemudian diteruskan dan menunggu antrean pemeriksaan dari admin.</p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
            <div class="order-1 w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center order-1 bg-gradient-primary shadow-xl w-12 h-12 rounded-full">
                <h1 class="mx-auto text-white font-semibold text-lg">4</h1>
            </div>
            <div class="order-1 bg-surface border border-gray-100 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] w-full md:w-5/12 px-6 py-6 transition-transform hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(220,38,38,0.1)]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl">Verifikasi Admin</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Admin akan memeriksa validitas laporan Anda. Jika valid, status akan berubah menjadi 'Proses' dan mulai ditangani oleh pihak terkait.</p>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="mb-8 flex justify-between items-center w-full right-timeline">
            <div class="order-1 w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center order-1 bg-gradient-primary shadow-xl w-12 h-12 rounded-full">
                <h1 class="mx-auto font-semibold text-lg text-white">5</h1>
            </div>
            <div class="order-1 bg-surface border border-gray-100 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] w-full md:w-5/12 px-6 py-6 transition-transform hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(220,38,38,0.1)]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl">Tindak Lanjut</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Admin atau pihak sekolah akan memberikan tanggapan, solusi, atau tindakan nyata terkait laporan pengaduan yang sedang diproses.</p>
            </div>
        </div>

        <!-- Step 6 -->
        <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
            <div class="order-1 w-5/12 hidden md:block"></div>
            <div class="z-20 flex items-center order-1 bg-gradient-primary shadow-xl w-12 h-12 rounded-full">
                <h1 class="mx-auto text-white font-semibold text-lg">6</h1>
            </div>
            <div class="order-1 bg-surface border border-gray-100 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] w-full md:w-5/12 px-6 py-6 transition-transform hover:-translate-y-1 hover:shadow-[0_8px_30px_rgba(220,38,38,0.1)]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-800 text-xl">Selesai</h3>
                </div>
                <p class="text-sm leading-relaxed text-gray-500">Pengaduan dinyatakan selesai jika masalah telah tertangani atau diberikan solusi akhir. Status laporan akan diubah menjadi 'Selesai'.</p>
            </div>
        </div>

    </div>
    
    <div class="text-center mt-10">
        <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-primary text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Pengaduan Sekarang
        </a>
    </div>
</div>
@endsection
