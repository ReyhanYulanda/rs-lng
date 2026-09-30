<?php

use App\Models\Biaya;
use App\Models\Pasien;

function buatPasienUntukBiaya(): Pasien
{
    return Pasien::create([
        'no_rekam_medis' => 'RM-BIAYA-001',
        'nama' => 'Pasien Test',
        'alamat' => 'Bontang',
        'tanggal_lahir' => '1990-01-01',
    ]);
}

test('total biaya dihitung dari rincian saat membuat biaya', function () {
    $pasien = buatPasienUntukBiaya();

    $response = $this->post(route('biaya.store'), [
        'id_pasien' => $pasien->id,
        'biaya_dokter' => 100000,
        'biaya_obat' => 25000,
        'biaya_administrasi' => 10000,
        'biaya_lainnya' => 5000,
        'jumlah' => 1,
        'status' => 'Belum Lunas',
    ]);

    $response->assertSessionHasNoErrors()->assertRedirect(route('biaya.index'));
    $this->assertDatabaseHas('biayas', [
        'id_pasien' => $pasien->id,
        'jumlah' => 140000,
        'status' => 'Belum Lunas',
    ]);
});

test('total biaya dihitung ulang dari rincian saat mengubah biaya', function () {
    $pasien = buatPasienUntukBiaya();
    $biaya = Biaya::create([
        'id_pasien' => $pasien->id,
        'biaya_dokter' => 100000,
        'biaya_obat' => 25000,
        'biaya_administrasi' => 10000,
        'biaya_lainnya' => 5000,
        'jumlah' => 140000,
        'status' => 'Belum Lunas',
    ]);

    $response = $this->put(route('biaya.update', $biaya), [
        'id_pasien' => $pasien->id,
        'biaya_dokter' => 150000,
        'biaya_obat' => 30000,
        'biaya_administrasi' => 10000,
        'biaya_lainnya' => 10000,
        'jumlah' => 1,
    ]);

    $response->assertSessionHasNoErrors()->assertRedirect(route('biaya.index'));
    $this->assertDatabaseHas('biayas', [
        'id' => $biaya->id,
        'jumlah' => 200000,
    ]);
});

test('biaya negatif ditolak saat membuat biaya', function () {
    $pasien = buatPasienUntukBiaya();

    $response = $this->post(route('biaya.store'), [
        'id_pasien' => $pasien->id,
        'biaya_dokter' => -1,
        'biaya_obat' => 25000,
        'biaya_administrasi' => 10000,
        'biaya_lainnya' => 5000,
        'jumlah' => 1,
        'status' => 'Belum Lunas',
    ]);

    $response->assertSessionHasErrors('biaya_dokter');
    $this->assertDatabaseCount('biayas', 0);
});

test('biaya negatif ditolak saat mengubah biaya', function () {
    $pasien = buatPasienUntukBiaya();
    $biaya = Biaya::create([
        'id_pasien' => $pasien->id,
        'biaya_dokter' => 100000,
        'biaya_obat' => 25000,
        'biaya_administrasi' => 10000,
        'biaya_lainnya' => 5000,
        'jumlah' => 140000,
        'status' => 'Belum Lunas',
    ]);

    $response = $this->put(route('biaya.update', $biaya), [
        'id_pasien' => $pasien->id,
        'biaya_dokter' => 100000,
        'biaya_obat' => -1,
        'biaya_administrasi' => 10000,
        'biaya_lainnya' => 5000,
        'jumlah' => 1,
    ]);

    $response->assertSessionHasErrors('biaya_obat');
    $this->assertDatabaseHas('biayas', [
        'id' => $biaya->id,
        'biaya_obat' => 25000,
        'jumlah' => 140000,
    ]);
});