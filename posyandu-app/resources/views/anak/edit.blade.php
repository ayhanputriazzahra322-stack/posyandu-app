@extends('layouts.app')

@section('title','Edit Data Anak')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 fw-bold text-primary">
                Edit Data Anak
            </h4>

            <a href="{{ route('anak.index') }}" class="btn btn-secondary mb-3">
                ← Kembali
            </a>

            <form action="{{ route('anak.update', $anak->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Anak</label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $anak->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Ibu</label>
                    <select name="ibu_id" class="form-control" required>
                        <option value="">-- Pilih Ibu --</option>
                        @foreach($ibu as $i)
                            <option value="{{ $i->id }}"
                                {{ old('ibu_id', $anak->ibu_id) == $i->id ? 'selected' : '' }}>
                                {{ $i->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir', $anak->tanggal_lahir) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Umur</label>
                    <input type="number" name="umur" class="form-control"
                        value="{{ old('umur', $anak->umur) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="L"
                            {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="P"
                            {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('anak.index') }}" class="btn btn-secondary">
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