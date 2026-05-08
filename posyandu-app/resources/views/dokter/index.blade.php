@extends('layouts.app')

@section('title','Data Dokter')

@section('content')


<a href="{{ route('dokter.create') }}" class="btn btn-primary mb-3">
    + Tambah Dokter
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th style="width: 70px;">No</th>
            <th>Nama</th>
            <th>Spesialis</th>
            <th style="width: 220px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->spesialis }}</td>
            <td>
                <a href="{{ route('dokter.edit', $d->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('dokter.destroy', $d->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin mau hapus data ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Data dokter belum ada</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection