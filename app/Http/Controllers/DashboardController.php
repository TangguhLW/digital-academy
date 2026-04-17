<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $totalPengaduan = Pengaduan::count();
            $menunggu = Pengaduan::where('status', 'pending')->count();
            $proses = Pengaduan::where('status', 'diproses')->count();
            $selesai = Pengaduan::where('status', 'selesai')->count();
        } else {
            // User biasa tetap bisa lihat dashboard dengan statistik pengaduan mereka sendiri
            $totalPengaduan = $user->pengaduan()->count();
            $menunggu = $user->pengaduan()->where('status', 'pending')->count();
            $proses = $user->pengaduan()->where('status', 'diproses')->count();
            $selesai = $user->pengaduan()->where('status', 'selesai')->count();
        }
        
        return view('dashboard', compact('totalPengaduan', 'menunggu', 'proses', 'selesai'));
    }
}
