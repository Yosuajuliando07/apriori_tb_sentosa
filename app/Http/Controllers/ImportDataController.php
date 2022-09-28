<?php

namespace App\Http\Controllers;

use App\Imports\TransaksiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ImportDataController extends Controller
{
    public function transaksiImport(Request $request)
    {
        if ($request->file('file')) {
            Excel::import(new TransaksiImport(), request()->file('file'));
            return redirect()->back();
        }
    }
}
