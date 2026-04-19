@extends('layouts.app')

@section('title', 'Daftar Pengaduan - SPS Modern')
@section('page-title', Auth::user()->role === 'admin' ? 'Semua Pengaduan' : 'Riwayat Pengaduan')

@section('content')
<!-- Header & Filters -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold font-heading text-text-primary">
            {{ Auth::user()->role === 'admin' ? 'Kelola Semua Pengaduan' : 'Riwayat Pengaduan Anda' }}
        </h2>
        <p class="text-text-secondary mt-1 text-sm">
            {{ Auth::user()->role === 'admin' ? 'Daftar seluruh laporan yang masuk dari siswa.' : 'Daftar aspirasi dan keluhan yang pernah Anda sampaikan.' }}
        </p>
    </div>
    
    @if(Auth::user()->role !== 'admin')
    <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-300 w-full md:w-auto shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Laporan
    </a>
    @endif
</div>

<!-- Export & Filters -->
<div class="bg-surface p-5 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] mb-8 flex flex-col gap-5">
    <form action="{{ route('pengaduan.index') }}" method="GET" id="filter-form" class="flex flex-col md:flex-row gap-4 items-end">
        <div class="w-full md:w-1/3">
            <label class="block text-xs font-medium text-gray-500 mb-1">Pencarian</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none">
            </div>
        </div>
        <div class="w-full md:w-1/6">
            <label class="block text-xs font-medium text-gray-500 mb-1">Status</label>
            <select name="status" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none text-gray-600">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="w-full md:w-1/6">
            <label class="block text-xs font-medium text-gray-500 mb-1">Dari Tanggal</label>
            <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none text-gray-600">
        </div>
        <div class="w-full md:w-1/6">
            <label class="block text-xs font-medium text-gray-500 mb-1">Sampai Tanggal</label>
            <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-primary/20 transition-all outline-none text-gray-600">
        </div>
        <div class="w-full md:w-auto flex gap-2">
            <button type="submit" class="px-5 py-2.5 bg-gradient-primary text-white rounded-xl text-sm font-medium transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                Filter
            </button>
            <a href="{{ route('pengaduan.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 rounded-xl text-sm font-medium transition-all">
                Reset
            </a>
        </div>
    </form>

    <div class="pt-4 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-sm text-gray-500">
            Menampilkan <span class="font-bold text-gray-800">{{ $pengaduan->count() }}</span> data laporan
        </div>
        <div class="flex gap-2 w-full md:w-auto export-buttons">
            <a href="{{ route('pengaduan.export.pdf', request()->all()) }}" target="_blank" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-50 text-primary hover:bg-primary hover:text-white border border-red-100 hover:border-primary rounded-xl text-sm font-semibold transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export PDF
            </a>
            <a href="{{ route('pengaduan.export.excel', request()->all()) }}" class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-100 hover:border-emerald-600 rounded-xl text-sm font-semibold transition-all duration-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Excel
            </a>
        </div>
    </div>
</div>

<!-- List Laporan -->
@if($pengaduan->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($pengaduan as $item)
            <a href="{{ route('pengaduan.show', $item) }}" class="group bg-surface border border-gray-100 rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_40px_rgba(220,38,38,0.08)] hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative">
                
                @if($item->foto)
                    <div class="h-48 w-full relative overflow-hidden bg-gray-100">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                @else
                    <div class="h-48 w-full bg-gradient-to-br from-red-50 to-red-100 flex flex-col items-center justify-center text-red-300 p-6 relative overflow-hidden">
                        <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-medium uppercase tracking-widest text-red-400">Tanpa Foto</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-white to-transparent"></div>
                    </div>
                @endif
                
                <div class="absolute top-4 right-4 z-10">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md shadow-sm
                        {{ $item->status === 'pending' ? 'bg-amber-100/90 text-amber-700 border border-amber-200/50' : '' }}
                        {{ $item->status === 'diproses' ? 'bg-blue-100/90 text-blue-700 border border-blue-200/50' : '' }}
                        {{ $item->status === 'selesai' ? 'bg-green-100/90 text-green-700 border border-green-200/50' : '' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>

                <div class="p-6 flex-1 flex flex-col {{ !$item->foto ? '-mt-12 relative z-10 bg-white/80 backdrop-blur-sm mx-4 mb-4 rounded-xl shadow-sm border border-white/50' : '' }}">
                    <div class="flex items-center gap-2 mb-3 text-xs text-text-secondary">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $item->tanggal_lapor->format('d M Y') }}
                    </div>
                    
                    <h3 class="text-lg font-bold font-heading text-text-primary mb-2 line-clamp-2 group-hover:text-primary transition-colors">{{ $item->judul }}</h3>
                    <p class="text-sm text-text-secondary line-clamp-2 mb-4 flex-1">{{ $item->isi_laporan }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-600">
                                {{ strtoupper(substr($item->is_anonim ? 'Anonim' : $item->user->nama, 0, 1)) }}
                            </div>
                            <span class="text-xs font-medium text-gray-600">
                                @if(Auth::user()->role === 'admin' && $item->is_anonim)
                                    Anonim <span class="text-gray-400 font-normal">({{ $item->user->nama }})</span>
                                @else
                                    {{ $item->is_anonim ? 'Anonim' : $item->user->nama }}
                                @endif
                            </span>
                        </div>
                        <span class="text-primary group-hover:translate-x-1 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@else
    <!-- Empty State -->
    <div class="bg-surface rounded-2xl border border-gray-100 p-12 flex flex-col items-center justify-center text-center shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
        <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-primary opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold font-heading text-text-primary mb-2">Belum Ada Pengaduan</h3>
        <p class="text-text-secondary mb-8 max-w-md">
            {{ Auth::user()->role === 'admin' ? 'Belum ada pengaduan yang masuk dari siswa saat ini.' : 'Anda belum pernah membuat pengaduan atau aspirasi apapun.' }}
        </p>
        
        @if(Auth::user()->role !== 'admin')
        <a href="{{ route('pengaduan.create') }}" class="px-6 py-3 bg-red-50 text-primary hover:bg-primary hover:text-white rounded-xl font-semibold transition-colors duration-300 border border-red-100 hover:border-primary">
            Mulai Buat Pengaduan
        </a>
        @endif
    </div>
@endif

@endsection

@push('scripts')
@if(request('print') == 1)
<script>
    window.onload = function() {
        // Add a slight delay to allow images to load
        setTimeout(() => {
            window.print();
        }, 500);
    }
</script>
@endif
@endpush
