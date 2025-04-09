<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) { // perulangan untuk 10 transaksi
            $itemDipilih = array_rand(range(1, 10), 3); // memilih 3 item secara random untuk setiap transaksi
            foreach ($itemDipilih as $index) {
                $barang_id = $index + 1; // ubah index ke barang_id + 1
                $harga = DB::table('m_barang')->where('barang_id', $barang_id)->value('harga_jual'); // mengambil harga dari tabel m_barang pada database
                $data[] = [
                    'detail_id' => count($data) + 1, // mengisi detail_id dengan jumlah data yang telah diinput ditambah 1
                    'barang_id' => $barang_id, // id barang yang dipilih
                    'penjualan_id' => $i, // id penjualan
                    'harga' => $harga, // harga yang didapatkan sebelumnya
                    'jumlah' => rand(1, 3), // jumlah barang yang dibeli
                    'created_at' => now(),
                ];
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
