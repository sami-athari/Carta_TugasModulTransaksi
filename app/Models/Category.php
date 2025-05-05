<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Category extends Model
{
    protected $fillable = ['name',];


    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori');
    }
}