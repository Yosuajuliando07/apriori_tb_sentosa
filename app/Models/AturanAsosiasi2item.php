<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturanAsosiasi2item extends Model
{
    use HasFactory;
    protected $table = 'aturan_asosiasi_2_items';

    protected $fillable = [
        'id',
        'rule',
        'total_ab',
        'total_antecedent',
        'total_consequent',
        'antecedent_text',
        'consequent_text',
        'support_persen',
        'confidence_persen',
        'lift_ratio_text',
        'hitung_id',
        'created_at',
        'updated_at',
    ];

    public function hitung()
    {
        // return $this->belongsTo(User::class, 'foreign_key', 'owner_key');
        return $this->belongsTo(BahanAnalisa::class, 'hitung_id');
    }
}
