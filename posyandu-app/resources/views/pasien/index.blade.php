@extends('layouts.app')

@section('title','Data Pasien')

@section('content')

<div class="container">
    <h3 class="mb-4">Data Pasien</h3>

    <a href="{{ route('pasien.create') }}" class="btn btn-primary mb-3">
        + Tambah Pasien
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th width="250">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pasiens as $pasien)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>{{ $pasien->nik }}</td>
                            <td>{{ $pasien->tanggal_lahir }}</td>
                            <td>{{ $pasien->jenis_kelamin }}</td>
                            <td>{{ $pasien->alamat }}</td>
                            <td class="text-center">

                                <!-- RIWAYAT OBAT -->
                                <a href="{{ route('pasien.riwayat', $pasien->id) }}" 
                                   class="btn btn-info btn-sm">
                                   Riwayat
                                </a>

                                <!-- EDIT -->
                                <a href="{{ route('pasien.edit', $pasien->id) }}" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <!-- HAPUS -->
                                <form action="{{ route('pasien.destroy', $pasien->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Belum ada data pasien
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection