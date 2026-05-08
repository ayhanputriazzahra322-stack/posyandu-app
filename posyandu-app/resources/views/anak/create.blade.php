@extends('layouts.app')

@section('title','Tambah Data Anak')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 fw-bold text-primary">
                Tambah Data Anak
            </h4>

            <a href="{{ route('anak.index') }}" class="btn btn-secondary mb-3">
                ← Kembali
            </a>

            <form action="{{ route('anak.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Anak</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

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
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Umur</label>
                    <input type="number" name="umur" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

@endsection