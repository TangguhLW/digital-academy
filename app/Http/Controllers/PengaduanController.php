<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('user');
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi_laporan', 'like', "%{$search}%");
            });
        }
        
        // Filter by date range
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_kejadian', '>=', $request->tanggal_dari);
        }
        
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_kejadian', '<=', $request->tanggal_sampai);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if (Auth::user()->role === 'admin') {
            $pengaduan = $query->latest()->get();
        } else {
            $pengaduan = $query->where('id_user', Auth::id())->latest()->get();
        }
        
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'klasifikasi' => 'required|in:pengaduan,aspirasi,permintaan_informasi',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string|min:20',
            'tanggal_kejadian' => 'required|date|before_or_equal:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_anonim' => 'nullable|boolean',
        ]);

        $validated['id_user'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['tanggal_lapor'] = now();
        $validated['is_anonim'] = $request->has('is_anonim') ? true : false;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create($validated);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function show(Pengaduan $pengaduan)
    {
        if (Auth::user()->role !== 'admin' && $pengaduan->id_user !== Auth::id()) {
            abort(403);
        }

        $pengaduan->load(['tanggapans.user']);

        return view('pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $pengaduan->update($validated);

        return back()->with('success', 'Status pengaduan berhasil diupdate!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if (Auth::user()->role !== 'admin' && $pengaduan->id_user !== Auth::id()) {
            abort(403);
        }

        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}
