@extends('layouts.nav')

@section('content')

<title>Add Users</title>

<h2 class="my-4 text-center">Add Users</h2>

<form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
   
   
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('user') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
