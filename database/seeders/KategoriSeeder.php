<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Pakaian', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Makanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Buku', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Olahraga', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('categories')->insert($categories);
    }
}
