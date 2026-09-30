<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            [
                'no_rekam_medis' => 'RM-2026-0001',
                'nama' => 'Ahmad Fauzi',
                'alamat' => 'Jl. Merdeka No. 12, Badak LNG',
                'tanggal_lahir' => '1985-04-12',
            ],
            [
                'no_rekam_medis' => 'RM-2026-0002',
                'nama' => 'Nur Aisyah',
                'alamat' => 'Jl. Pendidikan No. 8, Bontang',
                'tanggal_lahir' => '1992-09-23',
            ],
            [
                'no_rekam_medis' => 'RM-2026-0003',
                'nama' => 'Muhammad Rizky',
                'alamat' => 'Jl. Tanjung Laut No. 15, Bontang',
                'tanggal_lahir' => '2015-02-05',
            ],
            [
                'no_rekam_medis' => 'RM-2026-0004',
                'nama' => 'Dewi Anggraini',
                'alamat' => 'Jl. Ahmad Yani No. 21, Bontang',
                'tanggal_lahir' => '1978-11-30',
            ],
            [
                'no_rekam_medis' => 'RM-2026-0005',
                'nama' => 'Rudi Hartono',
                'alamat' => 'Jl. Gunung Sari No. 4, Bontang',
                'tanggal_lahir' => '2001-07-18',
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::firstOrCreate(
                ['no_rekam_medis' => $pasien['no_rekam_medis']],
                [
                    'nama' => $pasien['nama'],
                    'alamat' => $pasien['alamat'],
                    'tanggal_lahir' => $pasien['tanggal_lahir'],
                ],
            );
        }
    }
}