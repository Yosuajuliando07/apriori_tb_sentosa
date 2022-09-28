<?php

namespace App\Exports;

use App\Models\TransaksiBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TransaksiExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles

{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $tglAwal  = request()->input('filterTglAwal');
        $tglakhir = request()->input('filterTglAkhir');


        //MENGUBAH TANGGAL SEPERTI DEFAULT DI DATABASE
        $filterTglAwal = date('Y-m-d', strtotime($tglAwal));
        $filterTglAkhir = date('Y-m-d', strtotime($tglakhir));

        return TransaksiBarang::whereBetween('tgl_transaksi', [$filterTglAwal, $filterTglAkhir])->get();
    }

    public function map($transaksiBarang): array
    {
        $format_tanggal = date('d/m/Y', strtotime($transaksiBarang->tgl_transaksi));
        return [
            $transaksiBarang->kode_transaksi,
            $format_tanggal,
            $transaksiBarang->jenis_bahan_bangunan,
        ];
    }

    public function headings(): array
    {
        return [
            // 'NO',
            'KODE TRANSAKSI',
            'TANGGAL TRANSAKSI',
            'JENIS BAHAN BANGUNAN',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true],],


            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }

    // public function registerEvents(): array
    // {
    //     // https://docs.laravel-excel.com/3.1/exports/extending.html
    //     // https://www.itsolutionstuff.com/post/laravel-maatwebsite-set-background-color-of-column-exampleexample.html
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             //getDelegate() mengembalikan kelas PhpSpreadsheet yang mendasarinya.

    //             $event->sheet->getDelegate()->getStyle('A1:D1')
    //                 ->getFill()
    //                 ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    //                 ->getStartColor()
    //                 ->setARGB('ebebeb');
    //         },
    //     ];
    // }
}
