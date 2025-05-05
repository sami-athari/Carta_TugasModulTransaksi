<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('produk')->where('user_id', Auth::id())->get();
        return view('user.cart.index', compact('carts'));
    }

    public function store($produk_id)
    {
        $produk = Produk::find($produk_id);

        if (!$produk) {
            return redirect()->route('user.cart.index')->with('error', 'Produk tidak ditemukan');
        }

        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('produk_id', $produk_id)
                            ->first();

        if ($existingCart) {
            return redirect()->route('user.cart.index')->with('error', 'Produk sudah ada di keranjang');
        }

        Cart::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk_id,
            'status' => 'Pending',
            'tanggal_transaksi' => now(),
        ]);

        return redirect()->route('user.cart.index')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function bayar($id)
    {
        $cart = Cart::findOrFail($id);
        if ($cart->status !== 'Pending') {
            return back()->with('error','Tidak bisa membayar transaksi ini.');
        }
        $cart->status = 'Menunggu';
        $cart->save();
        return back()->with('success','Pembayaran diajukan, tunggu persetujuan admin.');
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart || $cart->status == 'Selesai') {
            return redirect()->route('user.cart.index')->with('error', 'Tidak bisa menghapus transaksi yang sudah selesai');
        }

        $cart->delete();

        return redirect()->route('user.cart.index')->with('success', 'Item keranjang dihapus');
    }

    public function cetakTransaksi($id)
    {
        $cart = Cart::with('produk')->find($id);

        if (!$cart) {
            return redirect()->route('user.cart.index')->with('error', '  tidak ditemukan');
        }

        // Membuat file PDF dari view 'cart.pdf'
        $pdf = Pdf::loadView('cart.pdf', ['cart' => $cart]);

        // Mengunduh file PDF dengan nama transaksi-ID.pdf
        return $pdf->download('transaksi-' . $cart->id . '.pdf');
    }
    public function history()
    {
        $history = Cart::with('produk')
                       ->where('user_id',Auth::id())
                       ->where('status','Selesai')
                       ->get();
        return view('cart.history',compact('history'));
    }
}