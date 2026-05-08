@extends('layouts.app')

@section('title','Data Rekam Medis')

@section('content')

{{-- ALERT --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<a href="{{ route('rekam-medis.create') }}" class="btn btn-primary mb-3">
    + Tambah Rekam Medis
</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark text-center">
        <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Tanggal</th>
            <th>Obat</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Metode</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $d->pasien->nama ?? '-' }}</td>
            <td>{{ $d->dokter->nama ?? '-' }}</td>
            <td>{{ $d->tanggal ?? '-' }}</td>
            <td>{{ $d->obat->nama_obat ?? '-' }}</td>
            <td class="text-center">{{ $d->qty ?? 0 }}</td>
            <td>Rp {{ number_format($d->harga ?? 0, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($d->total ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">{{ strtoupper($d->metode ?? '-') }}</td>
            <td class="text-center">
                <a href="{{ route('rekam-medis.edit', $d->id) }}" 
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('rekam-medis.destroy', $d->id) }}" 
                      method="POST" 
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center text-muted">
                Belum ada data rekam medis
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection