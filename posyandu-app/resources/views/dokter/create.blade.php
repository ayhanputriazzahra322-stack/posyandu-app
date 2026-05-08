@extends('layouts.app')

@section('title','Tambah Dokter')

@section('content')

<div class="container">
    <h3 class="mb-4">Tambah Dokter</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('dokter.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Dokter</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Spesialis</label>
                    <input type="text" name="spesialis" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dokter.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection