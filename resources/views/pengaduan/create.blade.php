@extends('layouts.app')

@section('title', 'Buat Pengaduan - SPS Modern')

@section('content')
<!-- Hero Merah -->
<div class="relative bg-gradient-primary rounded-3xl p-8 md:p-12 mb-8 text-white overflow-hidden shadow-xl shadow-red-500/20">
    <div class="absolute right-0 top-0 w-64 h-full opacity-10 pointer-events-none">
        <svg viewBox="0 0 100 100" class="w-full h-full" preserveAspectRatio="none">
            <path d="M0,100 L100,0 L100,100 Z" fill="currentColor"></path>
        </svg>
    </div>
    <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-white/20 rounded-full blur-2xl"></div>
    
    <div class="relative z-10 max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-bold font-heading mb-3">Layanan Pengaduan Online</h1>
        <p class="text-red-100 text-lg md:text-xl font-light">Sampaikan laporan, keluhan, atau aspirasi Anda dengan mudah, cepat, dan aman.</p>
    </div>
</div>

<!-- Floating Form Card -->
<div class="max-w-4xl mx-auto -mt-16 relative z-20">
    <div class="bg-surface rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-gray-100 overflow-hidden">
        
        @if ($errors->any())
        <div class="p-6 bg-red-50 border-b border-red-100 flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-primary shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-red-800 mb-1">Ada kesalahan pada form:</h3>
                <ul class="text-sm text-red-700 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8" x-data="{ fileName: '', isDragging: false }">
            @csrf
            
            <!-- Kategori (Custom Radio) -->
            <div class="space-y-3">
                <label class="block text-sm font-bold text-text-primary">Kategori Laporan</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-primary/50 hover:bg-red-50/30 transition-all has-[:checked]:border-primary has-[:checked]:bg-red-50 has-[:checked]:ring-1 has-[:checked]:ring-primary">
                        <input type="radio" name="klasifikasi" value="pengaduan" class="sr-only" checked>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-primary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </div>
                            <span class="font-semibold text-text-primary">Pengaduan</span>
                        </div>
                    </label>
                    <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-primary/50 hover:bg-red-50/30 transition-all has-[:checked]:border-primary has-[:checked]:bg-red-50 has-[:checked]:ring-1 has-[:checked]:ring-primary">
                        <input type="radio" name="klasifikasi" value="aspirasi" class="sr-only">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </div>
                            <span class="font-semibold text-text-primary">Aspirasi</span>
                        </div>
                    </label>
                    <label class="relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm focus:outline-none hover:border-primary/50 hover:bg-red-50/30 transition-all has-[:checked]:border-primary has-[:checked]:bg-red-50 has-[:checked]:ring-1 has-[:checked]:ring-primary">
                        <input type="radio" name="klasifikasi" value="permintaan_informasi" class="sr-only">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="font-semibold text-text-primary">Informasi</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Judul & Tanggal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="judul" class="block text-sm font-bold text-text-primary">Judul Laporan <span class="text-primary">*</span></label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Fasilitas Toilet Rusak" required
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none">
                </div>
                <div class="space-y-2">
                    <label for="tanggal_kejadian" class="block text-sm font-bold text-text-primary">Tanggal Kejadian <span class="text-primary">*</span></label>
                    <div class="relative">
                        <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ old('tanggal_kejadian') }}" max="{{ date('Y-m-d') }}" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none appearance-none">
                    </div>
                </div>
            </div>

            <!-- Lokasi & Instansi (Mock fields for SaaS UI) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="lokasi" class="block text-sm font-bold text-text-primary">Lokasi (Opsional)</label>
                    <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Depan Ruang Guru, Laboratorium Komputer"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none">
                </div>
                <div class="space-y-2">
                    <label for="instansi" class="block text-sm font-bold text-text-primary">Tujuan/Instansi (Opsional)</label>
                    <div class="relative">
                        <select id="instansi" name="instansi" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none appearance-none">
                            <option value="">Pilih Tujuan Laporan</option>
                            <option value="sarpras">Sarana & Prasarana</option>
                            <option value="kesiswaan">Kesiswaan</option>
                            <option value="kurikulum">Kurikulum</option>
                            <option value="bimbingan">Bimbingan Konseling (BK)</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="isi_laporan" class="block text-sm font-bold text-text-primary">Deskripsi Pengaduan <span class="text-primary">*</span></label>
                <textarea id="isi_laporan" name="isi_laporan" rows="5" placeholder="Ceritakan detail kejadian secara kronologis dan jelas..." required
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-primary focus:ring-4 focus:ring-red-100 transition-all outline-none resize-y">{{ old('isi_laporan') }}</textarea>
            </div>

            <!-- Upload Media Drag & Drop -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Upload Foto -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-text-primary">Foto Pendukung (Opsional)</label>
                    
                    <div class="relative group h-full"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; const dt = $event.dataTransfer; if(dt.files.length) { $refs.fileInput.files = dt.files; fileName = dt.files[0].name; const reader = new FileReader(); reader.onload = e => $refs.preview.src = e.target.result; reader.readAsDataURL(dt.files[0]); }">
                        
                        <input type="file" id="foto" name="foto" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" x-ref="fileInput"
                               @change="if($event.target.files.length) { fileName = $event.target.files[0].name; const reader = new FileReader(); reader.onload = e => $refs.preview.src = e.target.result; reader.readAsDataURL($event.target.files[0]); } else { fileName = ''; $refs.preview.src = ''; }">
                        
                        <div :class="{'border-primary bg-red-50': isDragging, 'border-gray-300 bg-gray-50 group-hover:border-primary/50 group-hover:bg-red-50/20': !isDragging}" 
                             class="border-2 border-dashed rounded-2xl p-8 transition-all flex flex-col items-center justify-center text-center h-full min-h-[220px]">
                            
                            <div x-show="!fileName">
                                <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 mx-auto text-gray-400 group-hover:text-primary transition-colors">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                </div>
                                <p class="text-sm font-bold text-text-primary mb-1">Klik untuk upload foto</p>
                                <p class="text-xs text-text-secondary">SVG, PNG, JPG (Max. 2MB)</p>
                            </div>

                            <!-- Preview Area -->
                            <div x-show="fileName" class="w-full max-w-sm mx-auto" x-cloak>
                                <div class="relative rounded-xl overflow-hidden shadow-md">
                                    <img x-ref="preview" src="" class="w-full h-32 object-cover">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                        <span class="text-white font-medium text-sm flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                            Ganti
                                        </span>
                                    </div>
                                </div>
                                <p class="text-xs text-text-secondary mt-2 truncate" x-text="fileName"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Video -->
                <div class="space-y-2" x-data="{ videoName: '', isVideoDragging: false }">
                    <label class="block text-sm font-bold text-text-primary">Video Pendukung (Opsional)</label>
                    
                    <div class="relative group h-full"
                         @dragover.prevent="isVideoDragging = true"
                         @dragleave.prevent="isVideoDragging = false"
                         @drop.prevent="isVideoDragging = false; const dt = $event.dataTransfer; if(dt.files.length) { $refs.videoInput.files = dt.files; videoName = dt.files[0].name; }">
                        
                        <input type="file" id="video" name="video" accept="video/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" x-ref="videoInput"
                               @change="if($event.target.files.length) { videoName = $event.target.files[0].name; } else { videoName = ''; }">
                        
                        <div :class="{'border-primary bg-red-50': isVideoDragging, 'border-gray-300 bg-gray-50 group-hover:border-primary/50 group-hover:bg-red-50/20': !isVideoDragging}" 
                             class="border-2 border-dashed rounded-2xl p-8 transition-all flex flex-col items-center justify-center text-center h-full min-h-[220px]">
                            
                            <div x-show="!videoName">
                                <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center mb-4 mx-auto text-gray-400 group-hover:text-primary transition-colors">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                </div>
                                <p class="text-sm font-bold text-text-primary mb-1">Klik untuk upload video</p>
                                <p class="text-xs text-text-secondary">MP4, AVI, MOV (Max. 50MB)</p>
                            </div>

                            <div x-show="videoName" class="w-full max-w-sm mx-auto" x-cloak>
                                <div class="w-16 h-16 bg-primary/10 rounded-full shadow-sm flex items-center justify-center mb-4 mx-auto text-primary">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <p class="text-sm font-bold text-text-primary mt-2 truncate" x-text="videoName"></p>
                                <p class="text-xs text-text-secondary mt-1">Video siap diupload</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Anonim Checkbox with Tooltip -->
            <div class="flex items-start gap-3 bg-gray-50 p-4 rounded-xl border border-gray-100" x-data="{ tooltipOpen: false }">
                <div class="flex items-center h-5 mt-0.5">
                    <input id="is_anonim" name="is_anonim" type="checkbox" value="1" class="w-5 h-5 text-primary bg-white border-gray-300 rounded focus:ring-primary focus:ring-2">
                </div>
                <div class="flex-1 relative">
                    <div class="flex items-center gap-2">
                        <label for="is_anonim" class="font-bold text-text-primary text-sm cursor-pointer">Kirim sebagai Anonim</label>
                        <button type="button" @mouseenter="tooltipOpen = true" @mouseleave="tooltipOpen = false" @click="tooltipOpen = !tooltipOpen" class="text-gray-400 hover:text-primary transition-colors focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </button>
                    </div>
                    <p class="text-xs text-text-secondary mt-1">Nama Anda tidak akan ditampilkan ke publik, tetapi tetap tercatat di sistem.</p>
                    
                    <!-- Tooltip -->
                    <div x-show="tooltipOpen" x-transition.opacity class="absolute bottom-full left-0 mb-2 w-64 p-3 bg-gray-900 text-white text-xs rounded-xl shadow-xl z-20" x-cloak>
                        Jika diaktifkan, nama Anda akan diganti menjadi <strong>"Anonim"</strong> pada daftar laporan. Hanya administrator yang dapat melihat identitas asli Anda untuk keperluan validasi.
                        <div class="absolute -bottom-1 left-6 w-2 h-2 bg-gray-900 transform rotate-45"></div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 border-t border-gray-100 flex flex-col md:flex-row gap-4 justify-end">
                <a href="{{ route('pengaduan.index') }}" class="px-6 py-3.5 bg-white border border-gray-200 text-text-primary rounded-xl font-semibold hover:bg-gray-50 transition-colors text-center">Batal</a>
                <button type="submit" class="px-8 py-3.5 bg-gradient-primary text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all text-center flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    KIRIM LAPORAN!
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
