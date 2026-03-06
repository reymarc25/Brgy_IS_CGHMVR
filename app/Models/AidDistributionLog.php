<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AidDistributionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'program_name',
        'assistance_type',
        'quantity',
        'distribution_date',
        'remarks',
        'recorded_by',
    ];

    protected function casts(): array
    {
        return [
            'distribution_date' => 'date',
            'quantity' => 'decimal:2',
        ];
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}
