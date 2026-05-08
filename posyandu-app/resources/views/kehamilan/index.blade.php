@extends('layouts.app')

@section('title','Data Kehamilan')

@section('content')

<a href="{{ route('kehamilan.create') }}" class="btn btn-primary mb-3">
    + Tambah Data Kehamilan
</a>

{{-- FORM CETAK PDF --}}
<div class="card mb-3">
    <div class="card-header">
        Cetak Laporan Pemeriksaan Kehamilan
    </div>
    <div class="card-body">
        <form action="{{ route('kehamilan.laporan.pdf') }}" method="GET" class="row g-2">

            <div class="col-md-4">
                <label class="form-label">Nama Ibu</label>
                <select name="ibu_id" class="form-control" required>
                    <option value="">-- Pilih Nama Ibu --</option>
                    @foreach($data->pluck('ibu')->unique('id')->filter() as $ibu)
                        <option value="{{ $ibu->id }}">{{ $ibu->nama }}</option>
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
                    <i class="fas fa-file-pdf"></i> Cetak PDF
                </button>
            </div>

        </form>
    </div>
</div>

{{-- notifikasi sukses --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Ibu</th>
            <th>Usia Kehamilan</th>
            <th>Keterangan</th>
            <th>Tanggal Pemeriksaan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->ibu->nama ?? '-' }}</td>
            <td>{{ $d->usia_kehamilan }} minggu</td>
            <td>{{ $d->keterangan }}</td>
            <td>{{ $d->tanggal }}</td>
            <td>

                <a href="{{ route('kehamilan.edit',$d->id) }}" 
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('kehamilan.destroy',$d->id) }}" 
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
        @endforeach
    </tbody>
</table>

@endsection