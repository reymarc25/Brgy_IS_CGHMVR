@extends('layouts.app')

@section('title', 'Demographics')

@section('content')
<div class="space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-teal-600">Analytics</p>
        <h1 class="page-title mt-2">Demographic Profile</h1>
        <p class="mt-2 text-sm text-slate-600">Resident distribution by age, gender, civil status, and monthly registrations.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="glass-card p-5">
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-slate-500">Total Residents</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($totalResidents) }}</p>
        </div>
        @foreach ($ageGroups as $group)
            <div class="glass-card p-5">
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-slate-500">{{ $group['label'] }}</p>
                <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($group['total']) }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-4">
        <div class="glass-card p-5">
            <h2 class="text-lg font-bold text-slate-900">Gender</h2>
            <div class="mt-4 space-y-3">
                @forelse ($genderBreakdown as $item)
                    @php $percent = $totalResidents > 0 ? round(($item->total / $totalResidents) * 100) : 0; @endphp
                    <div>
                        <div class="mb-1 flex justify-between text-sm">
                            <span class="font-semibold text-slate-700">{{ $item->gender }}</span>
                            <span class="text-slate-500">{{ $item->total }} ({{ $percent }}%)</span>
                        </div>
                        <div class="h-2 rounded-full bg-slate-200">
                            <div class="h-2 rounded-full bg-teal-500" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No data available.</p>
                @endforelse
            </div>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-lg font-bold text-slate-900">Civil Status</h2>
            <div class="mt-4 space-y-3">
                @forelse ($civilStatusBreakdown as $item)
                    <div class="flex items-center justify-between rounded-lg bg-slate-50 px-3 py-2 text-sm">
                        <span class="font-semibold text-slate-700">{{ $item->civil_status }}</span>
                        <span class="data-pill">{{ number_format($item->total) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No data available.</p>
                @endforelse
            </div>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-lg font-bold text-slate-900">New Registrations (6 months)</h2>
            <div class="mt-4 space-y-3">
                @foreach ($registrations as $item)
                    @php
                        $max = max($registrations->max('total'), 1);
                        $percent = round(($item['total'] / $max) * 100);
                    @endphp
                    <div>
                        <div class="mb-1 flex justify-between text-sm">
                            <span class="font-semibold text-slate-700">{{ $item['label'] }}</span>
                            <span class="text-slate-500">{{ $item['total'] }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-slate-200">
                            <div class="h-2 rounded-full bg-orange-500" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="glass-card p-5">
            <h2 class="text-lg font-bold text-slate-900">Voter vs Non-Voter</h2>
            @php
                $voterPercent = $totalResidents > 0 ? round(($voterCount / $totalResidents) * 100) : 0;
            @endphp
            <div class="mt-4 flex items-center gap-4">
                <div class="h-24 w-24 rounded-full" style="background: conic-gradient(#0d9488 0 {{ $voterPercent }}%, #cbd5e1 {{ $voterPercent }}% 100%);"></div>
                <div class="space-y-2 text-sm">
                    <p class="font-semibold text-slate-700">Voters: {{ $voterCount }} ({{ $voterPercent }}%)</p>
                    <p class="font-semibold text-slate-700">Non-Voters: {{ $nonVoterCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card p-5">
        <h2 class="text-lg font-bold text-slate-900">Household Map (Top 10)</h2>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-3 py-2">Household</th>
                        <th class="px-3 py-2">Members</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($householdMap as $household)
                        <tr>
                            <td class="px-3 py-2 text-slate-700">{{ $household->household_key }}</td>
                            <td class="px-3 py-2 font-semibold text-slate-900">{{ $household->total_members }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-3 py-4 text-slate-500">No household data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
