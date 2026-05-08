@extends('layouts.app')

@section('title','Laporan Obat')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-3 fw-bold text-primary">
                Laporan Obat & Stok
            </h4>

            {{-- 🔥 TOMBOL EXPORT --}}
            <div class="mb-3">
                <a href="{{ route('obat.laporan.excel') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>

                <a href="{{ route('obat.laporan.pdf') }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Total Dipakai</th>
                        <th>Stok Saat Ini</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $d->nama_obat }}</td>
                        <td class="text-center">
                            <span class="badge bg-success fs-6">
                                {{ $d->total_pakai ?? 0 }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{ $d->stok ?? 0 }}
                        </td>
                        <td class="text-center">
                            @if(($d->stok ?? 0) <= 0)
                                <span class="badge bg-danger">Habis</span>
                            @elseif(($d->stok ?? 0) <= 5)
                                <span class="badge bg-warning text-dark">Menipis</span>
                            @else
                                <span class="badge bg-primary">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Data belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection