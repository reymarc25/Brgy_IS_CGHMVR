@extends('layouts.app')

@section('title', 'Request Document')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <p class="section-kicker">Transactions</p>
        <h1 class="page-title mt-2">Request Document</h1>
    </section>

    <section class="surface-card p-5 sm:p-6">
        <form action="{{ route('documents.store') }}" method="POST" class="grid grid-cols-1 gap-5 md:grid-cols-2">
            @csrf
            <div>
                <label class="form-label">Resident</label>
                <select name="resident_id" class="form-input" required>
                    <option value="">Select Resident</option>
                    @foreach ($residents as $resident)
                        <option value="{{ $resident->id }}" @selected(old('resident_id') == $resident->id)>{{ $resident->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Document Type</label>
                <select name="document_type" class="form-input" required>
                    @foreach (['Barangay Clearance', 'Indigency', 'Residency', 'Business Permit'] as $type)
                        <option value="{{ $type }}" @selected(old('document_type') === $type)>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="form-label">Purpose</label>
                <input type="text" name="purpose" class="form-input" value="{{ old('purpose') }}" placeholder="Optional purpose">
            </div>
            <div class="md:col-span-2 flex justify-end gap-2">
                <a href="{{ route('documents.index') }}" class="btn-muted">Cancel</a>
                <button type="submit" class="btn-primary">Create Request</button>
            </div>
        </form>
    </section>
</div>
@endsection
