<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangTransaksiController;
use App\Http\Controllers\PengaturanAkunController;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\ImportDataController;
use App\Http\Controllers\TataLetakBarangController;
use App\Http\Livewire\AturanAsosiasi\HitungPolaTataLetak;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//php artisan config:clear
//php artisan config:cache
//php artisan route:cache
//php artisan view:clear
//php artisan view:cache
//php artisan cache:clear
//php artisan optimize:clear
//composer remove vendor/package
//https://laravel.com/docs/9.x/controllers#restful-partial-resource-routes

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes([
    'register' => false,
]);
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::resource('/transaksi', TransaksiController::class)->except(['show']);
        Route::post('/tb/barang/store', [BarangTransaksiController::class, 'barangStore'])->name('tb.barang.store');
        Route::post('/tb/transaksi/store', [BarangTransaksiController::class, 'transaksiStore'])->name('tb.transaksi.store');

        Route::get('/export/transaksi', [ExportDataController::class, 'transaksiExport'])->name('export.transaksi');
        Route::post('/import/transaksi', [ImportDataController::class, 'transaksiImport'])->name('import.transaksi');

        // PENGATURAN AKUN
        Route::get('/pengaturan-akun', [PengaturanAkunController::class, 'index'])->name('pengaturan.akun');
        Route::put('/ubah-foto-profil', [PengaturanAkunController::class, 'ubahFotoProfil'])->name('ubah.foto.profil');
        Route::get('/edit-profil', [PengaturanAkunController::class, 'editProfil'])->name('edit.profil');
        Route::put('/update-profil', [PengaturanAkunController::class, 'updateProfil'])->name('update.profil');
        Route::put('/ubah-password', [PengaturanAkunController::class, 'ubahPassword'])->name('ubah.password');
        // END PENGATURAN AKUN

        // TATA LETAK BARANG
        Route::resource('/tata-letak-barang', TataLetakBarangController::class)->only(['create', 'store']);
        Route::get('/pola-penjualan-produk-hasil-perhitungan', HitungPolaTataLetak::class)->name('hitung'); //livewire
        // END TATA LETAK BARANG

        // Expor tData
        Route::get('/rule-2-itemset/cetak', [ExportDataController::class, 'cetak_2_item'])->name('cetak.2.item');
        Route::get('/rule-3-itemset/cetak', [ExportDataController::class, 'cetak_3_item'])->name('cetak.3.item');
        // END Expor tData
    }
);
