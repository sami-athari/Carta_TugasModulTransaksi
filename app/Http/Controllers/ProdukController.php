<?php
// app/Http/Controllers/ProdukController.php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Tampilkan daftar produk dengan filter pencarian dan kategori
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // Mulai query produk dengan relasi category
        $query = Produk::with('category');

        // Filter berdasarkan pencarian nama atau kode_produk
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('kode_produk', 'like', "%{$keyword}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('kategori', $request->category_id);
        }

        // Paginate hasil
        $produks = $query->orderBy('created_at', 'desc')
                          ->paginate(10)
                          ->appends($request->only(['search', 'category_id']));

        return view('admin.index', compact('produks', 'categories'));
    }

    /**
     * Tampilkan form untuk menambah produk baru
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.produk.create', compact('categories'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks,kode_produk',
            'nama'        => 'required',
            'harga'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Produk::create([
            'kode_produk' => $request->kode_produk,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->category_id,        
        ]);
        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $categories = Category::all();
        return view('admin.produk.edit', compact('produk', 'categories'));
    }

    /**
     * Update data produk
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => "required|unique:produks,kode_produk,{$id}",
            'nama'        => 'required',
            'harga'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->only(['kode_produk', 'nama', 'harga', 'category_id']));

        return redirect()->route('admin.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}