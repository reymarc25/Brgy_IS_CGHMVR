<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurokController extends Controller
{
    public function index(): View
    {
        $purokNames = ['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7'];

        $residents = Resident::query()
            ->orderBy('purok')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $grouped = collect($purokNames)->mapWithKeys(function (string $purok) use ($residents) {
            return [$purok => $residents->where('purok', $purok)->values()];
        });

        return view('purok.index', [
            'groupedResidents' => $grouped,
            'totalResidents' => $residents->count(),
        ]);
    }

    public function show(Request $request, int $number): View
    {
        abort_unless($number >= 1 && $number <= 7, 404);

        $purok = 'Purok ' . $number;

        $residents = Resident::query()
            ->where('purok', $purok)
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = trim((string) $request->input('q'));

                $query->where(function ($sub) use ($search) {
                    $sub->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15)
            ->withQueryString();

        return view('purok.show', [
            'purok' => $purok,
            'residents' => $residents,
        ]);
    }
}
