<?php

namespace App\Http\Controllers;

use App\Models\AidDistributionLog;
use App\Models\Resident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AidDistributionController extends Controller
{
    public function index(): View
    {
        $logs = AidDistributionLog::with('resident')->latest()->paginate(15);
        $residents = Resident::orderBy('last_name')->orderBy('first_name')->get();

        return view('aid.index', compact('logs', 'residents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'resident_id' => ['required', 'exists:residents,id'],
            'program_name' => ['required', 'string', 'max:150'],
            'assistance_type' => ['required', 'string', 'max:150'],
            'quantity' => ['required', 'numeric', 'min:0.01'],
            'distribution_date' => ['required', 'date'],
            'remarks' => ['nullable', 'string'],
        ]);

        $exists = AidDistributionLog::query()
            ->where('resident_id', $data['resident_id'])
            ->where('program_name', $data['program_name'])
            ->whereDate('distribution_date', $data['distribution_date'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'resident_id' => 'This resident is already recorded for the selected program and date.',
            ])->withInput();
        }

        $data['recorded_by'] = $request->user()->id;
        $log = AidDistributionLog::create($data);
        $this->logAudit($request, 'created', $log, [], $log->toArray());

        return back()->with('success', 'Aid distribution log recorded.');
    }
}
