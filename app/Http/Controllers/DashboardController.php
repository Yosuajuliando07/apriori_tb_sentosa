<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // https://dev.to/kingsconsult/how-to-create-laravel-8-helpers-function-global-function-d8n

    public function dashboard()
    {

        // $var = [];
        // $data = ['merah', 'kuning', 'hijau', 'biru', 'hitam', 'ungu'];
        // // dd(count($a));

        // for ($a = 0; $a < count($data); $a++) {
        //     for ($b = $a + 1; $b < count($data); $b++) {
        //         for ($c = $b + 1; $c < count($data); $c++) {
        //             $var[] = $data[$a]  . ', ' .  $data[$b] . ', ' .  $data[$c];
        //         }
        //     }
        // }


        // dd($var);
        // $transaksi = Transaksi::all();
        // $var = [];
        // foreach ($transaksi as $key => $value) {
        //     foreach ($value->transaksi_barang as $e => $val) {
        //         $var[] = $val->transaksi_id;
        //     }
        // }


        // dd($var);
        // $string = 'Here is my sentence.  There are  double spaces.';
        // $newString = Str::of($string)->replaceMatches('/ {2,}/', ' ');
        // dd($newString);

        // reference : https://laravel.com/docs/9.x/collections#method-countBy
        $transaksiAll = TransaksiBarang::pluck('jenis_bahan_bangunan');
        $all = collect($transaksiAll);
        $counted = $all->countBy();
        $collection = collect($counted->all());

        // reference: https://laravel.com/docs/9.x/collections#method-sortdesc
        // reference: https://laravel.com/docs/9.x/collections#method-take
        $collection = collect($collection);
        $sorted = $collection->sortDesc()->take(10);
        $sorted->values()->all();
        // $chunk = $collection->take(3);
        // dd($sorted);

        /**
         * reference : https://onlinewebtutorblog.com/line-graph-integration-with-laravel-8-tutorial-example/
         * reference : https://www.highcharts.com/docs/chart-concepts/series
         */
        $cahartPenjualanTerlaris = [];
        foreach ($sorted as $key => $kuntitas) {
            $cahartPenjualanTerlaris[] = [
                "name" => $key,
                "y" => $kuntitas,
            ];
        }
        // dd($cahartPenjualanTerlaris);
        // $collection = collect($collection);
        // $sortedkeeps = $collection->sort();
        // dd($sortedkeeps);


        $min = TransaksiBarang::min('tgl_transaksi');
        $max = TransaksiBarang::max('tgl_transaksi');

        $tglAwal = Carbon::parse($min)->isoFormat('D MMMM Y');
        $tglAkhir = Carbon::parse($max)->isoFormat('D MMMM Y');

        $transaksiCount = count(TransaksiBarang::all());
        $barangCount = count(Barang::all());


        // $slice = Str::before('Grendel Jendela', ' ');
        // $count = Str::substrCount('Grendel Jendela,Grendel Pintu', $slice);
        // dd($count);
        /**
         * https://laravel.com/docs/9.x/helpers#method-str-squish
         * Metode Str::squish menghapus semua spasi putih asing dari sebuah string, termasuk spasi putih asing di antara kata-kata:
         * $string = Str::squish('    laravel    framework    ');
         */

        // dd($transaksiCount);
        // $slice = Str::before('This is my name', 'my name');

        return view('dashboard', [
            'chart_terlaris' => $cahartPenjualanTerlaris,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'transaksiCount' => $transaksiCount,
            'barangCount' => $barangCount,
        ]);
    }
}
