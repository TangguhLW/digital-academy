@extends('layouts.app')

@section('title', 'Dashboard - SPS Modern')
@section('page-title', Auth::user()->role === 'admin' ? 'Dashboard Admin' : 'Dashboard Saya')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<!-- Welcome Message -->
<div class="relative overflow-hidden bg-gradient-primary rounded-2xl p-8 mb-8 text-white shadow-xl shadow-red-500/20 group">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
    
    <div class="relative z-10">
        <h2 class="text-3xl font-bold font-heading mb-2 tracking-tight flex items-center gap-2">
            Selamat Datang, {{ Auth::user()->nama }}!
            <svg class="w-8 h-8 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
        </h2>
        <p class="text-red-100 text-lg max-w-2xl font-light">
            @if(Auth::user()->role === 'admin')
                Pantau statistik, kelola pengaduan, dan berikan respon terbaik untuk siswa dengan mudah hari ini.
            @else
                Pantau progres pengaduan Anda, sampaikan aspirasi, dan bantu kami menciptakan lingkungan sekolah yang lebih baik.
            @endif
        </p>
    </div>
</div>

<!-- Quick Actions -->
<div class="flex flex-wrap gap-4 mb-8">
    <a href="{{ route('pengaduan.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-surface border border-gray-200 text-text-primary rounded-xl font-semibold shadow-sm hover:border-red-200 hover:bg-red-50 hover:text-primary transition-all duration-300 hover:-translate-y-1">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        {{ Auth::user()->role === 'admin' ? 'Kelola Semua Pengaduan' : 'Riwayat Pengaduan Saya' }}
    </a>
    @if(Auth::user()->role !== 'admin')
    <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-gradient-primary text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
        <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        <span class="relative z-10">Buat Pengaduan Baru</span>
    </a>
    @endif
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Pengaduan -->
    <div class="bg-surface rounded-2xl p-6 border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgba(220,38,38,0.08)] transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        <div class="relative z-10 flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
        <h3 class="text-sm font-semibold text-text-secondary uppercase tracking-wider mb-1 relative z-10">
            {{ Auth::user()->role === 'admin' ? 'Total Pengaduan' : 'Total Pengaduan Saya' }}
        </h3>
        <div class="text-4xl font-bold font-heading text-text-primary relative z-10">{{ $totalPengaduan }}</div>
    </div>

    <!-- Menunggu -->
    <div class="bg-surface rounded-2xl p-6 border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgba(245,158,11,0.08)] transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        <div class="relative z-10 flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <h3 class="text-sm font-semibold text-text-secondary uppercase tracking-wider mb-1 relative z-10">Pending</h3>
        <div class="text-4xl font-bold font-heading text-text-primary relative z-10">{{ $menunggu }}</div>
    </div>

    <!-- Proses -->
    <div class="bg-surface rounded-2xl p-6 border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgba(59,130,246,0.08)] transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        <div class="relative z-10 flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
        <h3 class="text-sm font-semibold text-text-secondary uppercase tracking-wider mb-1 relative z-10">Diproses</h3>
        <div class="text-4xl font-bold font-heading text-text-primary relative z-10">{{ $proses }}</div>
    </div>

    <!-- Selesai -->
    <div class="bg-surface rounded-2xl p-6 border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgba(16,185,129,0.08)] transition-all duration-300 group hover:-translate-y-1 relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 z-0"></div>
        <div class="relative z-10 flex items-start justify-between mb-4">
            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <h3 class="text-sm font-semibold text-text-secondary uppercase tracking-wider mb-1 relative z-10">Selesai</h3>
        <div class="text-4xl font-bold font-heading text-text-primary relative z-10">{{ $selesai }}</div>
    </div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Line Chart -->
    <div class="lg:col-span-2 bg-surface rounded-2xl p-6 border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold font-heading text-text-primary">Tren Pengaduan</h3>
            <div class="flex bg-gray-50 p-1 rounded-xl">
                <button class="px-4 py-1.5 text-sm font-semibold bg-white text-primary rounded-lg shadow-sm">7 Hari</button>
            </div>
        </div>
        <div class="h-[300px] w-full">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <!-- Doughnut Chart -->
    <div class="bg-surface rounded-2xl p-6 border border-gray-100 shadow-[0_8px_30px_rgba(0,0,0,0.04)]">
        <h3 class="text-lg font-bold font-heading text-text-primary mb-6">Distribusi Status</h3>
        <div class="h-[250px] w-full flex items-center justify-center relative">
            <canvas id="doughnutChart"></canvas>
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <span class="text-3xl font-bold text-text-primary">{{ $totalPengaduan }}</span>
                <span class="text-xs text-text-secondary uppercase font-semibold">Total</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#6B7280';
    
    // Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    
    // Create gradient for line chart
    const gradientFill = lineCtx.createLinearGradient(0, 0, 0, 300);
    gradientFill.addColorStop(0, 'rgba(220, 38, 38, 0.2)');
    gradientFill.addColorStop(1, 'rgba(220, 38, 38, 0)');

    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: [4, 6, 3, 8, 5, 2, 7], // Mock data for better visual
                borderColor: '#DC2626',
                backgroundColor: gradientFill,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#FFFFFF',
                pointBorderColor: '#DC2626',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#DC2626',
                pointHoverBorderColor: '#FFFFFF',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111827',
                    padding: 12,
                    titleFont: { size: 13, family: "'Inter', sans-serif" },
                    bodyFont: { size: 14, weight: 'bold' },
                    displayColors: false,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#F3F4F6',
                        drawBorder: false,
                    },
                    border: { display: false },
                    ticks: { padding: 10 }
                },
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { padding: 10 }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
        }
    });

    // Doughnut Chart
    const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    
    // Prevent rendering if all data is 0
    let chartData = [{{ $menunggu }}, {{ $proses }}, {{ $selesai }}];
    if (chartData[0] === 0 && chartData[1] === 0 && chartData[2] === 0) {
        chartData = [1]; // Fallback to show empty grey donut
    }

    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Diproses', 'Selesai'],
            datasets: [{
                data: chartData.length === 1 && chartData[0] === 1 ? [1] : [{{ $menunggu }}, {{ $proses }}, {{ $selesai }}],
                backgroundColor: chartData.length === 1 && chartData[0] === 1 ? ['#F3F4F6'] : ['#F59E0B', '#3B82F6', '#10B981'],
                borderWidth: 0,
                hoverOffset: 4,
                cutout: '75%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { size: 12, weight: '500' }
                    }
                },
                tooltip: {
                    enabled: !(chartData.length === 1 && chartData[0] === 1),
                    backgroundColor: '#111827',
                    padding: 12,
                    cornerRadius: 8,
                }
            }
        }
    });
</script>
@endpush
