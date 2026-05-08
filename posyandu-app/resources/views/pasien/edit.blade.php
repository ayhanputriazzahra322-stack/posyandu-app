@extends('layouts.app')

@section('title','Edit Pasien')

@section('content')

<div class="container">
    <h3 class="mb-4">Edit Data Pasien</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $pasien->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control"
                        value="{{ old('nik', $pasien->nik) }}" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control"
                        value="{{ old('no_hp', $pasien->no_hp) }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection