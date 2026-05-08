@extends('layouts.app')

@section('title','Dashboard')

@section('content')

@php
$pasien = \App\Models\Pasien::count();
$dokter = \App\Models\Dokter::count();
$rekam = \App\Models\RekamMedis::count();
$keuangan = \App\Models\Keuangan::count();
@endphp

<div class="row g-4">

    <div class="col-md-3">
        <div class="card-box bg-primary">
            <h5>Pasien</h5>
            <h3>{{ $pasien }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box bg-success">
            <h5>Dokter</h5>
            <h3>{{ $dokter }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box bg-warning">
            <h5>Rekam Medis</h5>
            <h3>{{ $rekam }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box bg-danger">
            <h5>Keuangan</h5>
            <h3>{{ $keuangan }}</h3>
        </div>
    </div>

</div>

{{-- GRAFIK --}}
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                Statistik Data
            </div>
            <div class="card-body">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header">
                Komposisi Data
            </div>
            <div class="card-body">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const pasien = {{ $pasien }};
    const dokter = {{ $dokter }};
    const rekam = {{ $rekam }};
    const keuangan = {{ $keuangan }};

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Pasien', 'Dokter', 'Rekam Medis', 'Keuangan'],
            datasets: [{
                label: 'Jumlah',
                data: [pasien, dokter, rekam, keuangan],
                backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545']
            }]
        }
    });

    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pasien', 'Dokter', 'Rekam Medis', 'Keuangan'],
            datasets: [{
                data: [pasien, dokter, rekam, keuangan],
                backgroundColor: ['#0d6efd','#198754','#ffc107','#dc3545']
            }]
        }
    });

});
</script>
@endsection