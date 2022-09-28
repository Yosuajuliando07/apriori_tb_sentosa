<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturanAkunController extends Controller
{
    public function index()
    {
        return view('pengaturan_akun.index');
    }

    public function ubahFotoProfil(Request $request)
    {
        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'mimes' => 'Terjadi error, :attribute harus berupa file gambar!',
        ];
        $validator = Validator::make($request->only('gambar'), [
            'gambar' => ['required', 'mimes:jpeg,png,jpg'],
        ], $messages);
        // dd($validator->messages()->all());
        if ($validator->fails()) {
            //[0] : array key 0
            //  array:1 [
            //      0 => "The gambar field is required."
            //      ]
            //https://gg.github.io/sweet-alert/middleware?id=middleware
            // Alert::toast($validator->messages()->all()[0], 'error');
            /**
             * Perbaikan!
             * https://stackoverflow.com/questions/35421088/get-error-message-from-laravel-validation
             */
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }

        $user = User::find(Auth::id());
        $file = $request->file('gambar');
        $namaFile  = Auth::user()->nama . "_" . uniqid() . "." . $file->getClientOriginalExtension();

        //cek direktori
        if (!Storage::disk('public')->exists('akun')) {
            Storage::disk('public')->makeDirectory('akun');
        }
        //hapus gambar jika bukan default
        //fungsi exists untuk memeriksa apakah file/record ada atau tidak, mengembalikan nilai true atau false
        if (Auth::user()->gambar != 'default.png') {
            if (Storage::disk('public')->exists('akun/' . $user->gambar)) {
                Storage::disk('public')->delete('akun/' . $user->gambar);
            }
        }
        $file->storeAs('public/akun', $namaFile);
        $user->gambar = $namaFile;
        $user->save();
        Alert::toast('Gambar Behasil di Ubah!', 'success');
        return redirect()->route('pengaturan.akun');
    }

    public function editProfil()
    {
        return view('pengaturan_akun.edit_profil');
    }

    public function updateProfil(Request $request)
    {
        $messages = [
            'required' => 'Terjadi error, :attribute tidak boleh kosong!',
            'min' => 'Terjadi error, :attribute minimal :min karakter!',
            'max' => 'Terjadi error, :attribute maksimal :max karakter!',
            'email' => 'Terjadi error, :attribute harus berupa email!',
            'string' => 'Terjadi error, :attribute harus berupa karakter!',

        ];
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'min:5', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50'],
        ], $messages);

        if ($validator->fails()) {
            // Alert::toast($validator->messages()->all()[0], 'error');
            /**
             * Perbaikan!
             * https://stackoverflow.com/questions/35421088/get-error-message-from-laravel-validation
             */
            Alert::toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $user = User::find(Auth::id());
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->save();
        Alert::toast('Data Behasil di Ubah!', 'success');
        return redirect()->route('pengaturan.akun');
    }

    public function ubahPassword(Request $request)
    {
        //Sumber : https://github.com/Cipfahim/Blog-System-in-Laravel/blob/master/app/Http/Controllers/Admin/SettingsController.php
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Alert::toast('Password berhasil diubah', 'success');
                // Auth::logout();
                return redirect()->back();
            } else {
                //jika password yang baru sama dengan password lama
                Alert::toast('Password baru tidak boleh sama dengan password yang lama.', 'error');
                return redirect()->back();
            }
        } else {
            //jika password lama tidak cocok atau tidak sesuai dengan yang ada di database
            Alert::toast('Password saat ini tidak cocok.', 'error');
            return redirect()->back();
        }
    }
}
