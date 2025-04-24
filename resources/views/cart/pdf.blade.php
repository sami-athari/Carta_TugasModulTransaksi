<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi {{ $cart->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #f9f9fc;
            color: #2c3e50;
        }

        h1 {
            text-align: center;
            font-size: 38px;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #1e3a8a; /* biru gelap */
        }

        h2 {
            text-align: center;
            font-size: 20px;
            color: #3b5998;
            margin-bottom: 30px;
        }

        .info {
            margin-bottom: 25px;
            background-color: #e8f0fe;
            padding: 15px 20px;
            border-left: 5px solid #1d4ed8;
            border-radius: 5px;
        }

        .info p {
            font-size: 16px;
            line-height: 1.6;
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1e40af;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        .total {
            margin-top: 25px;
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            color: #1e3a8a;
        }

        .highlight {
            color: #1d4ed8;
        }
    </style>
</head>
<body>
    <h1>Tugas Sami</h1>
    <h2>Transaksi ID: <span class="highlight">{{ $cart->id }}</span></h2>

    <div class="info">
        <p><strong>Status:</strong> {{ $cart->status }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $cart->tanggal_transaksi }}</p>
    </div>

    <h3 style="color: #1d4ed8;">Detail Produk:</h3>
    @if ($cart->produk)
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
                    $jumlah = 1; // Kalau ada kolom jumlah, bisa diganti ke $cart->jumlah
                    $harga = $cart->produk->harga;
                    $total = $harga * $jumlah;
                @endphp
                <tr>
                    <td>{{ $cart->produk->nama }}</td>
                    <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                    <td>{{ $jumlah }}</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <p class="total">Total Pembayaran: Rp {{ number_format($total, 0, ',', '.') }}</p>
    @else
        <p style="color: red;">Produk tidak ditemukan dalam transaksi ini.</p>
    @endif
</body>
</html>
