<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalPopulation = Resident::count();
        $totalHouseholds = Resident::query()
            ->select('address')
            ->distinct()
            ->count('address');
        $seniors = Resident::query()
            ->whereDate('birthdate', '<=', Carbon::now()->subYears(60))
            ->count();
        $todaysBirthdays = Resident::query()
            ->whereMonth('birthdate', Carbon::today()->month)
            ->whereDay('birthdate', Carbon::today()->day)
            ->count();

        $recentResidents = Resident::query()
            ->latest()
            ->take(6)
            ->get();

        $genderStats = Resident::query()
            ->selectRaw('gender, COUNT(*) as total')
            ->groupBy('gender')
            ->orderByDesc('total')
            ->get();

        $ageGroups = [
            'Children (0-14)' => Resident::whereDate('birthdate', '>=', Carbon::now()->subYears(14))->count(),
            'Youth (15-30)' => Resident::whereBetween('birthdate', [Carbon::now()->subYears(30), Carbon::now()->subYears(15)])->count(),
            'Adults (31-59)' => Resident::whereBetween('birthdate', [Carbon::now()->subYears(59), Carbon::now()->subYears(31)])->count(),
            'Senior (60+)' => $seniors,
        ];

        return view('admin.dashboard', [
            'summary' => [
                'totalPopulation' => $totalPopulation,
                'totalHouseholds' => $totalHouseholds,
                'seniors' => $seniors,
                'todaysBirthdays' => $todaysBirthdays,
            ],
            'recentResidents' => $recentResidents,
            'genderStats' => $genderStats,
            'ageGroups' => $ageGroups,
        ]);
    }
}
