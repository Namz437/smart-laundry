@extends('layouts.nav')

@section('content')

<title>Edit Device</title>

<h2 class="my-4 text-center">Edit Device</h2>

<form method="POST" action="{{ route('updatedevice', $device->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="perusahaan_id" class="form-label">Perusahaan ID</label>
        <select class="form-control @error('perusahaan_id') is-invalid @enderror" id="perusahaan_id" name="perusahaan_id">
            @foreach ($perusahaan as $perusahaans)
            <option value="{{ $perusahaans->id }}" @if($perusahaan_selected == $perusahaans->id) selected @endif>{{ $perusahaans->nama_perusahaan }}</option>
            @endforeach
        </select>
        @error('perusahaan_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="type_cuci_id" class="form-label">Type Cuci ID</label>
        <select class="form-control @error('type_cuci') is-invalid @enderror" id="type_cuci_id" name="type_cuci_id">
            @foreach ($tipecuci as $type)
            <option value="{{ $type->id }}" @if($type_cuci_selected == $type->id) selected @endif>{{ $type->nama_type }}</option>
            @endforeach
        </select>
        @error('type_cuci_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="nama_device" class="form-label">Nama Device</label>
        <input type="text" class="form-control @error('nama_device') is-invalid @enderror" id="nama_device" name="nama_device" value="{{ $device->nama_device }}">
        @error('nama_device')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="mac_address" class="form-label">Mac Address</label>
        <input type="text" class="form-control @error('mac_address') is-invalid @enderror" id="mac_address" name="mac_address" value="{{ $device->mac_address }}">
        @error('mac_address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status_booking" class="form-label">Status Booking</label>
        <input type="text" class="form-control @error('status_booking') is-invalid @enderror" id="status_booking" name="status_booking" value="{{ $device->status_booking }}">
        @error('status_booking')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status_mesin" class="form-label">Status Mesin</label>
        <input type="text" class="form-control @error('status_mesin') is-invalid @enderror" id="status_mesin" name="status_mesin" value="{{ $device->status_mesin }}">
        @error('status_mesin')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ $device->status }}">
        @error('status')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('device') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
