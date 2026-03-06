<?php

use App\Models\Resident;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can view residents and demographic pages', function () {
    $user = User::factory()->create();
    Resident::factory()->count(5)->create();

    $this->actingAs($user)
        ->get('/residents')
        ->assertOk()
        ->assertSee('Resident Records');

    $this->actingAs($user)
        ->get('/demographic')
        ->assertOk()
        ->assertSee('Demographic Profile');
});

test('authenticated user can create update and delete a resident', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $payload = [
        'first_name' => 'Juan',
        'middle_name' => 'Santos',
        'last_name' => 'Dela Cruz',
        'birthdate' => '1998-05-10',
        'gender' => 'Male',
        'civil_status' => 'Single',
        'contact_number' => '09123456789',
        'purok' => 'Purok 1',
        'address' => 'Purok 3, Barangay Sample',
    ];

    $this->actingAs($user)
        ->post('/residents', $payload)
        ->assertRedirect('/residents');

    $resident = Resident::firstOrFail();
    expect($resident->first_name)->toBe('Juan');

    $this->actingAs($user)
        ->put('/residents/' . $resident->id, [
            ...$payload,
            'civil_status' => 'Married',
        ])
        ->assertRedirect('/residents');

    $resident->refresh();
    expect($resident->civil_status)->toBe('Married');

    $this->actingAs($user)
        ->delete('/residents/' . $resident->id)
        ->assertRedirect('/residents');

    $this->assertDatabaseMissing('residents', ['id' => $resident->id]);
});
