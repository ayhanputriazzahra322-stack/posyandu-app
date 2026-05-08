@extends('layouts.app')

@section('title','Tambah Data Kehamilan')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 fw-bold text-primary">
                Tambah Data Kehamilan
            </h4>

            <a href="{{ route('kehamilan.index') }}" class="btn btn-secondary mb-3">
                ← Kembali
            </a>

            <form action="{{ route('kehamilan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ibu</label>
                    <select name="ibu_id" class="form-control" required>
                        <option value="">-- Pilih Ibu --</option>
                        @foreach($ibu as $i)
                            <option value="{{ $i->id }}">{{ $i->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Usia Kehamilan (minggu)</label>
                    <input type="number" name="usia_kehamilan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Pemeriksaan</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection