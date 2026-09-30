<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'nama',
        'no_rekam_medis',
        'alamat',
        'tanggal_lahir',
    ];
}
