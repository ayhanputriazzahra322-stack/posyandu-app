@extends('layouts.app')

@section('title','Tambah Data Obat')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 fw-bold text-primary">
                Tambah Data Obat
            </h4>

            <a href="{{ route('obat.index') }}" class="btn btn-secondary mb-3">
                ← Kembali
            </a>

            <form action="{{ route('obat.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection