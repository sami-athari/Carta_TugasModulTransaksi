@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('konfirmasi.pesanan') }}" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-primary">Konfirmasi Semua Pesanan</button>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Nama Produk</th>
                        <th>Status</th>
                        <th>Tanggal Request</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pending as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->user->name }}</td>
                        <td>{{ $c->produk->nama }}</td>
                        <td>{{ $c->status }}</td>
                        <td>{{ $c->tanggal_transaksi ?? '-' }}</td>
                        <td>
                            @if($c->status !== 'pending')
                                <!-- Tombol Setujui hanya muncul jika status bukan pending -->
                                <a href="{{ route('transaksi.approve', $c->id) }}"
                                   class="btn btn-sm btn-success me-1">
                                    Setujui
                                </a>
                            @endif

                            <!-- Tombol Batal tetap muncul -->
                            <a href="{{ route('transaksi', $c->id) }}"
                               class="btn btn-sm btn-danger">
                                Batal
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada pesanan menunggu approval.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Back di bagian bawah --}}
    <div class="mt-3">
        <a href="{{ url('/admin/home') }}" class="btn btn-link text-decoration-none">
            &lt; Back
        </a>
    </div>
</div>
@endsection
