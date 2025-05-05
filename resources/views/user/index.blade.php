@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header dan Link ke Keranjang --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Dashboard Produk</h3>
        <a href="{{ route('user.cart.index') }}" class="btn btn-outline-primary">
            Lihat Keranjang
        </a>
    </div>

    {{-- Form Search dan Filter Kategori --}}
    <form method="GET" action="{{ route('user.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-8">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari produk..."
                    value="{{ request('search', $search ?? '') }}"
                >
            </div>
            <div class="col-md-4">
                <select name="category_id" id="category_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Grid Kartu Produk --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($produks as $produk)
            <div class="col">
                <div class="card h-100">
                    {{-- Gambar Produk --}}
                    @if($produk->image)
                        <img src="{{ asset('storage/' . $produk->image) }}" class="card-img-top" alt="{{ $produk->nama }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                    @endif

                    <div class="card-body d-flex flex-column">
                        {{-- Nama dan Kode --}}
                        <h5 class="card-title">{{ $produk->nama }}</h5>
                        <p class="card-text text-muted small mb-2">Kode: {{ $produk->kode_produk }}</p>

                        {{-- Kategori & Tipe --}}
                        <p class="mb-2">
                            <span class="badge bg-secondary">
                                {{ $produk->category->name ?? '—' }}
                            </span>

                        </p>

                        {{-- Harga --}}
                        <h6 class="mt-auto">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h6>

                        {{-- Tombol Tambah ke Keranjang --}}
                        <a href="{{ route('cart.store', $produk->id) }}"
                           class="btn btn-primary btn-sm mt-2">
                            + Keranjang
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Produk tidak ditemukan.
            </div>
        @endforelse
    </div>

    {{-- Paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $produks->withQueryString()->links() }}
    </div>
</div>
@endsection
