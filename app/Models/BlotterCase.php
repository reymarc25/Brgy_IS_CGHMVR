<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlotterCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'complainant_resident_id',
        'respondent_resident_id',
        'complainant_name',
        'respondent_name',
        'witness_name',
        'incident_type',
        'narrative',
        'status',
        'incident_date',
        'mediation_date',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'incident_date' => 'date',
            'mediation_date' => 'date',
        ];
    }

    public function complainantResident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'complainant_resident_id');
    }

    public function respondentResident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'respondent_resident_id');
    }
}
