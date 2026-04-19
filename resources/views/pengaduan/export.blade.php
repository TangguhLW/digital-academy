@extends('layouts.app')

@section('title', 'Export Laporan - SPS Modern')
@section('page-title', 'Export Laporan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="{ printMode: false }">
    <div>
        <h2 class="text-2xl font-bold font-heading text-text-primary">Export Laporan Pengaduan</h2>
        <p class="text-text-secondary mt-1 text-sm">Unduh data laporan pengaduan dalam format PDF, Excel, atau Print langsung.</p>
    </div>

    <div class="bg-surface p-6 md:p-8 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -mt-8 -mr-8 w-40 h-40 bg-gradient-primary rounded-full blur-3xl opacity-10 pointer-events-none"></div>

        <form action="#" method="GET" class="relative z-10 space-y-6" id="exportForm">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3">Filter Data</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="tanggal_dari" id="tanggal_dari" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                </div>

                <!-- Status & Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Pengaduan</label>
                    <select name="status" id="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none text-gray-700">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian Keyword</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" id="search" placeholder="Cari judul atau isi..." class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none">
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-4 mt-8 border-b border-gray-100 pb-3">Pilih Format Export</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- PDF -->
                <button type="button" onclick="submitExport('{{ route('pengaduan.export.pdf') }}')" class="group relative flex flex-col items-center justify-center p-6 bg-white border border-gray-200 hover:border-red-500 rounded-2xl transition-all duration-300 hover:shadow-[0_8px_30px_rgba(239,68,68,0.12)] hover:-translate-y-1">
                    <div class="w-14 h-14 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-4 group-hover:bg-red-500 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-1">Export PDF</h4>
                    <p class="text-xs text-center text-gray-500">Dokumen formal siap cetak.</p>
                </button>

                <!-- Excel -->
                <button type="button" onclick="submitExport('{{ route('pengaduan.export.excel') }}')" class="group relative flex flex-col items-center justify-center p-6 bg-white border border-gray-200 hover:border-emerald-500 rounded-2xl transition-all duration-300 hover:shadow-[0_8px_30px_rgba(16,185,129,0.12)] hover:-translate-y-1">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-1">Export Excel</h4>
                    <p class="text-xs text-center text-gray-500">Data spreadsheet (.xlsx) rapi.</p>
                </button>

                <!-- Print -->
                <button type="button" onclick="handlePrint()" class="group relative flex flex-col items-center justify-center p-6 bg-white border border-gray-200 hover:border-blue-500 rounded-2xl transition-all duration-300 hover:shadow-[0_8px_30px_rgba(59,130,246,0.12)] hover:-translate-y-1">
                    <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-1">Print Langsung</h4>
                    <p class="text-xs text-center text-gray-500">Cetak ke printer atau simpan PDF.</p>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function submitExport(url) {
    const form = document.getElementById('exportForm');
    form.action = url;
    form.target = '_blank';
    form.submit();
}

function handlePrint() {
    // For print, we use the PDF view but trigger window.print() inside it
    // Wait, the easiest way for "print view khusus" or window.print() 
    // is to just load a minimal view and call print.
    // Let's use the PDF route but we might need a dedicated print view.
    // For now, let's open the index page with print parameter.
    
    const qs = new URLSearchParams(new FormData(document.getElementById('exportForm'))).toString();
    const printUrl = `{{ route('pengaduan.index') }}?print=1&` + qs;
    
    const printWindow = window.open(printUrl, '_blank');
    // The index page should have a script to handle print if print=1 is present.
}
</script>
@endsection
