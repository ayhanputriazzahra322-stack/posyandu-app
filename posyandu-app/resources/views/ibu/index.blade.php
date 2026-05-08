@extends('layouts.app')

@section('title','Data Ibu')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 fw-bold text-primary">
                Data Ibu
            </h4>

            <a href="{{ route('ibu.create') }}" class="btn btn-primary mb-3">
                + Tambah Data Ibu
            </a>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Ibu</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $d->nama }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td class="text-center">

                            <a href="{{ route('ibu.edit',$d->id) }}" 
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>

                            <form action="{{ route('ibu.destroy',$d->id) }}" 
                                  method="POST" 
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Data belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection