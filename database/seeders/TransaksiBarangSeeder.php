<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0001',
            'tgl_transaksi' => '2022-06-11',
            'jenis_bahan_bangunan' => 'Apel',
            'barang_id' => 1,
            'transaksi_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0001',
            'tgl_transaksi' => '2022-06-11',
            'jenis_bahan_bangunan' => 'Mangga',
            'barang_id' => 2,
            'transaksi_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0001',
            'tgl_transaksi' => '2022-06-11',
            'jenis_bahan_bangunan' => 'Nasi',
            'barang_id' => 3,
            'transaksi_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0001',
            'tgl_transaksi' => '2022-06-11',
            'jenis_bahan_bangunan' => 'Ayam',
            'barang_id' => 4,
            'transaksi_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0002',
            'tgl_transaksi' => '2022-06-12',
            'jenis_bahan_bangunan' => 'Apel',
            'barang_id' => 1,
            'transaksi_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0002',
            'tgl_transaksi' => '2022-06-12',
            'jenis_bahan_bangunan' => 'Mangga',
            'barang_id' => 2,
            'transaksi_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0002',
            'tgl_transaksi' => '2022-06-12',
            'jenis_bahan_bangunan' => 'Nasi',
            'barang_id' => 3,
            'transaksi_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0003',
            'tgl_transaksi' => '2022-06-13',
            'jenis_bahan_bangunan' => 'Apel',
            'barang_id' => 1,
            'transaksi_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0003',
            'tgl_transaksi' => '2022-06-13',
            'jenis_bahan_bangunan' => 'Mangga',
            'barang_id' => 2,
            'transaksi_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0004',
            'tgl_transaksi' => '2022-06-14',
            'jenis_bahan_bangunan' => 'Apel',
            'barang_id' => 1,
            'transaksi_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0004',
            'tgl_transaksi' => '2022-06-14',
            'jenis_bahan_bangunan' => 'Pisang',
            'barang_id' => 5,
            'transaksi_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0005',
            'tgl_transaksi' => '2022-06-15',
            'jenis_bahan_bangunan' => 'Mangga',
            'barang_id' => 2,
            'transaksi_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0005',
            'tgl_transaksi' => '2022-06-15',
            'jenis_bahan_bangunan' => 'Nasi',
            'barang_id' => 3,
            'transaksi_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0005',
            'tgl_transaksi' => '2022-06-15',
            'jenis_bahan_bangunan' => 'Ayam',
            'barang_id' => 4,
            'transaksi_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0005',
            'tgl_transaksi' => '2022-06-15',
            'jenis_bahan_bangunan' => 'Susu',
            'barang_id' => 6,
            'transaksi_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0006',
            'tgl_transaksi' => '2022-06-16',
            'jenis_bahan_bangunan' => 'Mangga',
            'barang_id' => 2,
            'transaksi_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0006',
            'tgl_transaksi' => '2022-06-16',
            'jenis_bahan_bangunan' => 'Nasi',
            'barang_id' => 3,
            'transaksi_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0006',
            'tgl_transaksi' => '2022-06-16',
            'jenis_bahan_bangunan' => 'Susu',
            'barang_id' => 6,
            'transaksi_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0007',
            'tgl_transaksi' => '2022-06-17',
            'jenis_bahan_bangunan' => 'Mangga',
            'barang_id' => 2,
            'transaksi_id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0007',
            'tgl_transaksi' => '2022-06-17',
            'jenis_bahan_bangunan' => 'Susu',
            'barang_id' => 6,
            'transaksi_id' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===========================================

        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0008',
            'tgl_transaksi' => '2022-06-18',
            'jenis_bahan_bangunan' => 'Pisang',
            'barang_id' => 5,
            'transaksi_id' => 8,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('transaksi_barang')->insert([
            'kode_transaksi' => 'T0008',
            'tgl_transaksi' => '2022-06-18',
            'jenis_bahan_bangunan' => 'Susu',
            'barang_id' => 6,
            'transaksi_id' => 8,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
