<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use App\Models\Resident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentRequestController extends Controller
{
    public function index(): View
    {
        $documents = DocumentRequest::with('resident')->latest()->paginate(12);

        return view('documents.index', compact('documents'));
    }

    public function create(): View
    {
        $residents = Resident::orderBy('last_name')->orderBy('first_name')->get();

        return view('documents.create', compact('residents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'resident_id' => ['required', 'exists:residents,id'],
            'document_type' => ['required', 'in:Barangay Clearance,Indigency,Residency,Business Permit'],
            'purpose' => ['nullable', 'string', 'max:255'],
        ]);
        $data['created_by'] = $request->user()->id;

        $document = DocumentRequest::create($data);
        $this->logAudit($request, 'created', $document, [], $document->toArray());

        return redirect()->route('documents.show', $document)->with('success', 'Document request created.');
    }

    public function show(DocumentRequest $document): View
    {
        $document->load('resident');

        return view('documents.show', compact('document'));
    }

    public function updatePayment(Request $request, DocumentRequest $document): RedirectResponse
    {
        $data = $request->validate([
            'or_number' => ['nullable', 'string', 'max:100'],
            'amount_paid' => ['required', 'numeric', 'min:0'],
            'payment_date' => ['nullable', 'date'],
        ]);

        $old = $document->only(['or_number', 'amount_paid', 'payment_date']);
        $document->update($data + ['status' => 'paid']);
        $this->logAudit($request, 'updated payment', $document, $old, $document->only(['or_number', 'amount_paid', 'payment_date', 'status']));

        return back()->with('success', 'Payment details updated.');
    }

    public function cancel(Request $request, DocumentRequest $document): RedirectResponse
    {
        $old = $document->toArray();
        $document->delete();
        $this->logAudit($request, 'cancelled and deleted', $document, $old, []);

        return redirect()->route('documents.index')->with('success', 'Document request cancelled and removed.');
    }

    public function destroy(Request $request, DocumentRequest $document): RedirectResponse
    {
        abort_unless($request->user()?->isAdmin(), 403);

        $old = $document->toArray();
        $document->delete();
        $this->logAudit($request, 'deleted', $document, $old, []);

        return redirect()->route('documents.index')->with('success', 'Document request deleted.');
    }
}
