<!DOCTYPE html>
<html>
<head>
    <title>Laporan Obat</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

<h3>Laporan Obat & Stok</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Total Dipakai</th>
            <th>Stok Saat Ini</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $d->nama_obat }}</td>
            <td class="text-center">{{ $d->total_pakai }}</td>
            <td class="text-center">{{ $d->stok }}</td>
            <td class="text-center">
                @if($d->stok <= 0)
                    Habis
                @elseif($d->stok <= 5)
                    Menipis
                @else
                    Aman
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>