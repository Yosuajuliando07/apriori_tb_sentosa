<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            'jenis_bahan_bangunan' => 'Apel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('barang')->insert([
            'jenis_bahan_bangunan' => 'Mangga',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('barang')->insert([
            'jenis_bahan_bangunan' => 'Nasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('barang')->insert([
            'jenis_bahan_bangunan' => 'Ayam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('barang')->insert([
            'jenis_bahan_bangunan' => 'Pisang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('barang')->insert([
            'jenis_bahan_bangunan' => 'Susu',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
