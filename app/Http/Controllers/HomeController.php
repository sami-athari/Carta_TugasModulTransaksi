<?php
// app/Http/Controllers/ProdukController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
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

        return view('user.index', compact('produks', 'categories'));
    }
}
