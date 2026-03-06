@extends('layouts.app')

@section('title', 'New Blotter Case')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <p class="section-kicker">Legal Module</p>
        <h1 class="page-title mt-2">New Blotter Case</h1>
    </section>

    <section class="surface-card p-5 sm:p-6">
        <form action="{{ route('blotter.store') }}" method="POST" class="grid grid-cols-1 gap-5 md:grid-cols-2">
            @csrf
            <div>
                <label class="form-label">Complainant (Resident)</label>
                <select name="complainant_resident_id" class="form-input">
                    <option value="">Not linked</option>
                    @foreach ($residents as $resident)
                        <option value="{{ $resident->id }}">{{ $resident->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Respondent (Resident)</label>
                <select name="respondent_resident_id" class="form-input">
                    <option value="">Not linked</option>
                    @foreach ($residents as $resident)
                        <option value="{{ $resident->id }}">{{ $resident->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <input name="complainant_name" class="form-input" placeholder="Complainant Name (if non-resident)">
            <input name="respondent_name" class="form-input" placeholder="Respondent Name (if non-resident)">
            <input name="witness_name" class="form-input" placeholder="Witness">
            <select name="incident_type" class="form-input">
                @foreach (['Theft', 'Physical Injury', 'Noise Complaint', 'Other'] as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            <input name="incident_date" type="date" class="form-input">
            <input name="mediation_date" type="date" class="form-input">
            <select name="status" class="form-input">
                @foreach (['Pending', 'Scheduled for Mediation', 'Settled', 'Referred to PNP'] as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            <textarea name="narrative" rows="4" class="form-input md:col-span-2" placeholder="Incident narrative"></textarea>
            <div class="md:col-span-2 flex justify-end gap-2">
                <a href="{{ route('blotter.index') }}" class="btn-muted">Cancel</a>
                <button type="submit" class="btn-primary">Create Case</button>
            </div>
        </form>
    </section>
</div>
@endsection
