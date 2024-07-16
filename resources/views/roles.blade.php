@extends('layouts.nav')

@section('content')

<h2 class="my-4 text-center">Roles</h2>

<a class="btn btn-primary mb-4 " href="{{ route('createrole') }}">Tambah</a>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session('error') }}
</div>

@elseif(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sukses!</strong> {{ session('success') }}
</div>
@endif


<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->nama_role }}</td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ route('editrole', $role->id) }}" class="btn btn-primary btn-sm mb-2">Edit</a>
                        <form method="POST" action="{{ route('destroyrole', ['id' => $role->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus Roles ini?');">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.add('fade-out');
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }
        }, 3000);
    });
</script>

<style>
    .fade-out {
        transition: opacity 0.5s ease-out;
        opacity: 0;
    }
</style>

@endsection