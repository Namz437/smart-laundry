@extends('layouts.nav')

@section('content')

<title>Edit Roles</title>

<h2 class="my-4 text-center">Edit Roles</h2>

<form method="POST" action="{{ route('updaterole', $role->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="nama_role" class="form-label">Nama Role</label>
        <input type="text" class="form-control @error('nama_role') is-invalid @enderror" id="nama_role" name="nama_role" value="{{ $role->nama_role }}">
        @error('nama_addition')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('role') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
