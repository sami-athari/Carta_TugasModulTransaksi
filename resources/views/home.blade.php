@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Dashboard Produk') }}</h5>
                        <a href="{{ route('cart.index') }}" class="link-keranjang">
                            Lihat Keranjang
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- Form Search --}}
                        <form method="GET" action="{{ route('home') }}" class="mb-3">
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Cari produk..."
                                    value="{{ request('search', $search ?? '') }}"
                                >
                                <button class="btn btn-outline-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        {{-- Tabel Produk --}}
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produks as $produk)
                                    <tr>
                                        <td>{{ $produk->kode_produk }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>Rp{{ number_format((float)$produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('cart.store', $produk->id) }}"
                                               class="btn btn-sm btn-primary">
                                                + Keranjang
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Produk tidak ditemukan.</td>
                                    </tr>
                                @endforelse
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


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
