<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use App\Models\AturanAsosiasi2item;
use App\Models\AturanAsosiasi3item;
use App\Models\Hitung;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use PDF;

class ExportDataController extends Controller
{
    public function transaksiExport()
    {
        // return Excel::download(new TransaksiExport, 'Organisasi.xlsx');
        // return (new TransaksiExport(['31-05-2019', '10-06-2019']))->download('invoices.xlsx');
        // dd($request->all());
        return Excel::download(new TransaksiExport(), 'Data_Transaksi.xlsx');
    }

    public function cetak_2_item()
    {
        $aturanAsosiasi = AturanAsosiasi2item::all();
        $find = Hitung::latest()->first();
        $tglAwal = Carbon::parse($find->tanggal_awal)->isoFormat('D MMMM Y');
        $tglAkhir = Carbon::parse($find->tanggal_akhir)->isoFormat('D MMMM Y');

        $pdf = FacadePdf::loadview('tata_letak_barang.cetak_2_item', compact('aturanAsosiasi', 'find', 'tglAwal', 'tglAkhir'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('aturan_asosiasi_2_item.pdf');
    }

    public function cetak_3_item()
    {
        $aturanAsosiasi = AturanAsosiasi3item::all();
        $find = Hitung::latest()->first();
        $tglAwal = Carbon::parse($find->tanggal_awal)->isoFormat('D MMMM Y');
        $tglAkhir = Carbon::parse($find->tanggal_akhir)->isoFormat('D MMMM Y');

        $pdf = FacadePdf::loadview('tata_letak_barang.cetak_3_item', compact('aturanAsosiasi', 'find', 'tglAwal', 'tglAkhir'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('aturan_asosiasi_3_item.pdf');
    }
}
