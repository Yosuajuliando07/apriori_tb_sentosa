<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBarang extends Model
{
    use HasFactory;

    protected $table = 'transaksi_barang';
    protected $fillable = [
        'id', 'kode_transaksi', 'tgl_transaksi', 'jenis_bahan_bangunan', 'barang_id', 'transaksi_id', 'created_at',  'updated_at',
    ];

    // public $incrementing = false;

    public function transaksi()
    {
        // return $this->hasOne(Transaksi::class, 'id', 'transaksi_id');
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function barang()
    {
        // return $this->belongsTo(User::class, 'foreign_key', 'owner_key');
        // https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse
        return $this->belongsTo(Barang::class, 'transaksi_id');
    }
}
