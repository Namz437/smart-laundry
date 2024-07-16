@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Edit Transaksi Laundry Booking</h2>

<form method="POST" action="{{ route('updatetrxbooking', $trxbooking->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="users_id" class="form-label">Users</label>
        <select class="form-control @error('users_id') is-invalid @enderror" id="users_id" name="users_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @if($user_selected == $user->id) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('users_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="device_id" class="form-label">Device</label>
        <select class="form-control @error('device_id') is-invalid @enderror" id="device_id" name="device_id">
            @foreach ($devices as $device)
                <option value="{{ $device->id }}" @if($device_selected == $device->id) selected @endif>{{ $device->nama_device }}</option>
            @endforeach
        </select>
        @error('device_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="waktu_cuci" class="form-label">Waktu Cuci</label>
        <input type="text" class="form-control @error('waktu_cuci') is-invalid @enderror" id="waktu_cuci" name="waktu_cuci" value="{{ $trxbooking->waktu_cuci }}">
        @error('waktu_cuci')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status_transaksi" class="form-label">Status Transaksi</label>
        <input type="text" class="form-control @error('status_transaksi') is-invalid @enderror" id="status_transaksi" name="status_transaksi" value="{{ $trxbooking->status_transaksi }}">
        @error('status_transaksi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="total_harga" class="form-label">Total Harga</label>
        <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga" name="total_harga" value="{{ $trxbooking->total_harga }}">
        @error('total_harga')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('trxbooking') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
