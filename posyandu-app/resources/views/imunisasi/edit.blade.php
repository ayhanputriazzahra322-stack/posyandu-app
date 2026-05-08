@extends('layouts.app')

@section('title','Edit Imunisasi')

@section('content')

<div class="container">

    <a href="{{ route('imunisasi.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <form action="{{ route('imunisasi.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Anak</label>
            <select name="anak_id" class="form-control" required>
                <option value="">-- Pilih Anak --</option>
                @foreach($anak as $a)
                    <option value="{{ $a->id }}" {{ $data->anak_id == $a->id ? 'selected' : '' }}>
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                value="{{ $data->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Imunisasi</label>
            <input type="text" name="jenis_imunisasi" class="form-control"
                value="{{ $data->jenis_imunisasi }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection