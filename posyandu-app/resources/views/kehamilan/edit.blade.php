@extends('layouts.app')

@section('title','Edit Data Kehamilan')

@section('content')

<div class="card">
    <div class="card-header">
        Edit Data Kehamilan
    </div>

    <div class="card-body">
        <form action="{{ route('kehamilan.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Ibu</label>
                <select name="ibu_id" class="form-control" required>
                    <option value="">-- Pilih Ibu --</option>
                    @foreach($ibu as $i)
                        <option value="{{ $i->id }}" 
                            {{ $data->ibu_id == $i->id ? 'selected' : '' }}>
                            {{ $i->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Usia Kehamilan</label>
                <input type="number" 
                       name="usia_kehamilan" 
                       class="form-control" 
                       value="{{ $data->usia_kehamilan }}" 
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" 
                          class="form-control" 
                          rows="3" 
                          required>{{ $data->keterangan }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pemeriksaan</label>
                <input type="date" 
                       name="tanggal" 
                       class="form-control" 
                       value="{{ $data->tanggal }}" 
                       required>
            </div>

            <button type="submit" class="btn btn-success">
                Update
            </button>

            <a href="{{ route('kehamilan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>

@endsection