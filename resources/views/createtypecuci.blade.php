@extends('layouts.nav')

@section('content')

<title>Add Type Cuci</title>

<h2 class="my-4 text-center">Add Type Cuci</h2>

<form method="POST" action="{{ route('storetypecuci') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_type" class="form-label">Nama Type Cuci</label>
        <input type="text" class="form-control @error('nama_type') is-invalid @enderror" id="nama_type" name="nama_type">
    </div>
    <div class="mb-3">
        <label for="durasi_cuci" class="form-label">Durasi Cuci</label>
        <input type="text" class="form-control" id="durasi_cuci" name="durasi_cuci">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('typecuci') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
