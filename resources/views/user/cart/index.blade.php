    @extends('layouts.app')

    @section('content')
    <div class="container">
        <h3>Keranjang Belanja</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($carts as $item)
                    <tr>
                        <td>{{ $item->produk->kode_produk }}</td>
                        <td>{{ $item->produk->nama }}</td>
                        <td>Rp {{ number_format((float)$item->produk->harga, 0, ',', '.') }}</td>
                        <td>
                            @if($item->status === 'Selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($item->status === 'Menunggu')
                                <span class="badge bg-info text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>{{ $item->tanggal_transaksi }}</td>
                        <td>
                            {{-- Tombol Bayar: hanya saat Pending --}}
                            @if($item->status === 'Pending')
                                <form action="{{ route('cart.bayar', $item->id) }}" method="GET" style="display:inline">
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-success me-1"
                                        onclick="return confirm('Yakin ingin membayar transaksi ini?')">
                                        Bayar
                                    </button>
                                </form>
                            @endif

                            {{-- Tombol Batal: bisa saat Pending atau Menunggu --}}
                            <form
                                action="{{ route('cart.destroy', $item->id) }}"
                                method="POST"
                                style="display:inline"
                                onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger me-1">Batal</button>
                            </form>

                            {{-- Cetak PDF: hanya saat Selesai --}}
                            @if($item->status === 'Selesai')
                                <a
                                    href="{{ route('cart.cetak', $item->id) }}"
                                    class="btn btn-sm btn-primary">
                                    Cetak PDF
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Keranjang kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tombol Back -->
        <div class="mt-3">
            <a href="{{ url('user/index') }}" class="btn btn-link text-decoration-none">
                &lt; Back
            </a>
        </div>
    </div>
    @endsection
