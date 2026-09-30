<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    protected $fillable = [
        'id_pasien',
        'biaya_dokter',
        'biaya_obat',
        'biaya_administrasi',
        'biaya_lainnya',
        'jumlah',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
