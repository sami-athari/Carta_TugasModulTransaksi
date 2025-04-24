@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <!-- Form pencarian -->
    <form action="{{ route('admin.home') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request()->query('search') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <!-- Tabel produk -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
                <tr>
                    <td>{{ $produk->kode_produk }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ number_format($produk->harga, 2) }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Custom Pagination --}}
<div class="d-flex justify-content-center align-items-center mt-3" style="font-size: 0.95rem;">
    @if ($produks->onFirstPage())
        <span class="me-3 text-muted" style="font-size: 1.3rem;">
            &laquo;
        </span>
    @else
        <a href="{{ $produks->previousPageUrl() }}"
           class="me-3 text-decoration-none text-primary"
           style="font-size: 1.3rem;">
            &laquo;
        </a>
    @endif

    <span>
        Halaman {{ $produks->currentPage() }} dari {{ $produks->lastPage() }}
    </span>

    @if ($produks->hasMorePages())
        <a href="{{ $produks->nextPageUrl() }}"
           class="ms-3 text-decoration-none text-primary"
           style="font-size: 1.3rem;">
            &raquo;
        </a>
    @else
        <span class="ms-3 text-muted" style="font-size: 1.3rem;">
            &raquo;
        </span>
    @endif
</div>
@endsection
