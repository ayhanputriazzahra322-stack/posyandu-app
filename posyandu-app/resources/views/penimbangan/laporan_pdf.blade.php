<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penimbangan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .kop {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .kop p {
            margin: 2px 0;
            font-size: 12px;
        }

        .judul {
            text-align: center;
            margin-bottom: 15px;
        }

        .judul h3 {
            margin: 0;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .info {
            margin-bottom: 15px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 3px 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data th {
            background-color: #f2f2f2;
            text-align: center;
        }

        table.data th, 
        table.data td {
            border: 1px solid #000;
            padding: 6px;
        }

        .text-center {
            text-align: center;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
        }

        .ttd td {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Kop Surat -->
    <div class="kop">
        <h2>POSYANDU</h2>
        <p>Desa / Kelurahan</p>
        <p>Kecamatan - Kabupaten</p>
    </div>

    <!-- Judul -->
    <div class="judul">
        <h3>Laporan Penimbangan Anak</h3>
    </div>

    <!-- Info -->
    <div class="info">
        <table>
            <tr>
                <td width="150">Nama Anak</td>
                <td width="10">:</td>
                <td>{{ $anak->nama }}</td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td>
                    {{ $bulanAwal->format('d-m-Y') }} s/d {{ $bulanAkhir->format('d-m-Y') }}
                </td>
            </tr>
            <tr>
                <td>Tanggal Cetak</td>
                <td>:</td>
                <td>{{ date('d-m-Y') }}</td>
            </tr>
        </table>
    </div>

    <!-- Tabel -->
    <table class="data">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Nama Anak</th>
                <th>Berat (Kg)</th>
                <th>Tinggi (Cm)</th>
                <th width="120">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $d->anak->nama ?? '-' }}</td>
                    <td class="text-center">{{ $d->berat }}</td>
                    <td class="text-center">{{ $d->tinggi }}</td>
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

    <!-- Tanda tangan -->
    <table class="ttd">
        <tr>
            <td width="60%"></td>
            <td>
                {{ date('d-m-Y') }}<br>
                Petugas Posyandu
                <br><br><br>
                _____________________
            </td>
        </tr>
    </table>

</body>
</html>