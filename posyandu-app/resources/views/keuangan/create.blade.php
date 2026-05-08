@extends('layouts.app')

@section('title','Pembayaran')

@section('content')

<h4>Pembayaran</h4>

<form method="POST" action="{{ route('keuangan.store') }}">
@csrf

<div class="mb-2">
    <label>Rekam Medis</label>
    <select name="rekam_medis_id" id="rekam" class="form-control">
        @foreach($rekam as $r)
        <option 
            value="{{ $r->id }}" 
            data-total="{{ $r->total }}">
            {{ $r->pasien->nama }} - {{ $r->tanggal }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-2">
    <label>Metode</label>
    <select name="metode" id="metode" class="form-control">
        <option value="bpjs">BPJS</option>
        <option value="tunai">Tunai</option>
    </select>
</div>

<div class="mb-2">
    <label>Total Bayar</label>
    <input type="text" id="total_bayar" class="form-control" readonly>
</div>

<input type="hidden" name="total_bayar" id="total_hidden">

<button class="btn btn-success">Bayar</button>

</form>

<script>
function updateTotal() {
    let rekam = document.getElementById('rekam');
    let metode = document.getElementById('metode').value;

    let selected = rekam.options[rekam.selectedIndex];
    let total = selected.getAttribute('data-total');

    if (metode === 'bpjs') {
        total = 0;
    }

    document.getElementById('total_bayar').value = total;
    document.getElementById('total_hidden').value = total;
}

document.getElementById('rekam').addEventListener('change', updateTotal);
document.getElementById('metode').addEventListener('change', updateTotal);

// init
updateTotal();
</script>

@endsection