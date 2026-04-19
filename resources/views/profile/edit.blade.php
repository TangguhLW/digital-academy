@extends('layouts.app')

@section('title', 'Edit Profile - SPS Modern')
@section('page-title', 'Pengaturan Profile')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    .cropper-view-box, .cropper-face {
        border-radius: 50%;
    }
</style>
@endpush

@section('content')
<div class="max-w-3xl mx-auto space-y-8 pb-10" x-data="imagePreview()">
    <!-- Header -->
    <div>
        <h2 class="text-3xl font-bold font-heading text-text-primary tracking-tight">Profile Anda</h2>
        <p class="text-text-secondary mt-2 text-base">Kelola informasi data diri dan pengaturan akun Anda.</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 rounded-2xl p-4 shadow-sm">
            <div class="flex items-center gap-2 font-semibold mb-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Terdapat Kesalahan
            </div>
            <ul class="list-disc list-inside text-sm mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Role / Status Card -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-6 md:p-8 rounded-3xl border border-gray-700 shadow-xl text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
        <div class="relative z-10 w-full flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <p class="text-gray-400 text-xs font-semibold uppercase tracking-wider mb-2">Hak Akses Sistem</p>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1.5 bg-white/10 border border-white/20 rounded-lg text-sm font-bold uppercase tracking-wider text-white">
                        {{ Auth::user()->role }}
                    </span>
                    @if(Auth::user()->role === 'admin')
                        <span class="text-emerald-400 text-sm font-medium flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Akses Penuh
                        </span>
                    @endif
                </div>
            </div>
            <div class="text-sm text-gray-300 space-y-2 md:text-right">
                <p class="flex items-center justify-start md:justify-end gap-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Akses Dashboard & Pengaduan
                </p>
                @if(Auth::user()->role === 'admin')
                    <p class="flex items-center justify-start md:justify-end gap-2">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Kelola Seluruh User Sistem
                    </p>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-surface p-6 md:p-10 rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="avatar_base64" id="avatar_base64" x-model="croppedBase64">
        
        <h3 class="text-xl font-bold text-gray-900 mb-8 border-b border-gray-100 pb-4">Informasi Dasar</h3>

        <!-- Photo Upload -->
        <div class="mb-8 flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
            <div class="w-28 h-28 rounded-full overflow-hidden bg-gray-100 border-4 border-white shadow-lg shrink-0 relative group">
                <template x-if="imageUrl">
                    <img :src="imageUrl" class="w-full h-full object-cover">
                </template>
                <template x-if="!imageUrl">
                    @if(Auth::user()->avatar && file_exists(public_path('storage/' . Auth::user()->avatar)))
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-full h-full object-cover">
                    @elseif(Auth::user()->avatar && str_starts_with(Auth::user()->avatar, 'http'))
                        <img src="{{ Auth::user()->avatar }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-primary flex items-center justify-center text-white text-4xl font-bold">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </div>
                    @endif
                </template>
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" @click="$refs.photoInput.click()">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            <div class="pt-2">
                <h4 class="font-bold text-gray-900 text-lg">Foto Profile</h4>
                <p class="text-sm text-gray-500 mb-4 max-w-xs">Pilih foto terbaik Anda. Format yang didukung: JPG, PNG. Ukuran maksimal 2MB.</p>
                <input type="file" name="avatar" x-ref="photoInput" @change="fileChosen" class="hidden" accept="image/jpeg, image/png, image/jpg">
                <button type="button" @click="$refs.photoInput.click()" class="px-5 py-2.5 bg-white border-2 border-gray-200 text-gray-700 text-sm font-bold rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-colors">
                    Upload Foto Baru
                </button>
            </div>
        </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="telepon" value="{{ old('telepon', Auth::user()->telepon) }}" placeholder="Contoh: 081234567890" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
                    </div>
                </div>

                @if(Auth::user()->role === 'siswa')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Umur</label>
                        <input type="number" name="umur" value="{{ old('umur', Auth::user()->umur) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas', Auth::user()->kelas) }}" placeholder="Contoh: XII IPA 1" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
                    </div>
                </div>
                @endif

        <h3 class="text-xl font-bold text-gray-900 mb-8 mt-12 border-b border-gray-100 pb-4">Keamanan Akun</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru (Optional)</label>
                <input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru" class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none bg-gray-50 focus:bg-white">
            </div>
        </div>

        <div class="flex justify-end pt-8 border-t border-gray-100">
            <button type="submit" class="w-full md:w-auto px-10 py-4 bg-gradient-primary text-white rounded-xl font-bold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-0.5 transition-all duration-300">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <!-- Crop Modal -->
    <div x-show="showCropModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-sm" x-cloak>
        <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-lg mx-4" @click.away="cancelCrop()">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Atur Foto Profile</h3>
            <div class="w-full bg-gray-100 rounded-xl overflow-hidden" style="max-height: 400px;">
                <img id="crop-image" :src="cropImageSrc" class="max-w-full">
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" @click="cancelCrop()" class="px-5 py-2 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                <button type="button" @click="saveCrop()" class="px-5 py-2 bg-primary text-white font-bold rounded-xl shadow-md shadow-red-500/30 hover:shadow-lg hover:bg-red-700 transition-all">Simpan Foto</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imagePreview', () => ({
            imageUrl: null,
            croppedBase64: null,
            cropper: null,
            showCropModal: false,
            cropImageSrc: '',
            
            fileChosen(event) {
                if (! event.target.files.length) return;
                let file = event.target.files[0];
                if (!file.type.match('image.*')) return;
                
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => {
                    this.cropImageSrc = e.target.result;
                    this.showCropModal = true;
                    
                    setTimeout(() => {
                        if (this.cropper) {
                            this.cropper.destroy();
                        }
                        const imageElement = document.getElementById('crop-image');
                        this.cropper = new Cropper(imageElement, {
                            aspectRatio: 1,
                            viewMode: 1,
                            dragMode: 'move',
                            autoCropArea: 1,
                            restore: false,
                            guides: true,
                            center: true,
                            highlight: false,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                        });
                    }, 100);
                };
            },
            
            saveCrop() {
                if (!this.cropper) return;
                
                const canvas = this.cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                });
                
                this.croppedBase64 = canvas.toDataURL('image/jpeg', 0.9);
                this.imageUrl = this.croppedBase64;
                this.showCropModal = false;
                
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
            },
            
            cancelCrop() {
                this.showCropModal = false;
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
                this.$refs.photoInput.value = '';
            }
        }))
    })
</script>
@endpush
