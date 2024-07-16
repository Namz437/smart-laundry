@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Edit Transaksi Laundry Realtime</h2>

<form method="POST" action="{{ route('updatetrxcucireal', $trxcuciasli->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="transaksi_cuci_id" class="form-label">Transaksi Cuci ID</label>
        <select class="form-control @error('transaksi_cuci_id') is-invalid @enderror" id="transaksi_cuci_id" name="transaksi_cuci_id">
            @foreach ($trxbooking as $trxbookings)
                <option value="{{ $trxbookings->id }}" @if($trxbooking_selected == $trxbookings->id) selected @endif>{{ $trxbookings->id }}</option>
            @endforeach
        </select>
        @error('transaksi_cuci_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
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
        <input type="text" class="form-control @error('waktu_cuci') is-invalid @enderror" id="waktu_cuci" name="waktu_cuci" value="{{ $trxcuciasli->waktu_cuci }}">
        @error('waktu_cuci')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status_transaksi" class="form-label">Status Transaksi</label>
        <input type="text" class="form-control @error('status_transaksi') is-invalid @enderror" id="status_transaksi" name="status_transaksi" value="{{ $trxcuciasli->status_transaksi }}">
        @error('status_transaksi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="total_harga_cucian" class="form-label">Total Harga Cucian</label>
        <input type="text" class="form-control @error('total_harga_cucian') is-invalid @enderror" id="total_harga_cucian" name="total_harga_cucian" value="{{ $trxcuciasli->total_harga_cucian }}">
        @error('total_harga_cucian')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('trxcucireal') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
