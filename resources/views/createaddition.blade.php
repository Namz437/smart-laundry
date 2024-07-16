@extends('layouts.nav')

@section('content')

<title>Add Addition</title>

<h2 class="my-4 text-center">Add Addition</h2>

<form method="POST" action="{{ route('storeaddition') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_addition" class="form-label">Nama Addition</label>
        <input type="text" class="form-control @error('nama_addition') is-invalid @enderror" id="nama_addition" name="nama_addition">
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" class="form-control" id="harga" name="harga">
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('addition') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
