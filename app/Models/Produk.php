<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Uncomment HasFactory jika Anda menggunakannya untuk factory
    // use HasFactory;

    protected $fillable = ['kode_produk', 'nama', 'harga','kategori',];
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori');
    }

    // Relasi ke Cart
    public function carts()
    {
        return $this->hasMany(Cart::class); // Produk memiliki banyak Cart
    }
}