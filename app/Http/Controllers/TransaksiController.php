<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function index()
    {
        $pending = Cart::with(['produk','user'])
                       ->where('status','!=','Selesai')
                       ->get();
        return view('transaksi', compact('pending'));
    }

    // Menyetujui satu transaksi
    public function approve($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->status = 'Selesai';
        $cart->tanggal_transaksi = now();
        $cart->save();

        return back()->with('success','Pembayaran ID#'.$id.' disetujui.');
    }

    // Mengonfirmasi semua pesanan sekaligus
    public function konfirmasiPesanan(Request $request)
    {
        Cart::where('status', 'Menunggu')->update([
            'status' => 'Selesai',
            'tanggal_transaksi' => now()
        ]);

        return redirect()->route('transaksi')->with('success', 'Pesanan berhasil dikonfirmasi!');
    }
}
