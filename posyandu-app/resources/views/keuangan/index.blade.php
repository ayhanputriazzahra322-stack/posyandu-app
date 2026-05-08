@extends('layouts.app')

@section('title','Data Keuangan')

@section('content')

<h4>Data Keuangan / Pembayaran</h4>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-header">
        Form Pembayaran
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('keuangan.store') }}">
            @csrf

            <div class="mb-3">
                <label>Rekam Medis</label>
                <select name="rekam_medis_id" class="form-control" required>
                    <option value="">-- Pilih Rekam Medis --</option>
                    @foreach($rekam as $r)
                        <option value="{{ $r->id }}">
                            {{ $r->pasien->nama ?? '-' }} - {{ $r->tanggal }} - Total: Rp {{ number_format($r->total ?? 0, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Metode Pembayaran</label>
                <select name="metode" class="form-control" required>
                    <option value="tunai">Tunai</option>
                    <option value="bpjs">BPJS</option>
                </select>
            </div>

            <button class="btn btn-success">
                Bayar
            </button>
        </form>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Riwayat Pembayaran</h5>

    <div>
        <a href="{{ route('keuangan.export.excel') }}" class="btn btn-success btn-sm">
            Export Excel
        </a>

        <a href="{{ route('keuangan.export.pdf') }}" class="btn btn-danger btn-sm">
            Export PDF
        </a>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Tanggal</th>
            <th>Metode</th>
            <th>Total Bayar</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->rekamMedis->pasien->nama ?? '-' }}</td>
            <td>{{ $d->rekamMedis->tanggal ?? '-' }}</td>
            <td>{{ strtoupper($d->metode) }}</td>
            <td>Rp {{ number_format($d->total_bayar ?? 0, 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('keuangan.destroy', $d->id) }}" 
                      method="POST" 
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus pembayaran ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">
                Belum ada pembayaran
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection