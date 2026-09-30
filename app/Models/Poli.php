<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = [
        'id_pasien', 
        'id_dokter', 
        'keluhan', 
        'jenis_poli', 
        'status', 
        'penyakit', 
        'catatan_medis'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
}
