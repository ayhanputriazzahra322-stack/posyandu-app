<!DOCTYPE html>
<html>
<head>
    <title>Data Keuangan</title>
    <style>
        body { font-family: sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>

<h3>Data Keuangan</h3>

<table>
    <tr>
        <th>No</th>
        <th>Pasien</th>
        <th>Tanggal</th>
        <th>Metode</th>
        <th>Total</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->rekamMedis->pasien->nama ?? '-' }}</td>
        <td>{{ $d->rekamMedis->tanggal ?? '-' }}</td>
        <td>{{ strtoupper($d->metode) }}</td>
        <td>Rp {{ number_format($d->total_bayar ?? 0, 0, ',', '.') }}</td>
    </tr>
    @endforeach

</table>

</body>
</html>