@extends('layouts.app')

@section('title','Edit Obat')

@section('content')

<div class="container">
    <h3 class="mb-4">Edit Data Obat</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control"
                        value="{{ old('nama_obat', $obat->nama_obat) }}" required>
                </div>

                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control"
                        value="{{ old('stok', $obat->stok) }}" required>
                </div>

                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control"
                        value="{{ old('harga', $obat->harga) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection