@extends('layouts.nav')

@section('content')

<title>Edit Users</title>

<h2 class="my-4 text-center">Edit Users</h2>

<form method="POST" action="{{ route('updateuser', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
  
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('user') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
