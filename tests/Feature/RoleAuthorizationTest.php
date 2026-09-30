<?php

use App\Models\User;

test('karyawan can access regular pages but not diagnoses or user management', function () {
    $karyawan = User::factory()->create(['role' => 'karyawan']);

    $this->actingAs($karyawan)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertDontSee('Diagnosa')
        ->assertDontSee('Users');

    $this->get(route('diagnosa.index'))->assertForbidden();
    $this->get(route('users.index'))->assertForbidden();
    $this->get(route('pendaftaran.index'))->assertOk();
});

test('tenaga medis can only access diagnoses', function () {
    $tenagaMedis = User::factory()->create(['role' => 'tenaga_medis']);

    $this->actingAs($tenagaMedis)
        ->get(route('diagnosa.index'))
        ->assertOk()
        ->assertSee('Diagnosa')
        ->assertDontSee('Dashboard')
        ->assertDontSee('Pendaftaran')
        ->assertDontSee('Users');

    $this->get(route('dashboard'))->assertForbidden();
    $this->get(route('pasien.index'))->assertForbidden();
    $this->get(route('pendaftaran.index'))->assertForbidden();
    $this->get(route('biaya.index'))->assertForbidden();
    $this->get(route('users.index'))->assertForbidden();
    $this->get(route('profile.edit'))->assertForbidden();
});

test('admin can access diagnoses and user management', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('diagnosa.index'))
        ->assertOk();

    $this->get(route('users.index'))->assertOk();
    $this->get(route('dashboard'))->assertOk();
});

test('admin can create a tenaga medis user', function () {
    $this->actingAs(User::factory()->create(['role' => 'admin']))
        ->post(route('users.store'), [
            'name' => 'Tenaga Medis',
            'email' => 'tenaga-medis@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'tenaga_medis',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseHas('users', [
        'email' => 'tenaga-medis@example.com',
        'role' => 'tenaga_medis',
    ]);
});

test('tenaga medis is redirected to diagnoses after login', function () {
    User::factory()->create([
        'name' => 'Tenaga Medis Login',
        'email' => 'tenaga-login@example.com',
        'password' => 'password',
        'role' => 'tenaga_medis',
    ]);

    $this->post('/login', [
        'email' => 'tenaga-login@example.com',
        'password' => 'password',
    ])->assertRedirect(route('diagnosa.index'));
});