<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@barangay.gov',
        ], [
            'name' => 'Barangay Administrator',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        if (Resident::count() < 80) {
            Resident::factory()->count(120)->create();
        }

        User::query()->updateOrCreate([
            'email' => 'staff@barangay.gov',
        ], [
            'name' => 'Staff Account',
            'password' => Hash::make('staff1234'),
            'role' => 'staff',
            'email_verified_at' => now(),
        ]);
    }
}
