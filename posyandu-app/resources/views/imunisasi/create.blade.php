@extends('layouts.app')

@section('title','Tambah Imunisasi')

@section('content')

<div class="container">

    <a href="{{ route('imunisasi.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <form action="{{ route('imunisasi.store') }}" method="POST">
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
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Imunisasi</label>
            <input type="text" name="jenis_imunisasi" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>

@endsection