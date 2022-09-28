<?php

namespace App\Http\Controllers;

use App\Models\Hitung;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TataLetakBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * Source : https: //www.codegrepper.com/code-examples/php/min+and+max+in+laravel+eloquent
         * Source : https://jagowebdev.com/fungsi-time-strtotime-mktime-pada-php/
         */
        $tanggal_awal = Transaksi::min('tgl_transaksi');
        $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal));


        $tanggal_akhir = Transaksi::max('tgl_transaksi');
        $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir));
        return view('tata_letak_barang.create', compact('tanggal_awal', 'tanggal_akhir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('hitung')->delete();

        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'min' => 'Terjadi error, :attribute minimal :min % (persen)',
            'max' => 'Terjadi error, :attribute maksimal :max % (persen)',
            'numeric' => 'Terjadi error, :attribute harus berupa numeric!',
            'date' => 'Terjadi error, :attribute harus berupa tanggal!',
            'after_or_equal' => 'Terjadi error, :attribute harus diisi diatas tanggal awal',
            //https://laravel.com/docs/9.x/validation#rule-before
        ];
        $validator = Validator::make($request->all(), [
            'tanggal_awal'   => ['required', 'date'],
            'tanggal_akhir'  => ['required', 'date', 'after_or_equal:tanggal_awal'],
            'min_support'    => ['required', 'numeric', 'min:1', 'max:100'],
            'min_confidence' => ['required', 'numeric', 'min:1', 'max:100'],
        ], $messages);

        if ($validator->fails()) {
            // Alert::toast($validator->messages()->all()[0], 'error');
            /**
             *
             * https://stackoverflow.com/questions/35421088/get-error-message-from-laravel-validation
             */
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $hitung = new Hitung();
        $hitung->tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $hitung->tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        $hitung->min_support = $request->min_support;
        $hitung->min_confidence = $request->min_confidence;
        $hitung->save();
        return redirect()->route('hitung');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
