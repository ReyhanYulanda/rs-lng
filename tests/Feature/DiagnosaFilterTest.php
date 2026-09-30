<?php

use App\Models\Dokter;
use App\Models\JenisPoli;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\User;

test('diagnosa doctor is selected with a dropdown instead of text search', function () {
    $this->actingAs(User::factory()->create(['role' => 'tenaga_medis']));

    $doctorOne = Dokter::create(['nip' => '111', 'nama' => 'Dokter Satu']);
    $doctorTwo = Dokter::create(['nip' => '222', 'nama' => 'Dokter Dua']);
    $jenisPoli = JenisPoli::create(['nama' => 'Poli Test']);

    foreach ([[$doctorOne, 'Pasien Satu'], [$doctorTwo, 'Pasien Dua']] as [$doctor, $patientName]) {
        $patient = Pasien::create([
            'no_rekam_medis' => str_replace(' ', '-', strtoupper($patientName)),
            'nama' => $patientName,
            'alamat' => 'Bontang',
            'tanggal_lahir' => '1990-01-01',
        ]);

        Pendaftaran::create([
            'id_pasien' => $patient->id,
            'id_dokter' => $doctor->id,
            'keluhan' => 'Keluhan Test',
            'jenis_poli' => (string) $jenisPoli->id,
            'status' => 'Selesai',
        ]);
    }

    $textSearch = $this->get(route('diagnosa.index', ['q' => 'Dokter Satu']));
    $textSearch->assertOk()
        ->assertDontSee('Pasien Satu')
        ->assertDontSee('Pasien Dua');

    $doctorFilter = $this->get(route('diagnosa.index', ['dokter_id' => $doctorOne->id]));
    $doctorFilter->assertOk()
        ->assertSee('Pasien Satu')
        ->assertDontSee('Pasien Dua')
        ->assertSee('Dokter Satu')
        ->assertSee('Dokter Dua');
});