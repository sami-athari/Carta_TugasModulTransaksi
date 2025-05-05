@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="kode_produk">Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" required>
        </div>

        {{-- Dropdown Kategori --}}
        <div class="form-group mb-3">
            <label for="category_id">Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Simpan dan Batal --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ url('admin/home') }}" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>
@endsection
