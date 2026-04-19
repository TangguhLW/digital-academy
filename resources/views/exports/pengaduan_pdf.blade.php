<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengaduan Siswa</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        .info {
            margin-bottom: 20px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
        .page-number:before {
            content: "Halaman " counter(page);
        }
        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 10px;
            text-transform: uppercase;
        }
        .status-pending { background-color: #fef08a; color: #854d0e; }
        .status-diproses { background-color: #bfdbfe; color: #1e40af; }
        .status-selesai { background-color: #bbf7d0; color: #166534; }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="title">Laporan Pengaduan Siswa</h1>
        <div class="subtitle">Data pengaduan, aspirasi, dan permintaan informasi</div>
    </div>

    <div class="info">
        <p><strong>Tanggal Export:</strong> {{ \Carbon\Carbon::now()->format('d F Y H:i') }}</p>
        <p><strong>Oleh:</strong> {{ auth()->user()->nama }} ({{ ucfirst(auth()->user()->role) }})</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Judul</th>
                <th width="30%">Deskripsi</th>
                <th width="15%">Kategori</th>
                <th width="10%">Tanggal</th>
                <th width="10%">Status</th>
                <th width="15%">Nama</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ Str::limit($item->isi_laporan, 100) }}</td>
                <td>{{ ucfirst($item->klasifikasi) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_lapor)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge status-{{ $item->status }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td>
                    @php
                        $namaPelapor = $item->user ? $item->user->nama : 'Tidak Diketahui';
                        if ($item->is_anonim) {
                            $namaPelapor = auth()->user()->role === 'admin' ? $namaPelapor . ' (Anonim)' : 'Anonim';
                        }
                    @endphp
                    {{ $namaPelapor }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ count($pengaduan) }}</p>
    </div>

</body>
</html>
