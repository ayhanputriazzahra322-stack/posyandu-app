<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penimbangan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 15px;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #333;
            color: white;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN PENIMBANGAN ANAK</h2>
        <p>Posyandu</p>
    </div>

    <div class="info">
        <p><strong>Nama Anak:</strong> {{ $anak->nama }}</p>
        <p>
            <strong>Periode:</strong>
            {{ $bulanAwal->format('d-m-Y') }} s/d {{ $bulanAkhir->format('d-m-Y') }}
        </p>
        <p><strong>Tanggal Cetak:</strong> {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Anak</th>
                <th>Berat Badan</th>
                <th>Tinggi Badan</th>
                <th width="120">Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $d)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $d->anak->nama ?? '-' }}</td>
                    <td class="text-center">{{ $d->berat }} kg</td>
                    <td class="text-center">{{ $d->tinggi }} cm</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Data tidak ditemukan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Petugas Posyandu</p>
        <br><br>
        <p>_____________________</p>
    </div>

</body>
</html>