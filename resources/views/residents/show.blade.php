@extends('layouts.app')

@section('title', 'Resident Details')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <p class="section-kicker">Resident Profile</p>
                <h1 class="page-title mt-2">{{ $resident->full_name }}</h1>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span class="data-pill">{{ $resident->gender }}</span>
                    <span class="data-pill">{{ $resident->civil_status }}</span>
                    <span class="data-pill">{{ $resident->age }} years old</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('residents.index') }}" class="btn-muted">Back to List</a>
                <a href="{{ route('residents.edit', $resident) }}" class="btn-primary">Edit Profile</a>
                @if (auth()->user()?->isAdmin())
                    <form action="{{ route('residents.destroy', $resident) }}" method="POST" onsubmit="return confirm('Delete this resident record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="grid grid-cols-1 divide-y divide-slate-100 md:grid-cols-2 md:divide-x md:divide-y-0">
            <div class="space-y-5 p-5 sm:p-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">First Name</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->first_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Middle Name</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->middle_name ?: 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Last Name</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->last_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Birthdate</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->birthdate->format('F d, Y') }}</p>
                </div>
            </div>
            <div class="space-y-5 p-5 sm:p-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Contact Number</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->contact_number ?: 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Gender</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->gender }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Civil Status</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->civil_status }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Address</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->address }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Household ID</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">{{ $resident->household_code ?: 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Special Sectors</p>
                    <p class="mt-1 text-sm font-semibold text-slate-900">
                        @php
                            $tags = [];
                            if ($resident->is_pwd) $tags[] = 'PWD';
                            if ($resident->is_solo_parent) $tags[] = 'Solo Parent';
                            if ($resident->is_4ps) $tags[] = '4Ps';
                            if ($resident->is_voter) $tags[] = 'Voter';
                        @endphp
                        {{ $tags ? implode(', ', $tags) : 'None' }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
