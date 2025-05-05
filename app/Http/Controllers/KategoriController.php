<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class KategoriController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.produk.kategori.index', compact('categories'));
    }

    /**
     * Tampilkan form tambah kategori
     */
    public function create()
    {
        return view('admin.produk.kategori.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.produk.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit($id)
    {
        $kategori = Category::findOrFail($id);
        return view('admin.produk.kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = Category::findOrFail($id);
        $kategori->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.produk.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $kategori = Category::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.produk.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
