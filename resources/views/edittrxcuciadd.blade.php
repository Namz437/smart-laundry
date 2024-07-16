@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Edit Transaksi Laundry Cucian Additional Booking</h2>

<form method="POST" action="{{ route('updatetrxcuciadd', $trxcuciadd->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="transaksi_cuci_id" class="form-label">Transaksi Cucian ID</label>
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
        <label for="addition_id" class="form-label">Addition ID</label>
        <select class="form-control @error('addition_id') is-invalid @enderror" id="addition_id" name="addition_id">
            @foreach ($addition as $additions)
                <option value="{{ $additions->id }}" @if($addition_selected == $additions->id) selected @endif>{{ $additions->nama_addition }}</option>
            @endforeach
        </select>
        @error('addition_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah Addition</label>
        <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ $trxcuciadd->jumlah }}">
        @error('jumlah')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="total_harga" class="form-label">Total Harga</label>
        <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga" name="total_harga" value="{{ $trxcuciadd->total_harga }}">
        @error('total_harga')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('trxcuciadd') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
