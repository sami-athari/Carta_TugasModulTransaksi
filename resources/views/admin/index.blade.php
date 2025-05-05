@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <a href="{{ route('produk.create') }}" class="btn btn-success">Create Produk</a>
            <a href="{{ route('admin.produk.kategori.index') }}" class="btn btn-primary">Kategori</a>
        </div>
        <a href="{{ route('transaksi') }}" class="text-decoration-none text-primary fw-semibold d-flex align-items-center">
            <!-- Icon SVG -->
            Konfirmasi Transaksi
        </a>
    </div>

    {{-- Form pencarian dan filter kategori --}}
    <form action="{{ route('produk.index') }}" method="GET" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-md-5">
                <label for="search" class="form-label">Cari Produk</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Nama atau kode produk..."
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>

    @if ($produks->isEmpty())
        <div class="alert alert-info text-center">Tidak ada produk yang ditemukan.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produks as $produk)
                    <tr>
                        <td>{{ $produk->kode_produk }}</td>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ number_format($produk->harga, 2, ',', '.') }}</td>
                        <td>{{ $produk->category->name ?? 'Tanpa Kategori' }}</td>
                        <td>
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3" style="font-size: 0.95rem;">
            {!! $produks->links() !!}
        </div>
    @endif
</div>
@endsection
