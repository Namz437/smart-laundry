@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Add Setting Harga</h2>

<form method="POST" action="{{ route('storesettingharga') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="type_cuci_id" class="form-label">Type Cuci</label>
        <select class="form-control @error('type_cuci_id') is-invalid @enderror" id="type_cuci_id" name="type_cuci_id">
            @foreach($tipecuci as $tipecuci_item)
                <option value="{{ $tipecuci_item->id }}">{{ $tipecuci_item->nama_type }}</option>
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
        <input type="text" class="form-control @error('harga_perKg') is-invalid @enderror" id="harga_perKg" name="harga_perKg" value="{{ old('harga_perKg') }}">
        @error('harga_perKg')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('settingharga') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
