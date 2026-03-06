<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest is redirected to login when opening protected pages', function () {
    $this->get('/admin/dashboard')
        ->assertRedirect('/login');

    $this->get('/residents')
        ->assertRedirect('/login');
});

test('user can login and access dashboard', function () {
    User::factory()->create([
        'email' => 'admin@barangay.gov',
        'password' => 'secret1234',
    ]);

    $this->post('/login', [
        'email' => 'admin@barangay.gov',
        'password' => 'secret1234',
    ])->assertRedirect('/admin/dashboard');

    $this->get('/admin/dashboard')
        ->assertOk()
        ->assertSee('Barangay Dashboard');
});

test('authenticated user can change password', function () {
    $user = User::factory()->create([
        'password' => 'old-password',
    ]);

    $this->actingAs($user)
        ->put('/auth/change-password', [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');
});
