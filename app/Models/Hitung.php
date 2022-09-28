<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hitung extends Model
{
    use HasFactory;

    protected $table = 'hitung';
    protected $fillable = [
        'id', 'tanggal_awal', 'tanggal_akhir', 'min_support', 'min_confidence', 'created_at', 'updated_at',
    ];

    public function aturan_asosiasi_2_items()
    {
        return $this->hasOne(AturanAsosiasi2item::class);
    }
    public function aturan_asosiasi_3_items()
    {
        return $this->hasOne(AturanAsosiasi3item::class);
    }
}
