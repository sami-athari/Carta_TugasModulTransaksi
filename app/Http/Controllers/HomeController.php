<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hanya pengguna yang sudah login bisa akses controller ini.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Halaman dashboard user (dengan fitur search).
     */
    public function index(Request $request)
    {
        // Ambil keyword pencarian dari query string
        $search = $request->query('search');

        // Jika ada search, filter nama produk
        $produks = Produk::when($search, function($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderBy('kode_produk')
            ->paginate(25); // Batasi 25 produk per halaman

        return view('home', compact('produks', 'search')); // Jangan lupa kirim $search ke view
    }

    /**
     * Halaman dashboard admin.
     */
    public function adminHome(Request $request)
    {
        // Ambil keyword pencarian dari query string
        $search = $request->query('search');

        // Jika ada search, filter nama produk
        $produks = Produk::when($search, function($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderBy('kode_produk')
            ->paginate(25); // Batasi 25 produk per halaman

        return view('adminHome', compact('produks', 'search')); // Kirim $produks dan $search ke view
    }

    /**
     * Simpan produk baru (dari admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks',
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);

        Produk::create($request->all());

        return redirect()->route('adminHome')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Form edit produk (admin).
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update data produk (admin).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('adminHome')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Hapus produk (admin).
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('adminHome')->with('success', 'Produk berhasil dihapus');
    }
}
