@extends('layouts.nav')

@section('content')

<title>Add Roles</title>

<h2 class="my-4 text-center">Add Roles</h2>

<form method="POST" action="{{ route('storerole') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="nama_role" class="form-label">Nama Role</label>
        <input type="text" class="form-control @error('nama_role') is-invalid @enderror" id="nama_role" name="nama_role">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('role') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
