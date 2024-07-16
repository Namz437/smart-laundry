@extends('layouts.nav')

@section('content')

<title>Edit Addition</title>

<h2 class="my-4 text-center">Edit Addition</h2>

<form method="POST" action="{{ route('updateaddition', $addition->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="nama_addition" class="form-label">Nama Addition</label>
        <input type="text" class="form-control @error('nama_addition') is-invalid @enderror" id="nama_addition" name="nama_addition" value="{{ $addition->nama_addition }}">
        @error('nama_addition')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ $addition->harga }}">
        @error('harga')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror">{{ $addition->deskripsi }}</textarea>
        @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('addition') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
