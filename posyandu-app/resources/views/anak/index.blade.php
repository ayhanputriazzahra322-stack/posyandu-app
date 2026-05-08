@extends('layouts.app')

@section('title','Data Anak')

@section('content')

<a href="{{ route('anak.create') }}" class="btn btn-primary mb-3">
    + Tambah Data Anak
</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama Anak</th>
            <th>Nama Ibu</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->ibu->nama ?? '-' }}</td>

            <td>
                {{ $d->tanggal_lahir 
                    ? \Carbon\Carbon::parse($d->tanggal_lahir)->age . ' tahun' 
                    : '-' 
                }}
            </td>

            <td>{{ $d->jenis_kelamin }}</td>
            <td>
                <a href="{{ route('anak.edit',$d->id) }}" 
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('anak.destroy',$d->id) }}" 
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