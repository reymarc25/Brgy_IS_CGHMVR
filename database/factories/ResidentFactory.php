<?php

namespace Database\Factories;

use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resident>
 */
class ResidentFactory extends Factory
{
    protected $model = Resident::class;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'last_name' => fake()->lastName(),
            'birthdate' => fake()->dateTimeBetween('-80 years', '-1 year')->format('Y-m-d'),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'civil_status' => fake()->randomElement(['Single', 'Married', 'Widowed', 'Separated']),
            'contact_number' => '09' . fake()->numerify('#########'),
            'purok' => fake()->randomElement(['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7']),
            'resident_status' => fake()->randomElement(['Active', 'Active', 'Active', 'Lumipat', 'Patay']),
            'address' => fake()->streetAddress() . ', Brgy. San Isidro',
            'household_code' => 'HH-' . fake()->numberBetween(1, 60),
            'is_pwd' => fake()->boolean(10),
            'is_solo_parent' => fake()->boolean(12),
            'is_4ps' => fake()->boolean(15),
            'is_voter' => fake()->boolean(70),
            'created_at' => Carbon::now()->subDays(fake()->numberBetween(0, 160)),
            'updated_at' => now(),
        ];
    }
}
