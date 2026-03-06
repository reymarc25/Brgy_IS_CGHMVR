@extends('layouts.app')

@section('title', 'Add Resident')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="section-kicker">Resident Registry</p>
                <h1 class="page-title mt-2">Create Resident Profile</h1>
                <p class="mt-2 text-sm text-slate-600">Fill out all required fields to register a new resident.</p>
            </div>
            <a href="{{ route('residents.index') }}" class="btn-muted">Back to List</a>
        </div>
    </section>

    <section class="surface-card p-5 sm:p-6">
        <form action="{{ route('residents.store') }}" method="POST">
            @csrf
            @include('residents._form')

            <div class="mt-6 flex flex-wrap justify-end gap-2 border-t border-slate-100 pt-5">
                <a href="{{ route('residents.index') }}" class="btn-muted">Cancel</a>
                <button type="submit" class="btn-primary">Save Resident</button>
            </div>
        </form>
    </section>
</div>
@endsection
