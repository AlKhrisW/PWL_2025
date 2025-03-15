<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1, 
                'kategori_id' => 1,
                'barang_kode' => 'MKN001', 
                'barang_nama' => 'Nasi Goreng', 
                'harga_beli' => 10000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 2, 
                'kategori_id' => 1,
                'barang_kode' => 'MKN002', 
                'barang_nama' => 'Mie Goreng', 
                'harga_beli' => 5000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 3, 
                'kategori_id' => 2,
                'barang_kode' => 'MNM001', 
                'barang_nama' => 'Teh Botol', 
                'harga_beli' => 2000,
                'harga_jual' => 4000,
            ],
            [
                'barang_id' => 4, 
                'kategori_id' => 2,
                'barang_kode' => 'MNM002', 
                'barang_nama' => 'Aqua', 
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
            [
                'barang_id' => 5, 
                'kategori_id' => 3,
                'barang_kode' => 'PKN001', 
                'barang_nama' => 'Kemeja', 
                'harga_beli' => 50000,
                'harga_jual' => 70000,
            ],
            [
                'barang_id' => 6, 
                'kategori_id' => 3,
                'barang_kode' => 'PKN002', 
                'barang_nama' => 'Celana', 
                'harga_beli' => 70000,
                'harga_jual' => 100000,
            ],
            [
                'barang_id' => 7, 
                'kategori_id' => 4,
                'barang_kode' => 'ATK001', 
                'barang_nama' => 'Pensil', 
                'harga_beli' => 1000,
                'harga_jual' => 2000,
            ],
            [
                'barang_id' => 8, 
                'kategori_id' => 4,
                'barang_kode' => 'ATK002', 
                'barang_nama' => 'Buku Tulis', 
                'harga_beli' => 5000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 9, 
                'kategori_id' => 5,
                'barang_kode' => 'MIN001', 
                'barang_nama' => 'Lego', 
                'harga_beli' => 20000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 10, 
                'kategori_id' => 5,
                'barang_kode' => 'MIN002', 
                'barang_nama' => 'Boneka', 
                'harga_beli' => 30000,
                'harga_jual' => 40000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
