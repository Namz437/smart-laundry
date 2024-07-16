@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Data Perusahaan</h2>

<a class="btn btn-primary mb-4" href="{{ route('create') }}">Tambah</a>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error') }}
</div>

@elseif(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Perusahaan</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $perusahaan)
            <tr>
                <td>{{ $perusahaan->id }}</td>
                <td>{{ $perusahaan->nama_perusahaan }}</td>
                <td>{{ $perusahaan->deskripsi }}</td>
                <td>{{ $perusahaan->lokasi }}</td>
                <td>
                    @if($perusahaan->image)
                        <img src="{{ asset($perusahaan->image) }}" alt="Image" width="140" class="img-thumbnail">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ route('edit', $perusahaan->id) }}" class="btn btn-primary btn-sm mb-2">Edit</a>
                        <form method="POST" action="{{ route('destroy', ['id' => $perusahaan->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?');">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.add('fade-out');
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }, 3000);
    });
</script>

<style>
    .fade-out {
        transition: opacity 0.5s ease-out;
        opacity: 0;
    }
</style>

@endsection
