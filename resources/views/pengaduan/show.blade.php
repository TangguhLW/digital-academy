@extends('layouts.app')

@section('title', 'Detail Pengaduan - SPS Modern')
@section('page-title', 'Detail Laporan')

@section('content')
<div class="mb-6">
    <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-600 hover:text-primary hover:border-red-200 hover:bg-red-50 transition-all shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-surface rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden relative">
            <!-- Decorative Header -->
            <div class="h-2 w-full bg-gradient-primary"></div>
            
            <div class="p-8">
                <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold uppercase tracking-wider">
                                {{ $pengaduan->klasifikasi ?? 'Pengaduan' }}
                            </span>
                            <span class="text-sm font-medium text-gray-400">#{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold font-heading text-text-primary leading-tight">{{ $pengaduan->judul }}</h1>
                    </div>
                </div>

                <div class="flex items-center gap-4 py-4 mb-6 border-y border-gray-100">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-600 font-bold text-lg shrink-0">
                        {{ strtoupper(substr($pengaduan->is_anonim ? 'A' : $pengaduan->user->nama, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-bold text-text-primary text-sm">
                            @if(Auth::user()->role === 'admin' && $pengaduan->is_anonim)
                                Anonim <span class="text-gray-400 font-normal">({{ $pengaduan->user->nama }})</span>
                            @else
                                {{ $pengaduan->is_anonim ? 'Anonim' : $pengaduan->user->nama }}
                            @endif
                        </p>
                        <div class="flex items-center gap-2 text-xs text-text-secondary mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $pengaduan->tanggal_lapor->format('d F Y, H:i') }} WIB
                        </div>
                    </div>
                </div>

                <div class="prose max-w-none mb-8">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Deskripsi Lengkap</h3>
                    <p class="text-text-primary leading-relaxed whitespace-pre-line text-justify">{{ $pengaduan->isi_laporan }}</p>
                </div>

                @if($pengaduan->foto)
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Foto Pendukung</h3>
                    <a href="{{ asset('storage/' . $pengaduan->foto) }}" target="_blank" class="block rounded-xl overflow-hidden shadow-md group relative">
                        <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Lampiran {{ $pengaduan->judul }}" class="w-full h-auto max-h-[400px] object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                            <span class="px-4 py-2 bg-white/90 backdrop-blur-sm text-gray-900 font-semibold text-sm rounded-lg opacity-0 group-hover:opacity-100 transition-opacity shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                Perbesar Foto
                            </span>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Tanggapan / Diskusi -->
        <div class="bg-surface rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col mt-6">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-white">
                <h3 class="font-bold font-heading text-text-primary text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                    Tanggapan & Diskusi
                </h3>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">{{ $pengaduan->tanggapans->count() }} Pesan</span>
            </div>

            <!-- Chat Area -->
            <div class="p-6 bg-gray-50 flex-1 max-h-[500px] overflow-y-auto space-y-6" id="chat-container">
                @if($pengaduan->tanggapans->count() > 0)
                    @foreach($pengaduan->tanggapans as $tanggapan)
                        @php
                            $isAdmin = $tanggapan->user->role === 'admin';
                            $isMe = $tanggapan->user_id === Auth::id();
                        @endphp
                        
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} group animate-[fadeIn_0.3s_ease-out]">
                            <div class="flex max-w-[85%] md:max-w-[75%] {{ $isMe ? 'flex-row-reverse' : 'flex-row' }} items-end gap-3">
                                
                                <!-- Avatar -->
                                <div class="w-8 h-8 shrink-0 rounded-full flex items-center justify-center text-xs font-bold text-white shadow-sm {{ $isAdmin ? 'bg-gradient-primary' : 'bg-gray-400' }}">
                                    {{ strtoupper(substr($tanggapan->user->nama, 0, 1)) }}
                                </div>
                                
                                <!-- Bubble -->
                                <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                                    <div class="flex items-center gap-2 mb-1.5 px-1">
                                        <span class="text-xs font-semibold {{ $isAdmin ? 'text-primary' : 'text-gray-600' }}">
                                            @if($isMe)
                                                Anda
                                            @elseif(!$isAdmin && $pengaduan->is_anonim)
                                                @if(Auth::user()->role === 'admin')
                                                    Anonim ({{ $tanggapan->user->nama }})
                                                @else
                                                    Anonim
                                                @endif
                                            @else
                                                {{ $tanggapan->user->nama }}
                                            @endif
                                        </span>
                                        @if($isAdmin)
                                            <span class="px-1.5 py-0.5 bg-red-100 text-red-600 rounded text-[10px] font-bold uppercase">Admin</span>
                                        @endif
                                        <span class="text-[10px] text-gray-400 font-medium">{{ $tanggapan->created_at->format('H:i, d M Y') }}</span>
                                    </div>
                                    
                                    <div class="px-4 py-3 shadow-sm text-sm leading-relaxed {{ $isMe ? 'bg-primary text-white rounded-2xl rounded-br-sm' : 'bg-white text-gray-800 border border-gray-100 rounded-2xl rounded-bl-sm' }}">
                                        {!! nl2br(e($tanggapan->isi_tanggapan)) !!}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="h-full flex flex-col items-center justify-center text-center py-10 opacity-70">
                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p class="text-gray-500 font-medium text-sm">Belum ada tanggapan.</p>
                        <p class="text-gray-400 text-xs mt-1">Kirim pesan pertama untuk memulai diskusi.</p>
                    </div>
                @endif
            </div>

            <!-- Form Reply -->
            <div class="p-4 bg-white border-t border-gray-100">
                <form action="{{ route('tanggapan.store', $pengaduan) }}" method="POST">
                    @csrf
                    <div class="relative flex items-end gap-3">
                        <div class="flex-1 relative">
                            <textarea name="isi_tanggapan" rows="1" class="w-full px-4 py-3 pl-4 pr-12 bg-gray-50 border border-gray-200 rounded-2xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none resize-none max-h-32 min-h-[48px]" placeholder="Ketik tanggapan Anda di sini..." required oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                        </div>
                        <button type="submit" class="shrink-0 w-12 h-12 flex items-center justify-center bg-gradient-primary text-white rounded-full shadow-md shadow-red-500/30 hover:shadow-lg hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </div>
                    @error('isi_tanggapan')
                        <p class="text-primary text-xs font-medium mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-6">
        <!-- Status Card -->
        <div class="bg-surface rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Status Laporan</h3>
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full shrink-0
                        {{ $pengaduan->status === 'pending' ? 'bg-amber-100 text-amber-500' : 'bg-gray-50 text-gray-300' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @if($pengaduan->status === 'pending')
                        <span class="absolute top-0 right-0 w-3 h-3 bg-amber-400 border-2 border-white rounded-full animate-ping"></span>
                        <span class="absolute top-0 right-0 w-3 h-3 bg-amber-500 border-2 border-white rounded-full"></span>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold {{ $pengaduan->status === 'pending' ? 'text-amber-600' : 'text-gray-400' }}">Pending</p>
                        <p class="text-xs text-gray-500">Laporan masuk</p>
                    </div>
                </div>

                <div class="w-0.5 h-6 bg-gray-100 ml-6 -my-2"></div>

                <div class="flex items-center gap-4">
                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full shrink-0
                        {{ $pengaduan->status === 'diproses' ? 'bg-blue-100 text-blue-500' : ($pengaduan->status === 'selesai' ? 'bg-blue-50 text-blue-300' : 'bg-gray-50 text-gray-300') }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        @if($pengaduan->status === 'diproses')
                        <span class="absolute top-0 right-0 w-3 h-3 bg-blue-400 border-2 border-white rounded-full animate-ping"></span>
                        <span class="absolute top-0 right-0 w-3 h-3 bg-blue-500 border-2 border-white rounded-full"></span>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold {{ $pengaduan->status === 'diproses' ? 'text-blue-600' : ($pengaduan->status === 'selesai' ? 'text-blue-400' : 'text-gray-400') }}">Diproses</p>
                        <p class="text-xs text-gray-500">Sedang ditindaklanjuti</p>
                    </div>
                </div>

                <div class="w-0.5 h-6 bg-gray-100 ml-6 -my-2"></div>

                <div class="flex items-center gap-4">
                    <div class="relative flex items-center justify-center w-12 h-12 rounded-full shrink-0
                        {{ $pengaduan->status === 'selesai' ? 'bg-green-100 text-green-500' : 'bg-gray-50 text-gray-300' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @if($pengaduan->status === 'selesai')
                        <span class="absolute top-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold {{ $pengaduan->status === 'selesai' ? 'text-green-600' : 'text-gray-400' }}">Selesai</p>
                        <p class="text-xs text-gray-500">Laporan ditutup</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Kejadian -->
        <div class="bg-surface rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Kejadian</h3>
            <ul class="space-y-4">
                <li>
                    <p class="text-xs text-gray-500 mb-1">Tanggal Kejadian</p>
                    <p class="font-semibold text-text-primary">{{ $pengaduan->tanggal_kejadian ? \Carbon\Carbon::parse($pengaduan->tanggal_kejadian)->format('d F Y') : '-' }}</p>
                </li>
                <li>
                    <p class="text-xs text-gray-500 mb-1">Lokasi Kejadian</p>
                    <p class="font-semibold text-text-primary capitalize">{{ $pengaduan->lokasi ? str_replace('_', ' ', $pengaduan->lokasi) : 'Tidak Spesifik' }}</p>
                </li>
                <li>
                    <p class="text-xs text-gray-500 mb-1">Instansi / Tujuan</p>
                    <p class="font-semibold text-text-primary capitalize">{{ $pengaduan->instansi ? str_replace('_', ' ', $pengaduan->instansi) : 'Umum' }}</p>
                </li>
            </ul>
        </div>

        <!-- Admin Actions -->
        @if(Auth::user()->role === 'admin')
        <div class="bg-red-50 rounded-2xl border border-red-100 p-6 relative overflow-hidden group">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-red-100 rounded-full opacity-50 blur-xl group-hover:scale-150 transition-transform duration-700"></div>
            <h3 class="text-sm font-bold text-red-800 uppercase tracking-wider mb-4 relative z-10">Tindakan Admin</h3>
            <form method="POST" action="{{ route('pengaduan.updateStatus', $pengaduan) }}" class="relative z-10">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-red-700 mb-2">Update Status Laporan</label>
                    <select name="status" class="w-full px-4 py-3 bg-white border border-red-200 rounded-xl focus:ring-2 focus:ring-red-200 outline-none text-sm font-medium shadow-sm transition-all cursor-pointer">
                        <option value="pending" {{ $pengaduan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ $pengaduan->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $pengaduan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Simpan Perubahan
                </button>
            </form>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.getElementById('chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
@endpush
@endsection
