@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Kategori</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.produk.kategori.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->name }}</td>
                    <td>
                        <a href="{{ route('admin.produk.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('admin.produk.kategori.destroy', $kategori->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Tombol Kembali ke Halaman Admin Index -->
    <a href="{{ route('admin.index') }}" class="btn btn-secondary mt-3">Kembali ke Halaman Admin</a>
</div>
@endsection
