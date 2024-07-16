@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Data Transaksi Laundry Booking</h2>

{{-- <a class="btn btn-primary mb-4" href="{{ route('createtrxbooking') }}">Tambah</a> --}}

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
                <th>Users ID</th>
                <th>Device ID</th>
                <th>Waktu Cuci</th>
                <th>Status Transaksi</th>
                <th>Total Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataaa as $trxbooking)
            <tr>
                <td>{{ $trxbooking->id }}</td>
                <td>{{ $trxbooking->users->name ?? 'N/A' }}</td>
                <td>{{ $trxbooking->Device->nama_device ?? 'N/A' }}</td>
                <td>{{ $trxbooking->waktu_cuci }}</td>
                <td>{{ $trxbooking->status_transaksi }}</td>
                <td>{{ $trxbooking->total_harga }}</td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ route('edittrxbooking', $trxbooking->id) }}" class="btn btn-primary btn-sm mb-2 w-100">Edit</a>
                        <form method="POST" action="{{ route('destroytrxbooking', ['id' => $trxbooking->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus Transaksi Booking ini?');">Hapus</button>
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
