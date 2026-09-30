<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            ['nip' => '198501012010011001', 'nama' => 'dr. Andi Pratama'],
            ['nip' => '198702152011012002', 'nama' => 'dr. Siti Rahma'],
            ['nip' => '198903202012011003', 'nama' => 'dr. Budi Santoso'],
            ['nip' => '199004102013012004', 'nama' => 'dr. Maya Lestari'],
            ['nip' => '199105252014011005', 'nama' => 'dr. Rina Kurniawati'],
        ];

        foreach ($dokters as $dokter) {
            Dokter::firstOrCreate(
                ['nip' => $dokter['nip']],
                ['nama' => $dokter['nama']],
            );
        }
    }
}