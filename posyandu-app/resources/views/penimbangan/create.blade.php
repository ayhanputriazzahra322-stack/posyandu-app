@extends('layouts.app')

@section('title','Tambah Data Penimbangan')

@section('content')

<h4>Tambah Data Penimbangan</h4>

<a href="{{ route('penimbangan.index') }}" class="btn btn-secondary mb-3">
    ← Kembali
</a>

<form action="{{ route('penimbangan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Anak</label>
        <select name="anak_id" class="form-control" required>
            <option value="">-- Pilih Anak --</option>
            @foreach($anak as $a)
                <option value="{{ $a->id }}">{{ $a->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Berat Badan (kg)</label>
        <input type="number" name="berat" class="form-control" step="0.1" required>
    </div>

    <div class="mb-3">
        <label>Tinggi Badan (cm)</label>
        <input type="number" name="tinggi" class="form-control" step="0.1" required>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</form>

@endsection