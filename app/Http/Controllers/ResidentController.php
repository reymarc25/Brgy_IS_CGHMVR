<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResidentController extends Controller
{
    public function index(Request $request): View
    {
        $residents = Resident::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = trim((string) $request->input('q'));

                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('middle_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('contact_number', 'like', '%' . $search . '%');
                });
            })
            ->when($request->filled('gender'), fn ($query) => $query->where('gender', (string) $request->input('gender')))
            ->when($request->filled('civil_status'), fn ($query) => $query->where('civil_status', (string) $request->input('civil_status')))
            ->when($request->filled('purok'), fn ($query) => $query->where('purok', (string) $request->input('purok')))
            ->when($request->filled('resident_status'), fn ($query) => $query->where('resident_status', (string) $request->input('resident_status')))
            ->when($request->filled('sector'), function ($query) use ($request) {
                $sector = (string) $request->input('sector');

                if ($sector === 'senior') {
                    $query->whereDate('birthdate', '<=', now()->subYears(60));
                }

                if ($sector === 'pwd') {
                    $query->where('is_pwd', true);
                }

                if ($sector === 'solo_parent') {
                    $query->where('is_solo_parent', true);
                }

                if ($sector === '4ps') {
                    $query->where('is_4ps', true);
                }
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(10)
            ->withQueryString();

        return view('residents.index', compact('residents'));
    }

    public function create(): View
    {
        return view('residents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $resident = Resident::create($this->validatedData($request));
        $this->logAudit($request, 'created', $resident, [], $resident->toArray());

        return redirect()->route('residents.index')->with('success', 'Resident created successfully.');
    }

    public function show(Resident $resident): View
    {
        return view('residents.show', compact('resident'));
    }

    public function edit(Resident $resident): View
    {
        return view('residents.edit', compact('resident'));
    }

    public function update(Request $request, Resident $resident): RedirectResponse
    {
        $old = $resident->toArray();
        $resident->update($this->validatedData($request));
        $this->logAudit($request, 'updated', $resident, $old, $resident->toArray());

        return redirect()->route('residents.index')->with('success', 'Resident updated successfully.');
    }

    public function destroy(Resident $resident): RedirectResponse
    {
        abort_unless(request()->user()?->isAdmin(), 403);

        $old = $resident->toArray();
        $resident->delete();
        $this->logAudit(request(), 'deleted', $resident, $old, []);

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully.');
    }

    public function updateStatus(Request $request, Resident $resident): RedirectResponse
    {
        $validated = $request->validate([
            'resident_status' => ['required', 'in:Active,Lumipat,Patay'],
        ]);

        $old = ['resident_status' => $resident->resident_status];
        $resident->update($validated);
        $this->logAudit($request, 'updated status', $resident, $old, ['resident_status' => $resident->resident_status]);

        return back()->with('success', 'Resident status updated.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'birthdate' => ['required', 'date', 'before_or_equal:today'],
            'gender' => ['required', 'in:Male,Female'],
            'civil_status' => ['required', 'in:Single,Married,Widowed,Separated'],
            'contact_number' => ['nullable', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'purok' => ['required', 'in:Purok 1,Purok 2,Purok 3,Purok 4,Purok 5,Purok 6,Purok 7'],
            'resident_status' => ['nullable', 'in:Active,Lumipat,Patay'],
            'household_code' => ['nullable', 'string', 'max:50'],
            'is_pwd' => ['nullable', 'boolean'],
            'is_solo_parent' => ['nullable', 'boolean'],
            'is_4ps' => ['nullable', 'boolean'],
            'is_voter' => ['nullable', 'boolean'],
        ]);

        $validated['is_pwd'] = $request->boolean('is_pwd');
        $validated['is_solo_parent'] = $request->boolean('is_solo_parent');
        $validated['is_4ps'] = $request->boolean('is_4ps');
        $validated['is_voter'] = $request->boolean('is_voter');
        $validated['resident_status'] = (string) ($validated['resident_status'] ?? 'Active');

        return $validated;
    }
}
