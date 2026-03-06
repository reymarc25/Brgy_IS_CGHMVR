<?php

namespace App\Http\Controllers;

use App\Models\BlotterCase;
use App\Models\Resident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlotterCaseController extends Controller
{
    public function index(): View
    {
        $cases = BlotterCase::with(['complainantResident', 'respondentResident'])->latest()->paginate(12);

        return view('blotter.index', compact('cases'));
    }

    public function create(): View
    {
        $residents = Resident::orderBy('last_name')->orderBy('first_name')->get();

        return view('blotter.create', compact('residents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'complainant_resident_id' => ['nullable', 'exists:residents,id'],
            'respondent_resident_id' => ['nullable', 'exists:residents,id'],
            'complainant_name' => ['nullable', 'string', 'max:150'],
            'respondent_name' => ['nullable', 'string', 'max:150'],
            'witness_name' => ['nullable', 'string', 'max:150'],
            'incident_type' => ['required', 'in:Theft,Physical Injury,Noise Complaint,Other'],
            'narrative' => ['required', 'string'],
            'status' => ['required', 'in:Pending,Scheduled for Mediation,Settled,Referred to PNP'],
            'incident_date' => ['nullable', 'date'],
            'mediation_date' => ['nullable', 'date'],
        ]);

        $data['created_by'] = $request->user()->id;
        $case = BlotterCase::create($data);
        $this->logAudit($request, 'created', $case, [], $case->toArray());

        return redirect()->route('blotter.index')->with('success', 'Blotter case created.');
    }

    public function updateStatus(Request $request, BlotterCase $blotter): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Pending,Scheduled for Mediation,Settled,Referred to PNP'],
        ]);

        $old = ['status' => $blotter->status];
        $blotter->update($validated);
        $this->logAudit($request, 'updated status', $blotter, $old, ['status' => $blotter->status]);

        return back()->with('success', 'Case status updated.');
    }
}
