<?php

use App\Models\Dokter;
use App\Models\JenisPoli;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

function buatRelasiUntukTestPoli(): array
{
    return [
        Pasien::create([
            'no_rekam_medis' => 'RM-POLI-001',
            'nama' => 'Pasien Poli Test',
            'alamat' => 'Bontang',
            'tanggal_lahir' => '1990-01-01',
        ]),
        Dokter::create([
            'nip' => '198501012010011001',
            'nama' => 'Dokter Poli Test',
        ]),
        JenisPoli::create(['nama' => 'Poli Umum']),
    ];
}

test('daftar poli dapat difilter berdasarkan keluhan dan nama relasi', function () {
    [$pasien, $dokter, $jenisPoli] = buatRelasiUntukTestPoli();
    Poli::create([
        'id_pasien' => $pasien->id,
        'id_dokter' => $dokter->id,
        'keluhan' => 'Demam tinggi',
        'jenis_poli' => (string) $jenisPoli->id,
        'status' => 'Menunggu',
    ]);
    Poli::create([
        'id_pasien' => $pasien->id,
        'id_dokter' => $dokter->id,
        'keluhan' => 'Batuk ringan',
        'jenis_poli' => (string) $jenisPoli->id,
        'status' => 'Selesai',
    ]);

    $response = $this->get(route('poli.index', ['q' => 'Demam']));

    $response->assertOk()
        ->assertSee('Demam tinggi')
        ->assertDontSee('Batuk ringan')
        ->assertViewHas('polis', fn ($polis) => $polis->total() === 1);
});

test('daftar poli dipaginasi sepuluh data per halaman', function () {
    [$pasien, $dokter, $jenisPoli] = buatRelasiUntukTestPoli();

    foreach (range(1, 12) as $number) {
        Poli::create([
            'id_pasien' => $pasien->id,
            'id_dokter' => $dokter->id,
            'keluhan' => sprintf('Keluhan %02d', $number),
            'jenis_poli' => (string) $jenisPoli->id,
            'status' => 'Menunggu',
        ]);
    }

    $response = $this->get(route('poli.index'));

    $response->assertOk()
        ->assertSee('page=2')
        ->assertViewHas('polis', fn ($polis) => $polis->count() === 10 && $polis->total() === 12);
});

test('form create dan edit poli dapat dirender', function () {
    [$pasien, $dokter, $jenisPoli] = buatRelasiUntukTestPoli();

    $createResponse = $this->get(route('poli.create'));
    $createResponse->assertOk()->assertSee('Tambah Data Poli')->assertSee('Pilih pasien');

    $poli = Poli::create([
        'id_pasien' => $pasien->id,
        'id_dokter' => $dokter->id,
        'keluhan' => 'Demam tinggi',
        'jenis_poli' => (string) $jenisPoli->id,
        'status' => 'Menunggu',
    ]);

    $editResponse = $this->get(route('poli.edit', $poli));
    $editResponse->assertOk()->assertSee('Edit Data Poli')->assertSee('Demam tinggi');
});