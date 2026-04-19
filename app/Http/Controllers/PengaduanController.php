<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\PengaduanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class PengaduanController extends Controller
{
    private function getFilterData(Request $request)
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
            return $query->latest()->get();
        } else {
            return $query->where('id_user', Auth::id())->latest()->get();
        }
    }

    public function index(Request $request)
    {
        $pengaduan = $this->getFilterData($request);
        return view('pengaduan.index', compact('pengaduan'));
    }

    public function exportIndex(Request $request)
    {
        return view('pengaduan.export');
    }

    public function exportPdf(Request $request)
    {
        return view('pengaduan.export-fallback');
    }

    public function exportExcel(Request $request)
    {
        return view('pengaduan.export-fallback');
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
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:51200',
            'is_anonim' => 'nullable|boolean',
        ]);

        $validated['id_user'] = Auth::id();
        $validated['status'] = 'pending';
        $validated['tanggal_lapor'] = now();
        $validated['is_anonim'] = $request->has('is_anonim') ? true : false;

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('pengaduan_video', 'public');
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
            'hasil_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hasil_video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:51200',
        ]);

        if ($request->hasFile('hasil_foto')) {
            if ($pengaduan->hasil_foto) {
                Storage::disk('public')->delete($pengaduan->hasil_foto);
            }
            $validated['hasil_foto'] = $request->file('hasil_foto')->store('pengaduan_hasil', 'public');
        }

        if ($request->hasFile('hasil_video')) {
            if ($pengaduan->hasil_video) {
                Storage::disk('public')->delete($pengaduan->hasil_video);
            }
            $validated['hasil_video'] = $request->file('hasil_video')->store('pengaduan_hasil_video', 'public');
        }

        $pengaduan->update($validated);

        return back()->with('success', 'Status pengaduan dan hasil berhasil diupdate!');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        if (Auth::user()->role !== 'admin' && $pengaduan->id_user !== Auth::id()) {
            abort(403);
        }

        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        if ($pengaduan->video) {
            Storage::disk('public')->delete($pengaduan->video);
        }

        if ($pengaduan->hasil_foto) {
            Storage::disk('public')->delete($pengaduan->hasil_foto);
        }

        if ($pengaduan->hasil_video) {
            Storage::disk('public')->delete($pengaduan->hasil_video);
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus!');
    }
}
