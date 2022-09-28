<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $transaksi = Transaksi::latest()->get();

        // $data_transaksi = [];
        // foreach ($transaksi as $key => $trans) {
        //     foreach ($trans->transaksi_barang as $k => $tb) {
        //         $data_transaksi[] = [
        //             "kode_transaksi" => $trans->kode_transaksi,
        //             "tgl_transaksi" => $trans->tgl_transaksi,
        //             "jenis_bahan_bangunan" => $tb->jenis_bahan_bangunan,
        //         ];
        //     }
        // }
        // dd($data_transaksi);
        //compact('data_transaksi')

        if ($request->ajax()) {
            $model  = TransaksiBarang::latest()->get();
            return DataTables::of($model)
                ->editColumn('kode_transaksi', function ($data) {
                    return $data->kode_transaksi;
                })
                ->editColumn('tgl_transaksi', function ($data) {
                    return date('d-m-Y', strtotime($data->tgl_transaksi));
                })
                ->editColumn('jenis_bahan_bangunan', function ($data) {
                    return $data->jenis_bahan_bangunan;
                })
                ->addColumn('action', function ($data) {
                    $tombolAksi = '<div class="table-actions">
									<a href="' . route('transaksi.edit', $data->id)  . '" data-color="#265ed7" style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
									<a type="button" name="delete" id="' . $data->id . '" data-color="#e95959" style="color: rgb(233, 89, 89);" class="delete"><i class="icon-copy dw dw-delete-3"></i></a>
								</div>';
                    return $tombolAksi;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        //  <a class="dropdown-item" href="' . route('transaksi.show', $data->id)  . '"><i class="dw dw-eye"></i> Lihat Detail</a>
        $tanggal_awal = TransaksiBarang::min('tgl_transaksi');
        $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal));


        $tanggal_akhir = TransaksiBarang::max('tgl_transaksi');
        $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir));
        return view('transaksi.index', compact('tanggal_awal', 'tanggal_akhir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        // dd($barang);
        $transaksi = Transaksi::all();
        return view('transaksi.create', compact('barang', 'transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'min' => 'Terjadi error, :attribute minimal :min ,terjadi error pada sistem',
            'numeric' => 'Terjadi error, :attribute harus berupa numeric ,terjadi error pada sistem',
            // 'max' => 'Terjadi error, :attribute maksimal :max % (persen)',
            //https://laravel.com/docs/9.x/validation#rule-before
        ];
        $validator = Validator::make($request->all(), [
            'jenis_bahan_bangunan' => ['required', 'min:1', 'numeric'], //value id
            'kode_transaksi'   => ['required', 'min:1', 'numeric'],
            // 'tgl_transaksi'  => ['required'],
            // 'barang_id' => ['required'],
            // 'transaksi_id' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            // Alert::toast($validator->messages()->all()[0], 'error');
            /**
             * https://stackoverflow.com/questions/35421088/get-error-message-from-laravel-validation
             */
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }

        $dataTransaksiBarang = new TransaksiBarang();
        $dataTransaksiBarang->barang_id = $request->jenis_bahan_bangunan;
        $dataTransaksiBarang->transaksi_id = $request->kode_transaksi;

        $tabelBarng = Barang::find($request->jenis_bahan_bangunan);
        $ambil_jns_bhn = $tabelBarng->jenis_bahan_bangunan;

        $dataTransaksiBarang->jenis_bahan_bangunan = $ambil_jns_bhn;

        $tabelTransaksi = Transaksi::find($request->kode_transaksi);
        $ambil_kode_trs = $tabelTransaksi->kode_transaksi;
        $ambil_tgl_transaksi = $tabelTransaksi->tgl_transaksi;

        $dataTransaksiBarang->kode_transaksi = $ambil_kode_trs;
        $dataTransaksiBarang->tgl_transaksi = $ambil_tgl_transaksi;
        // $dataTransaksiBarang->tgl_transaksi = date('Y-m-d', strtotime($request->tgl_transaksi));
        // dd($dataTransaksiBarang);

        $dataTransaksiBarang->save();
        Alert::toast('Data Behasil di Input!', 'success');
        return redirect()->route('transaksi.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::latest()->get();
        $transaksi = Transaksi::latest()->get();
        $transaksiBarang = TransaksiBarang::find($id);
        return view('transaksi.edit', compact('transaksi', 'barang', 'transaksiBarang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'min' => 'Terjadi error, :attribute minimal :min ,terjadi error pada sistem',
            'numeric' => 'Terjadi error, :attribute harus berupa numeric ,terjadi error pada sistem',
        ];
        $validator = Validator::make($request->all(), [
            'jenis_bahan_bangunan' => ['required', 'min:1', 'numeric'], //value id
            'kode_transaksi'   => ['required', 'min:1', 'numeric'],
        ], $messages);

        if ($validator->fails()) {
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }

        $dataTransaksiBarang = TransaksiBarang::find($id);
        $dataTransaksiBarang->barang_id = $request->jenis_bahan_bangunan;
        $dataTransaksiBarang->transaksi_id = $request->kode_transaksi;

        $tabelBarng = Barang::find($request->jenis_bahan_bangunan);
        $ambil_jns_bhn = $tabelBarng->jenis_bahan_bangunan;

        $dataTransaksiBarang->jenis_bahan_bangunan = $ambil_jns_bhn;

        $tabelTransaksi = Transaksi::find($request->kode_transaksi);
        $ambil_kode_trs = $tabelTransaksi->kode_transaksi;
        $ambil_tgl_transaksi = $tabelTransaksi->tgl_transaksi;

        $dataTransaksiBarang->kode_transaksi = $ambil_kode_trs;
        $dataTransaksiBarang->tgl_transaksi = $ambil_tgl_transaksi;

        $dataTransaksiBarang->save();
        Alert::toast('Data Behasil di Update!', 'success');
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksiBarang = TransaksiBarang::find($id);
        $jenis_bhn = $transaksiBarang->jenis_bahan_bangunan;
        $kode_transaksi = $transaksiBarang->kode_transaksi;
        $countJenisBahan = TransaksiBarang::where('jenis_bahan_bangunan', $jenis_bhn)->count();
        $countKodeTransaksi = TransaksiBarang::where('kode_transaksi', $kode_transaksi)->count();
        //jika jenis bahan bangunan hanya 1, delete di tabel barang

        if ($countJenisBahan == 1) {
            // $barang = Barang::where('jenis_bahan_bangunan', $jenis_bhn)->get();
            // https://laravel.com/docs/9.x/queries#delete-statements
            DB::table('barang')->where('jenis_bahan_bangunan', $jenis_bhn)->delete();
        }
        //jika jenis kode transaksi hanya 1, delete di tabel transaksi
        if ($countKodeTransaksi == 1) {
            // $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->get();
            // $transaksi->delete();
            DB::table('transaksi')->where('kode_transaksi', $kode_transaksi)->delete();
        }

        $transaksiBarang->delete();
        // return redirect()->back();
        return response()->json($transaksiBarang);
    }
}
