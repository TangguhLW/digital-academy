@extends('layouts.app')

@section('title', 'Fitur Sedang Dalam Pemeliharaan - SPS Modern')
@section('page-title', 'Export Laporan')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-surface rounded-2xl border border-gray-100 p-8 md:p-12 flex flex-col items-center justify-center text-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] relative overflow-hidden">
        
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-amber-500 rounded-full blur-3xl opacity-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-red-500 rounded-full blur-3xl opacity-10 pointer-events-none"></div>

        <div class="w-24 h-24 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mb-6 relative z-10 shadow-sm border border-amber-100">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        
        <h2 class="text-2xl md:text-3xl font-bold font-heading text-gray-900 mb-4 relative z-10">Fitur Sedang Dalam Pemeliharaan</h2>
        
        <p class="text-gray-600 text-base md:text-lg mb-8 max-w-lg leading-relaxed relative z-10">
            Mohon maaf, sistem saat ini sedang tidak dapat menggunakan fitur export PDF / Excel secara langsung karena alasan pemeliharaan server. <br><br>
            Sebagai alternatif, silakan gunakan fitur <strong class="text-gray-900">Print Langsung</strong> untuk mencetak dokumen atau menyimpannya sebagai file PDF melalui browser Anda.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-3 relative z-10">
            <a href="javascript:history.back()" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-xl font-semibold transition-all duration-300">
                Kembali
            </a>
            <a href="{{ route('pengaduan.export.index') }}" class="px-6 py-3 bg-gradient-primary text-white hover:shadow-lg hover:-translate-y-0.5 rounded-xl font-semibold shadow-md shadow-red-500/20 transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Gunakan Fitur Print
            </a>
        </div>

    </div>
</div>
@endsection
