<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiBarang;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

// WithCustomStartCell
class TransaksiImport implements OnEachRow, WithStartRow, WithBatchInserts, WithChunkReading
{
    use Importable;

    //https://benborgers.com/posts/laravel-double-spaces#:~:text=Here's%20how%20you%20can%20use,%2C%7D%2F'%2C%20'%20')%3B

    // private $barang;
    // public function __construct()
    // {
    //     $this->barang = Barang::select('id', 'jenis_bahan_bangunan')->get();
    // }
    public function onRow(Row $row)
    {
        //https://stackoverflow.com/questions/57940973/skip-duplicate-row-when-import-excel
        //https://docs.laravel-excel.com/3.1/imports/model.html#handling-persistence-on-your-own
        $row = $row->toArray();

        //firstOrCreate
        //https://www.khairu-aqsara.net/blog/fungsi-firstor-dan-updateor-pada-laravel
        // cari data barang berdasarkan jenis_bahan_bangunan
        // , jika tidak ada maka buat satu record baru dengan ejenis_bahan_bangunan yang menjadi parameter,
        // tetapi bagaimana jika data yang akan disimpan ternyata berbeda ? kita bisa menambahkan parameter baru berbentuk array, misalnya seperti
        $barangNoduplikat  = Barang::firstOrCreate([
            'jenis_bahan_bangunan' => $row[3],
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);
        $transaksiNoduplikat  = Transaksi::firstOrCreate([
            'kode_transaksi' => $row[1], //dimulai dari 0
            'tgl_transaksi' => SharedDate::excelToDateTimeObject($row[2])->format('Y-m-d'),
            // date('Y-m-d', strtotime($row[2]))
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);
        //Gunakan atribut model "wasRecentlyCreated" untuk memeriksa apakah model Anda dibuat atau ditemukan
        if (!$barangNoduplikat->wasRecentlyCreated && !$transaksiNoduplikat->wasRecentlyCreated) {
            $barangNoduplikat->update([
                'jenis_bahan_bangunan' => $row[3],
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
            $transaksiNoduplikat->update([
                'kode_transaksi' => $row[1],
                'tgl_transaksi' => SharedDate::excelToDateTimeObject($row[2])->format('Y-m-d'),
                // 'created_at' => now(),
                // 'updated_at' => now(),

            ]);
        }


        // $data = [];
        // $barang = $this->barang->where('jenis_bahan_bangunan', $row[3])->first();

        $barang = Barang::where('jenis_bahan_bangunan', $row[3])->first();
        $transaksi = Transaksi::where('kode_transaksi', $row[1])->first();

        // dd($barang);
        TransaksiBarang::create(
            [
                'kode_transaksi' => $row[1],
                'tgl_transaksi' => SharedDate::excelToDateTimeObject($row[2])->format('Y-m-d'),
                'jenis_bahan_bangunan' => $row[3],
                // mengembalikan operan pertamanya jika ada dan bukan NULL; jika tidak, ia mengembalikan operan keduanya.
                // https://laracasts.com/discuss/channels/general-discussion/blade-if-else-on-single-line
                // https://www.php.net/manual/en/migration70.new-features.php
                'barang_id' => $barang->id ?? NULL,
                'transaksi_id' => $transaksi->id ?? NULL,
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]
        );

        // }
        //https://benborgers.com/posts/laravel-double-spaces
        // $string = 'Here is my sentence.  There are  double spaces.';
        // $newString = Str::of($string)->replaceMatches('/ {2,}/', ' ');
    }
    // public function collection(Collection $rows)
    // {
    //     // Validator::make($rows->toArray(), [
    //     //     '*.0' => 'required',
    //     // ])->validate();


    //     // foreach ($rows as $row) {
    //     //     $collection = collect([$row[3]]);
    //     //     $unique = $collection->unique();
    //     //     $data = $unique->values()->all();

    //     //     Barang::create([
    //     //         'jenis_bahan_bangunan' => $data,
    //     //     ]);
    //     // }
    // }
    // use Importable;

    // public function model(array $row)
    // {

    //     $data = Barang::where('jenis_bahan_bangunan', '!=', $row[3])->get();
    //     // dd($data);
    //     return new Barang([
    //         'jenis_bahan_bangunan' => $row[3],
    //         'created_at' => now(),
    //         'updated_at' => now(),

    //         // 'tgl_transaksi' => date('Y-m-d', strtotime($row[1])),
    //         // 'kode_transaksi_id' => $row[2],
    //         // 'jenis_barang' => $row[3],
    //     ]);
    // }

    // public function rules(): array
    // {
    //     return [
    //         '3' => 'required|string',
    //     ];
    // }

    //https://docs.laravel-excel.com/3.1/imports/mapped-cells.html
    //https://stackoverflow.com/questions/56726778/how-to-skip-first-row-when-importing-file
    public function startRow(): int
    {
        return 3;
    }
    //https://docs.laravel-excel.com/3.1/imports/batch-inserts.html
    /**
     * This concern only works with the ToModel concern.
     */
    public function batchSize(): int
    {
        return 1000;
    }
    //https://docs.laravel-excel.com/3.1/imports/chunk-reading.html
    public function chunkSize(): int
    {
        return 1000;
    }
    //https://docs.laravel-excel.com/3.1/exports/collection.html#custom-start-cell
    // public function startCell(): string
    // {
    //     return 'B1';
    // }
    // https://docs.laravel-excel.com/3.1/imports/validation.html


}
