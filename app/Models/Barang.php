<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = [
        'id', 'jenis_bahan_bangunan', 'created_at', 'updated_at',
    ];

    // public $incrementing = false;

    public function transaksi_barang()
    {
        // one to many, 1 banrang mendapatkan banyak TransaksiBarang
        // return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
        // https://laravel.com/docs/9.x/eloquent-relationships#one-to-many-inverse
        return $this->hasMany(TransaksiBarang::class, 'barang_id', 'id');
    }
}
