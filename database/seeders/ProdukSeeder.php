<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('produks')->insert([
            ['kode_produk' => '001', 'nama' => 'Pulpen Gel Hitam', 'harga' => '3500'],
            ['kode_produk' => '002', 'nama' => 'Buku Tulis A5', 'harga' => '5000'],
            ['kode_produk' => '003', 'nama' => 'Penggaris Logam 30cm', 'harga' => '8000'],
            ['kode_produk' => '004', 'nama' => 'Gunting Stainless', 'harga' => '10000'],
            ['kode_produk' => '005', 'nama' => 'Lem Kertas Besar', 'harga' => '7000'],
            ['kode_produk' => '006', 'nama' => 'Spidol Warna Hitam', 'harga' => '9500'],
            ['kode_produk' => '007', 'nama' => 'Kalkulator Mini', 'harga' => '25000'],
            ['kode_produk' => '008', 'nama' => 'Tas Ransel Sekolah', 'harga' => '120000'],
            ['kode_produk' => '009', 'nama' => 'Papan Tulis Magnetik', 'harga' => '38000'],
            ['kode_produk' => '010', 'nama' => 'Jam Meja Digital', 'harga' => '45000'],
            ['kode_produk' => '011', 'nama' => 'Flashdisk 16GB', 'harga' => '60000'],
            ['kode_produk' => '012', 'nama' => 'Mouse Wireless', 'harga' => '75000'],
            ['kode_produk' => '013', 'nama' => 'Keyboard USB', 'harga' => '95000'],
            ['kode_produk' => '014', 'nama' => 'Kabel Data Type-C', 'harga' => '25000'],
            ['kode_produk' => '015', 'nama' => 'Powerbank 10000mAh', 'harga' => '130000'],
            ['kode_produk' => '016', 'nama' => 'Earphone Bluetooth', 'harga' => '110000'],
            ['kode_produk' => '017', 'nama' => 'Tripod Mini', 'harga' => '27000'],
            ['kode_produk' => '018', 'nama' => 'Speaker Portable', 'harga' => '90000'],
            ['kode_produk' => '019', 'nama' => 'Lampu LED Belajar', 'harga' => '45000'],
            ['kode_produk' => '020', 'nama' => 'Notebook Spiral', 'harga' => '6000'],
            ['kode_produk' => '021', 'nama' => 'Stabilo Warna Neon', 'harga' => '8000'],
            ['kode_produk' => '022', 'nama' => 'Tipe-X Roller', 'harga' => '6500'],
            ['kode_produk' => '023', 'nama' => 'Pencil 2B', 'harga' => '2500'],
            ['kode_produk' => '024', 'nama' => 'Baterai AA Isi 2', 'harga' => '12000'],
            ['kode_produk' => '025', 'nama' => 'Gembok Kombinasi', 'harga' => '18000'],
            ['kode_produk' => '026', 'nama' => 'Raket Nyamuk', 'harga' => '32000'],
            ['kode_produk' => '027', 'nama' => 'Obeng Set Mini', 'harga' => '29000'],
            ['kode_produk' => '028', 'nama' => 'Tang Potong Kecil', 'harga' => '31000'],
            ['kode_produk' => '029', 'nama' => 'Meteran Gulung 3M', 'harga' => '17000'],
            ['kode_produk' => '030', 'nama' => 'Kunci L Set', 'harga' => '22000'],
            ['kode_produk' => '031', 'nama' => 'Handuk Mandi', 'harga' => '45000'],
            ['kode_produk' => '032', 'nama' => 'Botol Minum 1L', 'harga' => '30000'],
            ['kode_produk' => '033', 'nama' => 'Payung Lipat', 'harga' => '40000'],
            ['kode_produk' => '034', 'nama' => 'Gelas Plastik Set', 'harga' => '25000'],
            ['kode_produk' => '035', 'nama' => 'Sapu Lidi', 'harga' => '15000'],
            ['kode_produk' => '036', 'nama' => 'Tempat Pensil Besi', 'harga' => '12000'],
            ['kode_produk' => '037', 'nama' => 'Kursi Lipat', 'harga' => '80000'],
            ['kode_produk' => '038', 'nama' => 'Kipas Angin Mini', 'harga' => '55000'],
            ['kode_produk' => '039', 'nama' => 'Jam Dinding', 'harga' => '70000'],
            ['kode_produk' => '040', 'nama' => 'Tempat Sampah Mini', 'harga' => '16000'],
            ['kode_produk' => '041', 'nama' => 'Pisau Cutter Besar', 'harga' => '10000'],
            ['kode_produk' => '042', 'nama' => 'Binder Klip', 'harga' => '6000'],
            ['kode_produk' => '043', 'nama' => 'Amplop Coklat A4', 'harga' => '4000'],
            ['kode_produk' => '044', 'nama' => 'Lakban Bening', 'harga' => '9000'],
            ['kode_produk' => '045', 'nama' => 'Kertas Origami 100 Lbr', 'harga' => '8000'],
            ['kode_produk' => '046', 'nama' => 'Senter LED Mini', 'harga' => '15000'],
            ['kode_produk' => '047', 'nama' => 'Kacamata Safety', 'harga' => '25000'],
            ['kode_produk' => '048', 'nama' => 'Obat Nyamuk Elektrik', 'harga' => '23000'],
            ['kode_produk' => '049', 'nama' => 'Wadah Serbaguna', 'harga' => '12000'],
            ['kode_produk' => '050', 'nama' => 'Cermin Dinding', 'harga' => '28000'],
        ]);
    }
}
