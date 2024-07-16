@extends('layouts.nav')

@section('content')

<title>Edit Setting Roles</title>

<h2 class="my-4 text-center">Edit Setting Roles</h2>

<form method="POST" action="{{ route('updatesettingroles', $settingroles->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="users_id" class="form-label">Users ID</label>
        <select class="form-control @error('users_id') is-invalid @enderror" id="users_id" name="users_id">
            @foreach ($user as $users_item)
            <option value="{{ $users_item->id }}" @if($users_selected == $users_item->id) selected @endif>{{ $users_item->name }}</option>
            @endforeach
        </select>
        @error('users_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="roles_id" class="form-label">Roles ID</label>
        <select class="form-control @error('roles_id') is-invalid @enderror" id="roles_id" name="roles_id">
            @foreach ($roles as $roles_item)
            <option value="{{ $roles_item->id }}" @if($roles_selected == $roles_item->id) selected @endif>{{ $roles_item->nama_role }}</option>
            @endforeach
        </select>
        @error('roles_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('settingroles') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
