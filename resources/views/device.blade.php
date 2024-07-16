@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Data Device</h2>

<a class="btn btn-primary mb-4" href="{{ route('createdevice') }}">Tambah</a>

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
                <th>Nama Type Cuci</th>
                <th>Nama Device</th>
                <th>Mac Adress</th>
                <th>Status Booking</th>
                <th>Status Mesin</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dat as $device)
            <tr>
                <td>{{ $device->id }}</td>
                <td>{{ $device->Perusahaan->nama_perusahaan ?? 'N/A' }}</td>
                <td>{{ $device->TypeCuci->nama_type ?? 'N/A' }}</td>
                <td>{{ $device->nama_device }}</td>
                <td>{{ $device->mac_address }}</td>
                <td>{{ $device->status_booking }}</td>
                <td>{{ $device->status_mesin }}</td>
                <td>{{ $device->status }}</td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ route('editdevice', $device->id) }}" class="btn btn-primary btn-sm mb-2 w-100">Edit</a>
                        <form method="POST" action="{{ route('destroydevice', ['id' => $device->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus device ini?');">Hapus</button>
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
