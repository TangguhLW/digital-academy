<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PengaduanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $pengaduan;

    public function __construct($pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    public function collection()
    {
        return $this->pengaduan;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Kategori',
            'Deskripsi',
            'Tanggal Lapor',
            'Status',
            'Nama Pelapor'
        ];
    }

    public function map($pengaduan): array
    {
        // Admin gets actual name but indicated as anonymized if the app logic is required?
        // Wait, the rule says "admin tetap bisa melihat data asli jika diperlukan". 
        // For exports, let's strictly follow: "jika anonim aktif maka tampilkan 'Anonim'". If admin needs real name, we can format it as "Real Name (Anonim)"
        
        $namaPelapor = $pengaduan->user ? $pengaduan->user->nama : 'Tidak Diketahui';
        if ($pengaduan->is_anonim) {
            $namaPelapor = auth()->user()->role === 'admin' ? $namaPelapor . ' (Anonim)' : 'Anonim';
        }

        return [
            $pengaduan->id,
            $pengaduan->judul,
            ucfirst($pengaduan->klasifikasi),
            $pengaduan->isi_laporan,
            \Carbon\Carbon::parse($pengaduan->tanggal_lapor)->format('d M Y'),
            strtoupper($pengaduan->status),
            $namaPelapor,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
