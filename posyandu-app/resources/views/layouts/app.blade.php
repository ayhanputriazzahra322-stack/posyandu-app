<!DOCTYPE html>
<html>
<head>
    <title>Posyandu App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            background: #1e293b;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 230px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1e293b;
        }

        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .sidebar h4 {
            position: sticky;
            top: 0;
            background: #1e293b;
            z-index: 10;
            margin: 0;
        }

        .content {
            margin-left: 230px;
            padding: 20px;
            min-height: 100vh;
        }

        .card-box {
            border-radius: 12px;
            padding: 20px;
            color: white;
        }

        hr {
            border-color: #64748b;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="text-center py-3">Posyandu</h4>

    <a href="/dashboard"><i class="fas fa-home"></i> Dashboard</a>
    <a href="/pasien"><i class="fas fa-user"></i> Pasien</a>
    <a href="/dokter"><i class="fas fa-user-md"></i> Dokter</a>
    <a href="/rekam-medis"><i class="fas fa-notes-medical"></i> Rekam Medis</a>
    <a href="/keuangan"><i class="fas fa-money-bill"></i> Keuangan</a>

    <hr>

    <a href="/ibu"><i class="fas fa-female"></i> Ibu</a>
    <a href="/anak"><i class="fas fa-child"></i> Anak</a>
    <a href="/kehamilan"><i class="fas fa-heartbeat"></i> Kehamilan</a>
    <a href="/imunisasi"><i class="fas fa-syringe"></i> Imunisasi</a>
    <a href="/penimbangan"><i class="fas fa-weight"></i> Penimbangan</a>
    <a href="/obat"><i class="fas fa-pills"></i> Obat</a>
    <a href="/obat/laporan"><i class="fas fa-chart-bar"></i> Laporan Obat</a>

    <hr>

    <a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- CONTENT -->
<div class="content">

    <!-- NAVBAR -->
    <div class="d-flex justify-content-between mb-3">
        <h4>@yield('title')</h4>
        <div>
            {{ auth()->user()->name }}
        </div>
    </div>

    @yield('content')

</div>

@yield('scripts')

</body>
</html>