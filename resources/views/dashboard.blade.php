@extends('layouts.nav')

@section('content')

<div class="d-flex justify-content-center my-4">
    <h2 class="text-center">Dashboard Admin Smart-Laundry</h2>
</div>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error') }}
</div>
@endif

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3 shadow">
            <div class="card-body text-center">
                <h5 class="card-title">User Tersedia</h5>
                <p class="card-text count-text">{{ $userCount }}</p>
                <a class="mb-4 text-white text-decoration-none" href="{{ route('user') }}">Lihat Table >></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3 shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Perusahaan Tersedia</h5>
                <p class="card-text count-text">{{ $perusahaanCount }}</p>
                <a class="mb-4 text-white text-decoration-none" href="{{ route('table') }}">Lihat Table >></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info mb-3 shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Device Tersedia</h5>
                <p class="card-text count-text">{{ $deviceCount }}</p>
                <a class="mb-4 text-white text-decoration-none" href="{{ route('device') }}">Lihat Table >></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3 shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Transaksi Tersedia</h5>
                <p class="card-text count-text">{{ $TransaksiBookingCount }}</p>
                <a class="mb-4 text-white text-decoration-none" href="{{ route('trxbooking') }}">Lihat Table >></a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Data Perusahaan</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Perusahaan</th>
                                <th>Deskripsi</th>
                                <th>Lokasi</th>
                                <th>Image</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Data Device</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Type Cuci</th>
                                <th>Nama Device</th>
                                <th>Mac Address</th>
                                <th>Status Booking</th>
                                <th>Status Mesin</th>
                                <th>Status</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Data Users</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataa as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Data Transaksi Booking</h5>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fade out alert after 3 seconds
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
    .count-text {
        font-size: 2em;
        font-weight: bold;
    }
    .fade-out {
        transition: opacity 0.5s ease-out;
        opacity: 0;
    }
</style>

@endsection
