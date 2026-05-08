@extends('layouts.app')

@section('title','Riwayat Obat Pasien')

@section('content')

<div class="container">
    <h4 class="mb-3">Riwayat Obat: {{ $pasien->nama }}</h4>

    <a href="{{ route('pasien.index') }}" class="btn btn-secondary mb-3">
        Kembali
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Dokter</th>
                <th>Obat</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Metode</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->tanggal ?? '-' }}</td>
                <td>{{ $d->dokter->nama ?? '-' }}</td>
                <td>{{ $d->obat->nama_obat ?? '-' }}</td>
                <td>{{ $d->qty ?? 0 }}</td>
                <td>Rp {{ number_format($d->harga ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($d->total ?? 0, 0, ',', '.') }}</td>
                <td>{{ strtoupper($d->metode ?? '-') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">
                    Belum ada riwayat obat
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection