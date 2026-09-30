<?php

namespace Database\Seeders;

use App\Models\Biaya;
use App\Models\Pasien;
use Illuminate\Database\Seeder;
use RuntimeException;

class BiayaSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = Pasien::orderBy('id')->get();

        if ($pasiens->isEmpty()) {
            throw new RuntimeException('Seed pasien sebelum menjalankan BiayaSeeder.');
        }

        $biayas = [
            ['pasien' => 0, 'dokter' => 75000, 'obat' => 35000, 'administrasi' => 15000, 'lainnya' => 0, 'status' => 'Lunas'],
            ['pasien' => 1, 'dokter' => 80000, 'obat' => 45000, 'administrasi' => 15000, 'lainnya' => 10000, 'status' => 'Lunas'],
            ['pasien' => 2, 'dokter' => 60000, 'obat' => 28000, 'administrasi' => 12000, 'lainnya' => 0, 'status' => 'Belum Lunas'],
            ['pasien' => 3, 'dokter' => 90000, 'obat' => 55000, 'administrasi' => 15000, 'lainnya' => 20000, 'status' => 'Lunas'],
            ['pasien' => 4, 'dokter' => 85000, 'obat' => 40000, 'administrasi' => 15000, 'lainnya' => 5000, 'status' => 'Belum Lunas'],
            ['pasien' => 0, 'dokter' => 50000, 'obat' => 22000, 'administrasi' => 10000, 'lainnya' => 0, 'status' => 'Lunas'],
            ['pasien' => 1, 'dokter' => 70000, 'obat' => 30000, 'administrasi' => 12000, 'lainnya' => 8000, 'status' => 'Belum Lunas'],
            ['pasien' => 2, 'dokter' => 95000, 'obat' => 60000, 'administrasi' => 15000, 'lainnya' => 10000, 'status' => 'Lunas'],
            ['pasien' => 3, 'dokter' => 65000, 'obat' => 25000, 'administrasi' => 12000, 'lainnya' => 0, 'status' => 'Lunas'],
            ['pasien' => 4, 'dokter' => 100000, 'obat' => 72000, 'administrasi' => 18000, 'lainnya' => 15000, 'status' => 'Belum Lunas'],
            ['pasien' => 0, 'dokter' => 55000, 'obat' => 18000, 'administrasi' => 10000, 'lainnya' => 5000, 'status' => 'Lunas'],
            ['pasien' => 1, 'dokter' => 88000, 'obat' => 42000, 'administrasi' => 15000, 'lainnya' => 0, 'status' => 'Lunas'],
            ['pasien' => 2, 'dokter' => 72000, 'obat' => 33000, 'administrasi' => 12000, 'lainnya' => 7000, 'status' => 'Belum Lunas'],
            ['pasien' => 3, 'dokter' => 110000, 'obat' => 68000, 'administrasi' => 18000, 'lainnya' => 12000, 'status' => 'Lunas'],
            ['pasien' => 4, 'dokter' => 78000, 'obat' => 37000, 'administrasi' => 12000, 'lainnya' => 3000, 'status' => 'Belum Lunas'],
        ];

        foreach ($biayas as $biaya) {
            $pasien = $pasiens[$biaya['pasien'] % $pasiens->count()];
            $rincian = [
                'biaya_dokter' => $biaya['dokter'],
                'biaya_obat' => $biaya['obat'],
                'biaya_administrasi' => $biaya['administrasi'],
                'biaya_lainnya' => $biaya['lainnya'],
            ];

            Biaya::firstOrCreate(
                ['id_pasien' => $pasien->id] + $rincian,
                $rincian + [
                    'jumlah' => array_sum($rincian),
                    'status' => $biaya['status'],
                ],
            );
        }
    }
}