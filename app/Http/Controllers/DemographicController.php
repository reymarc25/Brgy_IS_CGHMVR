<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DemographicController extends Controller
{
    public function index(): View
    {
        $total = Resident::count();

        $genderBreakdown = Resident::query()
            ->select('gender', DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->orderByDesc('total')
            ->get();

        $civilStatusBreakdown = Resident::query()
            ->select('civil_status', DB::raw('COUNT(*) as total'))
            ->groupBy('civil_status')
            ->orderByDesc('total')
            ->get();

        $ageGroups = collect([
            ['label' => 'Children (0-14)', 'total' => Resident::whereDate('birthdate', '>=', Carbon::now()->subYears(14))->count()],
            ['label' => 'Youth (15-30)', 'total' => Resident::whereBetween('birthdate', [Carbon::now()->subYears(30), Carbon::now()->subYears(15)])->count()],
            ['label' => 'Adults (31-59)', 'total' => Resident::whereBetween('birthdate', [Carbon::now()->subYears(59), Carbon::now()->subYears(31)])->count()],
            ['label' => 'Senior (60+)', 'total' => Resident::whereDate('birthdate', '<=', Carbon::now()->subYears(60))->count()],
        ]);

        $registrations = collect(range(0, 5))
            ->map(function (int $offset) {
                $month = now()->startOfMonth()->subMonths(5 - $offset);

                return [
                    'label' => $month->format('M Y'),
                    'total' => Resident::whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month)
                        ->count(),
                ];
            });

        $voterCount = Resident::where('is_voter', true)->count();
        $nonVoterCount = max($total - $voterCount, 0);

        $householdMap = Resident::query()
            ->selectRaw("COALESCE(NULLIF(household_code, ''), address) as household_key, COUNT(*) as total_members")
            ->groupBy('household_key')
            ->orderByDesc('total_members')
            ->limit(10)
            ->get();

        return view('demographic.index', [
            'totalResidents' => $total,
            'genderBreakdown' => $genderBreakdown,
            'civilStatusBreakdown' => $civilStatusBreakdown,
            'ageGroups' => $ageGroups,
            'registrations' => $registrations,
            'voterCount' => $voterCount,
            'nonVoterCount' => $nonVoterCount,
            'householdMap' => $householdMap,
        ]);
    }
}
