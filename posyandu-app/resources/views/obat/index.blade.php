@extends('layouts.app')

@section('title','Data Obat')

@section('content')

<a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">
    + Tambah Data Obat
</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_obat }}</td>
            <td>{{ $d->stok }}</td>
            <td>Rp {{ number_format($d->harga,0,',','.') }}</td>
            <td>

                <a href="{{ route('obat.edit',$d->id) }}" 
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('obat.destroy',$d->id) }}" 
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
        @endforeach
    </tbody>
</table>

@endsection