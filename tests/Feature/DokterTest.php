<?php

use App\Models\Dokter;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('daftar dokter dapat difilter berdasarkan nama atau NIP', function () {
    Dokter::create(['nip' => '198501012010011001', 'nama' => 'Andi Pratama']);
    Dokter::create(['nip' => '198702152011012002', 'nama' => 'Siti Rahma']);

    $response = $this->get(route('dokter.index', ['q' => '198501012010011001']));

    $response->assertOk()
        ->assertSee('Andi Pratama')
        ->assertDontSee('Siti Rahma')
        ->assertViewHas('dokters', fn ($dokters) => $dokters->total() === 1);
});

test('daftar dokter dipaginasi sepuluh data per halaman', function () {
    foreach (range(1, 12) as $number) {
        Dokter::create([
            'nip' => sprintf('19850101201001%04d', $number),
            'nama' => sprintf('Dokter %02d', $number),
        ]);
    }

    $response = $this->get(route('dokter.index'));

    $response->assertOk()
        ->assertSee('page=2')
        ->assertViewHas('dokters', fn ($dokters) => $dokters->count() === 10 && $dokters->total() === 12);
});

test('form tambah dokter menggunakan layout aplikasi', function () {
    $response = $this->get(route('dokter.create'));

    $response->assertOk()
        ->assertSee('Tambah Dokter')
        ->assertSee('class="form-control"', false)
        ->assertSee('Simpan');
});

test('form edit dokter menampilkan data dokter', function () {
    $dokter = Dokter::create([
        'nip' => '198501012010011001',
        'nama' => 'Andi Pratama',
    ]);

    $response = $this->get(route('dokter.edit', $dokter));

    $response->assertOk()
        ->assertSee('Edit Data Dokter')
        ->assertSee('198501012010011001')
        ->assertSee('Andi Pratama')
        ->assertSee('class="form-control"', false);
});