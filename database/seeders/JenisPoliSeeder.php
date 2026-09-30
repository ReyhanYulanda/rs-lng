<?php

namespace Database\Seeders;

use App\Models\JenisPoli;
use Illuminate\Database\Seeder;

class JenisPoliSeeder extends Seeder
{
    public function run(): void
    {
        $jenisPolis = [
            'Poli Umum',
            'Poli Gigi',
            'Poli Anak',
            'Poli Penyakit Dalam',
            'Poli Kandungan',
        ];

        foreach ($jenisPolis as $nama) {
            JenisPoli::firstOrCreate(['nama' => $nama]);
        }
    }
}