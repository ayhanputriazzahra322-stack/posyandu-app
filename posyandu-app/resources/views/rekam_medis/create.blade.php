@extends('layouts.app')

@section('title','Tambah Rekam Medis')

@section('content')

<form method="POST" action="{{ route('rekam-medis.store') }}">
@csrf

<div class="mb-3">
    <label>Pasien</label>
    <select name="pasien_id" class="form-control" required>
        <option value="">-- Pilih Pasien --</option>
        @foreach($pasien as $p)
            <option value="{{ $p->id }}">{{ $p->nama }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Dokter</label>
    <select name="dokter_id" class="form-control" required>
        <option value="">-- Pilih Dokter --</option>
        @foreach($dokter as $d)
            <option value="{{ $d->id }}">{{ $d->nama }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control" required>
</div>

<div class="mb-3">
    <label>Keluhan</label>
    <textarea name="keluhan" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Diagnosa</label>
    <textarea name="diagnosa" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Obat</label>
    <select name="obat_id" class="form-control" required>
        <option value="">-- Pilih Obat --</option>
        @foreach($obat as $o)
            <option value="{{ $o->id }}">
                {{ $o->nama_obat }} - Rp {{ number_format($o->harga, 0, ',', '.') }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Qty</label>
    <input type="number" name="qty" class="form-control" min="1" required>
</div>

<div class="mb-3">
    <label>Metode Pembayaran</label>
    <select name="metode" class="form-control" required>
        <option value="bpjs">BPJS (Gratis)</option>
        <option value="tunai">Tunai</option>
    </select>
</div>

<button class="btn btn-success">Simpan</button>

</form>

@endsection