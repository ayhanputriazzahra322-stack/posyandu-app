<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemeriksaan Kehamilan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2,
        .header h4 {
            margin: 0;
        }

        .info {
            margin-bottom: 15px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 4px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #1e293b;
            color: white;
            padding: 8px;
            border: 1px solid #000;
        }

        .data-table td {
            padding: 7px;
            border: 1px solid #000;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
            text-align: right;
        }

        .ttd {
            margin-top: 60px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN HASIL PEMERIKSAAN KEHAMILAN</h2>
        <h4>POSYANDU</h4>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="160"><strong>Nama Ibu</strong></td>
                <td>: {{ $ibu->nama }}</td>
            </tr>
            <tr>
                <td><strong>Periode Laporan</strong></td>
                <td>
                    :
                    {{ $bulanAwal->format('d-m-Y') }}
                    s/d
                    {{ $bulanAkhir->format('d-m-Y') }}
                </td>
            </tr>
            <tr>
                <td><strong>Tanggal Cetak</strong></td>
                <td>: {{ date('d-m-Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="35">No</th>
                <th>Nama Ibu</th>
                <th width="110">Usia Kehamilan</th>
                <th>Keterangan</th>
                <th width="120">Tanggal Pemeriksaan</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $d)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $d->ibu->nama ?? '-' }}</td>
                    <td class="text-center">{{ $d->usia_kehamilan }} minggu</td>
                    <td>{{ $d->keterangan }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Data pemeriksaan tidak ditemukan pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Petugas Posyandu</p>

        <div class="ttd">
            <p>________________________</p>
        </div>
    </div>

</body>
</html>