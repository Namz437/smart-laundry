@extends('layouts.nav')

@section('content')

<title>Add Perusahaan</title>

<h2 class="my-4 text-center">Add Perusahaan</h2>

<form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
        <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan">
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('table') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
