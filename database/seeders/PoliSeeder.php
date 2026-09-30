<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\JenisPoli;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Database\Seeder;
use RuntimeException;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = Pasien::orderBy('id')->get();
        $dokters = Dokter::orderBy('id')->get();
        $jenisPolis = JenisPoli::orderBy('id')->get();

        if ($pasiens->isEmpty() || $dokters->isEmpty() || $jenisPolis->isEmpty()) {
            throw new RuntimeException('Seed pasien, dokter, dan jenis poli sebelum menjalankan PoliSeeder.');
        }

        $kunjungans = [
            ['pasien' => 0, 'dokter' => 0, 'jenis' => 0, 'keluhan' => 'Demam dan sakit kepala', 'status' => 'Selesai', 'penyakit' => 'Demam', 'catatan' => 'Istirahat dan minum obat'],
            ['pasien' => 1, 'dokter' => 1, 'jenis' => 1, 'keluhan' => 'Sakit gigi sebelah kanan', 'status' => 'Selesai', 'penyakit' => 'Karies gigi', 'catatan' => 'Kontrol kembali satu minggu'],
            ['pasien' => 2, 'dokter' => 2, 'jenis' => 2, 'keluhan' => 'Batuk dan pilek', 'status' => 'Dalam Pemeriksaan', 'penyakit' => null, 'catatan' => null],
            ['pasien' => 3, 'dokter' => 3, 'jenis' => 3, 'keluhan' => 'Nyeri ulu hati', 'status' => 'Selesai', 'penyakit' => 'Dispepsia', 'catatan' => 'Atur pola makan'],
            ['pasien' => 4, 'dokter' => 4, 'jenis' => 4, 'keluhan' => 'Pemeriksaan kehamilan rutin', 'status' => 'Menunggu', 'penyakit' => null, 'catatan' => null],
            ['pasien' => 0, 'dokter' => 2, 'jenis' => 0, 'keluhan' => 'Kontrol tekanan darah', 'status' => 'Selesai', 'penyakit' => 'Hipertensi', 'catatan' => 'Lanjutkan obat rutin'],
            ['pasien' => 1, 'dokter' => 0, 'jenis' => 1, 'keluhan' => 'Gusi bengkak', 'status' => 'Selesai', 'penyakit' => 'Gingivitis', 'catatan' => 'Jaga kebersihan gigi'],
            ['pasien' => 2, 'dokter' => 1, 'jenis' => 2, 'keluhan' => 'Demam pada anak', 'status' => 'Dalam Pemeriksaan', 'penyakit' => null, 'catatan' => null],
            ['pasien' => 3, 'dokter' => 2, 'jenis' => 3, 'keluhan' => 'Nyeri sendi', 'status' => 'Selesai', 'penyakit' => 'Artralgia', 'catatan' => 'Kompres hangat'],
            ['pasien' => 4, 'dokter' => 3, 'jenis' => 4, 'keluhan' => 'Konsultasi kehamilan', 'status' => 'Selesai', 'penyakit' => null, 'catatan' => 'Jadwal kontrol berikutnya dua minggu'],
            ['pasien' => 0, 'dokter' => 4, 'jenis' => 0, 'keluhan' => 'Batuk kering', 'status' => 'Menunggu', 'penyakit' => null, 'catatan' => null],
            ['pasien' => 1, 'dokter' => 1, 'jenis' => 1, 'keluhan' => 'Gigi sensitif', 'status' => 'Selesai', 'penyakit' => 'Hipersensitivitas dentin', 'catatan' => 'Gunakan pasta gigi sensitif'],
            ['pasien' => 2, 'dokter' => 3, 'jenis' => 2, 'keluhan' => 'Kontrol tumbuh kembang', 'status' => 'Selesai', 'penyakit' => null, 'catatan' => 'Pertumbuhan sesuai usia'],
            ['pasien' => 3, 'dokter' => 0, 'jenis' => 3, 'keluhan' => 'Pemeriksaan kadar gula', 'status' => 'Dalam Pemeriksaan', 'penyakit' => null, 'catatan' => null],
            ['pasien' => 4, 'dokter' => 2, 'jenis' => 4, 'keluhan' => 'Mual pada kehamilan', 'status' => 'Selesai', 'penyakit' => 'Mual kehamilan', 'catatan' => 'Makan dalam porsi kecil'],
        ];

        foreach ($kunjungans as $index => $kunjungan) {
            $pasien = $pasiens[$kunjungan['pasien'] % $pasiens->count()];
            $dokter = $dokters[$kunjungan['dokter'] % $dokters->count()];
            $jenisPoli = $jenisPolis[$kunjungan['jenis'] % $jenisPolis->count()];

            $poli = Poli::firstOrCreate(
                [
                    'id_pasien' => $pasien->id,
                    'id_dokter' => $dokter->id,
                    'keluhan' => $kunjungan['keluhan'],
                ],
                [
                    'jenis_poli' => (string) $jenisPoli->id,
                    'status' => $kunjungan['status'],
                    'penyakit' => $kunjungan['penyakit'],
                    'catatan_medis' => $kunjungan['catatan'],
                ],
            );

            if ($poli->wasRecentlyCreated) {
                $tanggalKunjungan = now()
                    ->startOfDay()
                    ->subDays($index % 7)
                    ->setTime(8 + ($index % 9), ($index * 7) % 60);

                $poli->forceFill([
                    'created_at' => $tanggalKunjungan,
                    'updated_at' => $tanggalKunjungan,
                ])->save();
            }
        }
    }
}