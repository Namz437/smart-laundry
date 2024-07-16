@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Edit Setting Harga</h2>

<form method="POST" action="{{ route('updatesettingharga', $settingharga->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="type_cuci_id" class="form-label">Type Cuci ID</label>
        <select class="form-control @error('type_cuci') is-invalid @enderror" id="type_cuci_id" name="type_cuci_id">
            @foreach ($tipecuci as $type)
            <option value="{{ $type->id }}" @if($type_cuci_selected == $type->id) selected @endif>{{ $type->nama_type }}</option>
            @endforeach
        </select>
        @error('type_cuci_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="harga_perKg" class="form-label">Harga Per Kg</label>
        <input type="text" class="form-control @error('harga_perKg') is-invalid @enderror" id="harga_perKg" name="harga_perKg" value="{{ $settingharga->harga_perKg }}">
        @error('harga_perKg')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('settingharga') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

@endsection
