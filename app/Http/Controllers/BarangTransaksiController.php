<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Barang;
use App\Models\Transaksi;

class BarangTransaksiController extends Controller
{
    public function barangStore(Request $request)
    {
        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'min' => 'Terjadi error, :attribute minimal :min karakter',
            'max' => 'Terjadi error, :attribute maksimal :max karakter',
            'unique' => 'Terjadi error, :attribute sudah ada',
            'string' => 'Terja error pada sistem'
        ];
        $validator = Validator::make($request->all(), [
            'jenis_bahan_bangunan' => ['required', 'min:3', 'max:255', 'unique:barang', 'string'],
        ], $messages);
        if ($validator->fails()) {
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $barang = new Barang();
        $barang->jenis_bahan_bangunan = $request->jenis_bahan_bangunan;
        $barang->save();
        Alert::toast('Data Behasil di Input!', 'success');
        return redirect()->back();
    }

    public function transaksiStore(Request $request)
    {
        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'min' => 'Terjadi error, :attribute minimal :min karakter',
            'max' => 'Terjadi error, :attribute maksimal :max karakter',
            'unique' => 'Terjadi error, :attribute sudah ada',
            'string' => 'Terjadi error pada sistem',
            'date' => 'Terjadi error, :attribute harus berupa tanggal!',
        ];
        $validator = Validator::make($request->all(), [
            'kode_transaksi' => ['required', 'min:10', 'max:30', 'unique:transaksi', 'string'],
            'tanggal_transaksi' => ['required', 'date'],
        ], $messages);
        if ($validator->fails()) {
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $request->kode_transaksi;
        $transaksi->tgl_transaksi = date('Y-m-d', strtotime($request->tanggal_transaksi));
        $transaksi->save();
        Alert::toast('Data Behasil di Input!', 'success');
        return redirect()->back();
    }
}
