<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function store(Request $request, Pengaduan $pengaduan)
    {
        // Both admin and user can reply
        // But user can only reply to their own pengaduan
        if (Auth::user()->role !== 'admin' && $pengaduan->id_user !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'isi_tanggapan' => 'required|string',
        ]);

        $pengaduan->tanggapans()->create([
            'user_id' => Auth::id(),
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        // Optional feature: Automatically change status to 'diproses' if admin replies and status is pending
        if (Auth::user()->role === 'admin' && $pengaduan->status === 'pending') {
            $pengaduan->update(['status' => 'diproses']);
        }

        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}
