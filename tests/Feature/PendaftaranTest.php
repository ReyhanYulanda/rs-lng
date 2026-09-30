<?php

use App\Models\Dokter;
use App\Models\JenisPoli;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\User;
use Database\Seeders\PendaftaranSeeder;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    $this->actingAs(User::factory()->create(['role' => 'karyawan']));
});

function buatRelasiUntukPendaftaranTest(): array
{
    return [
        Pasien::create([
            'no_rekam_medis' => 'RM-PENDAFTARAN-001',
            'nama' => 'Pasien Pendaftaran Test',
            'alamat' => 'Bontang',
            'tanggal_lahir' => '1990-01-01',
        ]),
        Dokter::create([
            'nip' => '198501012010011001',
            'nama' => 'Dokter Pendaftaran Test',
        ]),
        JenisPoli::create(['nama' => 'Poli Pendaftaran Test']),
    ];
}

test('legacy poli table is renamed and pendaftaran page uses the new resource', function () {
    expect(Schema::hasTable('pendaftarans'))->toBeTrue();
    expect(Schema::hasTable('polis'))->toBeFalse();

    [$pasien, $dokter, $jenisPoli] = buatRelasiUntukPendaftaranTest();
    Pendaftaran::create([
        'id_pasien' => $pasien->id,
        'id_dokter' => $dokter->id,
        'keluhan' => 'Pemeriksaan rutin',
        'jenis_poli' => (string) $jenisPoli->id,
        'status' => 'Menunggu',
    ]);

    $this->get(route('pendaftaran.index'))
        ->assertOk()
        ->assertSee('Daftar Pendaftaran')
        ->assertSee('Pasien Pendaftaran Test')
        ->assertSee('Poli Pendaftaran Test');
});

test('pendaftaran create edit and detail pages use the renamed routes', function () {
    [$pasien, $dokter, $jenisPoli] = buatRelasiUntukPendaftaranTest();

    $this->get(route('pendaftaran.create'))
        ->assertOk()
        ->assertSee('Tambah Pendaftaran');

    $pendaftaran = Pendaftaran::create([
        'id_pasien' => $pasien->id,
        'id_dokter' => $dokter->id,
        'keluhan' => 'Pemeriksaan rutin',
        'jenis_poli' => (string) $jenisPoli->id,
        'status' => 'Menunggu',
    ]);

    $this->get(route('pendaftaran.edit', $pendaftaran))
        ->assertOk()
        ->assertSee('Edit Pendaftaran');

    $this->get(route('pendaftaran.show', $pendaftaran))
        ->assertOk()
        ->assertSee('Detail Pendaftaran')
        ->assertSee('Poli Pendaftaran Test');
});

test('pendaftaran seeder creates fifteen records without duplicates', function () {
    buatRelasiUntukPendaftaranTest();

    $seeder = app(PendaftaranSeeder::class);
    $seeder->run();

    expect(Pendaftaran::count())->toBe(15);

    $seeder->run();

    expect(Pendaftaran::count())->toBe(15);
});