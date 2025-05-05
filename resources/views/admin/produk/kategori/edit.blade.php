@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kategori</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produk.kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $kategori->name) }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('admin.produk.kategori.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
