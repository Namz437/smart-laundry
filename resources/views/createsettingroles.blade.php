@extends('layouts.nav')

@section('content')

<title>Add Setting Roles</title>

<h2 class="my-4 text-center">Add Setting Roles</h2>

<form method="POST" action="{{ route('storesettingroles') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="users_id" class="form-label">Users ID</label>
        <select class="form-control @error('users_id') is-invalid @enderror" id="users_id" name="users_id">
            @foreach($users as $users_item)
                <option value="{{ $users_item->id }}">{{ $users_item->name }}</option>
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
            @foreach($roles as $roles_item)
                <option value="{{ $roles_item->id }}">{{ $roles_item->nama_role }}</option>
            @endforeach
        </select>
        @error('roles_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('settingroles') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
