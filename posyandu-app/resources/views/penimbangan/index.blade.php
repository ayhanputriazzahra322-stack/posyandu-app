@extends('layouts.app')

@section('title','Data Penimbangan')

@section('content')

@php
    $anakList = \App\Models\Anak::orderBy('nama','asc')->get();
@endphp

<a href="{{ route('penimbangan.create') }}" class="btn btn-primary mb-3">
    + Tambah Data Penimbangan
</a>

{{-- 🔥 TAMBAHAN FORM LAPORAN --}}
<div class="card mb-3">
    <div class="card-header">
        Cetak Laporan Penimbangan
    </div>
    <div class="card-body">
        <form action="{{ route('penimbangan.laporan.pdf') }}" method="GET" class="row g-2">

            <div class="col-md-4">
                <label>Nama Anak</label>
                <select name="anak_id" class="form-control" required>
                    <option value="">-- Pilih Anak --</option>
                    @foreach($anakList as $anak)
                        <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Bulan Awal</label>
                <input type="month" name="bulan_awal" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label>Bulan Akhir</label>
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
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Anak</th>
            <th>Berat Badan</th>
            <th>Tinggi Badan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->anak->nama ?? '-' }}</td>
            <td>{{ $d->berat }} kg</td>
            <td>{{ $d->tinggi }} cm</td>
            <td>{{ $d->tanggal }}</td>
            <td>

                <a href="{{ route('penimbangan.edit',$d->id) }}" 
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('penimbangan.destroy',$d->id) }}" 
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
            <td colspan="6" class="text-center">
                Belum ada data penimbangan
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection