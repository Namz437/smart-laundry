@extends('layouts.nav')

@section('content')

<title>Edit Type Cuci</title>

<h2 class="my-4 text-center">Edit Type Cuci</h2>

<form method="POST" action="{{ route('updatetypecuci', $typecuci->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="nama_type" class="form-label">Nama Type Cuci</label>
        <input type="text" class="form-control @error('nama_type') is-invalid @enderror" id="nama_type" name="nama_type" value="{{ $typecuci->nama_type }}">
        @error('nama_perusahaan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="durasi_cuci" class="form-label">Durasi Cucian</label>
        <input type="text" class="form-control @error('durasi_cuci') is-invalid @enderror" id="durasi_cuci" name="durasi_cuci" value="{{ $typecuci->durasi_cuci }}">
        @error('durasi_cuci')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('typecuci') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
