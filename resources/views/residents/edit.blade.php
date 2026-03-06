@extends('layouts.app')

@section('title', 'Edit Resident')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="section-kicker">Resident Registry</p>
                <h1 class="page-title mt-2">Update Resident Profile</h1>
                <p class="mt-2 text-sm text-slate-600">{{ $resident->full_name }}</p>
            </div>
            <a href="{{ route('residents.show', $resident) }}" class="btn-muted">View Profile</a>
        </div>
    </section>

    <section class="surface-card p-5 sm:p-6">
        <form action="{{ route('residents.update', $resident) }}" method="POST">
            @csrf
            @method('PUT')
            @include('residents._form', ['resident' => $resident])

            <div class="mt-6 flex flex-wrap justify-end gap-2 border-t border-slate-100 pt-5">
                <a href="{{ route('residents.show', $resident) }}" class="btn-muted">Cancel</a>
                <button type="submit" class="btn-primary">Save Changes</button>
            </div>
        </form>
    </section>
</div>
@endsection
