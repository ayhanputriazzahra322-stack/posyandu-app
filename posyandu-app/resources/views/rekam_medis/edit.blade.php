@extends('layouts.app')

@section('title','Edit Rekam Medis')

@section('content')

<h4>Edit Rekam Medis</h4>

<form method="POST" action="{{ route('rekam-medis.update', $data->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Pasien</label>
    <select name="pasien_id" class="form-control">
        @foreach($pasien as $p)
            <option value="{{ $p->id }}" {{ $data->pasien_id == $p->id ? 'selected' : '' }}>
                {{ $p->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Dokter</label>
    <select name="dokter_id" class="form-control">
        @foreach($dokter as $d)
            <option value="{{ $d->id }}" {{ $data->dokter_id == $d->id ? 'selected' : '' }}>
                {{ $d->nama }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control" value="{{ $data->tanggal }}">
</div>

<div class="mb-3">
    <label>Keluhan</label>
    <textarea name="keluhan" class="form-control">{{ $data->keluhan }}</textarea>
</div>

<div class="mb-3">
    <label>Diagnosa</label>
    <textarea name="diagnosa" class="form-control">{{ $data->diagnosa }}</textarea>
</div>

<div class="mb-3">
    <label>Tindakan</label>
    <textarea name="tindakan" class="form-control">{{ $data->tindakan }}</textarea>
</div>

<div class="mb-3">
    <label>Obat</label>
    <select name="obat_id" class="form-control">
        @foreach($obat as $o)
            <option value="{{ $o->id }}" {{ $data->obat_id == $o->id ? 'selected' : '' }}>
                {{ $o->nama_obat }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Qty</label>
    <input type="number" name="qty" class="form-control" value="{{ $data->qty }}">
</div>

<div class="mb-3">
    <label>Metode</label>
    <select name="metode" class="form-control">
        <option value="bpjs" {{ $data->metode == 'bpjs' ? 'selected' : '' }}>BPJS</option>
        <option value="tunai" {{ $data->metode == 'tunai' ? 'selected' : '' }}>Tunai</option>
    </select>
</div>

<button class="btn btn-success">Update</button>

<a href="{{ route('rekam-medis.index') }}" class="btn btn-secondary">
    Kembali
</a>

</form>

@endsection