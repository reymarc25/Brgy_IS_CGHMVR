<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'gender',
        'civil_status',
        'contact_number',
        'address',
        'purok',
        'resident_status',
        'household_code',
        'is_pwd',
        'is_solo_parent',
        'is_4ps',
        'is_voter',
    ];

    protected function casts(): array
    {
        return [
            'birthdate' => 'date',
            'is_pwd' => 'boolean',
            'is_solo_parent' => 'boolean',
            'is_4ps' => 'boolean',
            'is_voter' => 'boolean',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        ])));
    }

    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->birthdate)->age;
    }
}
