@extends('layouts.app')

@section('title', 'Purok List')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <p class="section-kicker">Community Mapping</p>
        <h1 class="page-title mt-2">Purok Resident List</h1>
        <p class="mt-2 text-sm text-slate-600">Kabuuang residente: <strong>{{ number_format($totalResidents) }}</strong></p>
    </section>

    <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">
        @foreach ($groupedResidents as $purok => $residents)
            <section class="surface-card p-5 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">{{ $purok }}</h2>
                        <p class="mt-1 text-sm text-slate-500">Residents are shown only in the view page.</p>
                    </div>
                    <span class="data-pill">{{ $residents->count() }} residents</span>
                </div>
                <div class="mt-5">
                    <a href="{{ route('purok.show', (int) str_replace('Purok ', '', $purok)) }}" class="btn-primary">View Residents</a>
                </div>
            </section>
        @endforeach
    </div>
</div>
@endsection
