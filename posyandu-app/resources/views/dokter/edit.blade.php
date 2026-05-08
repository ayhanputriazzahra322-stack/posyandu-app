@extends('layouts.app')

@section('title','Edit Dokter')

@section('content')

<div class="container">
    <h4 class="mb-4">Edit Dokter</h4>

    <form action="{{ route('dokter.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Dokter</label>
            <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Spesialis</label>
            <input type="text" name="spesialis" class="form-control" value="{{ $data->spesialis }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $data->no_hp }}" required>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection