@extends('layouts.app')

@section('title','Data Imunisasi')

@section('content')

@php
    $anakList = \App\Models\Anak::orderBy('nama', 'asc')->get();
@endphp

<div class="container">

    <a href="{{ route('imunisasi.create') }}" class="btn btn-primary mb-3">
        + Tambah Imunisasi
    </a>

    <div class="card mb-3">
        <div class="card-header">
            Cetak Laporan Imunisasi
        </div>

        <div class="card-body">
            <form action="{{ route('imunisasi.laporan.pdf') }}" method="GET" class="row g-2">

                <div class="col-md-4">
                    <label class="form-label">Nama Anak</label>
                    <select name="anak_id" class="form-control" required>
                        <option value="">-- Pilih Anak --</option>
                        @foreach($anakList as $anak)
                            <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Bulan Awal</label>
                    <input type="month" name="bulan_awal" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Bulan Akhir</label>
                    <input type="month" name="bulan_akhir" class="form-control" required>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-file-pdf"></i> Cetak
                    </button>
                </div>

            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>Tanggal</th>
                <th>Jenis Imunisasi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $imunisasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $imunisasi->anak->nama ?? '-' }}</td>
                    <td>{{ $imunisasi->tanggal }}</td>
                    <td>{{ $imunisasi->jenis_imunisasi }}</td>
                    <td>
                        <a href="{{ route('imunisasi.edit', $imunisasi->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('imunisasi.destroy', $imunisasi->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data imunisasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection