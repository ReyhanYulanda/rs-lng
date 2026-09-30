<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'no_rekam_medik',
        'nama',
        'tanggal_lahir',
        'alamat',
    ];
}
