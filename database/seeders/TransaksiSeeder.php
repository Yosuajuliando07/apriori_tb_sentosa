<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 8; $i++) {
            DB::table('transaksi')->insert([
                'kode_transaksi' => 'T000' . $i,
                'tgl_transaksi' => '2022-06-1' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
