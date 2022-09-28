<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'id', 'kode_transaksi', 'tgl_transaksi', 'created_at', 'updated_at',
    ];

    // public $incrementing = false;
    // public $timestamps = false;


    public function transaksi_barang()
    {
        //one to many, 1 transaksi mendapatkan banyak TransaksiBarang
        // return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
        // https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse
        return $this->hasMany(TransaksiBarang::class, 'transaksi_id', 'id');
    }
}
