<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi {{ $cart->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Transaksi ID: {{ $cart->id }}</h1>
    <p><strong>Status:</strong> {{ $cart->status }}</p>
    <p><strong>Tanggal Transaksi:</strong> {{ $cart->tanggal_transaksi }}</p>

    <h3>Detail Produk:</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarga = 0;
            @endphp
            @foreach ($cart->produk as $produk)
                @php
                    $total = $produk->harga * $produk->pivot->jumlah;
                    $totalHarga += $total;
                @endphp
                <tr>
                    <td>{{ $produk->nama }}</td>
                    <td>Rp {{ number_format((float)$produk->harga, 0, ',', '.') }}</td>
                    <td>{{ $produk->pivot->jumlah }}</td>
                    <td>Rp {{ number_format((float)$total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3><strong>Total Pembayaran:</strong> Rp {{ number_format((float)$totalHarga, 0, ',', '.') }}</h3>
</body>
</html>
