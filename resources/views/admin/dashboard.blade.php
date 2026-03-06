@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-teal-600">Overview</p>
            <h1 class="page-title mt-2">Barangay Dashboard</h1>
            <p class="mt-2 text-sm text-slate-600">Real-time profile of registered residents and demographics.</p>
        </div>
        <p class="text-sm font-semibold text-slate-400">{{ now()->format('l, F j, Y') }}</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="glass-card p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Population</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($summary['totalPopulation']) }}</p>
        </div>
        <div class="glass-card p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Estimated Households</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($summary['totalHouseholds']) }}</p>
        </div>
        <div class="glass-card p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Senior Citizens</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($summary['seniors']) }}</p>
        </div>
        <div class="glass-card p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Today's Birthdays</p>
            <p class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($summary['todaysBirthdays']) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
        <div class="glass-card p-5 xl:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900">Recent Resident Records</h2>
                <a href="{{ route('residents.index') }}" class="text-sm font-semibold text-teal-700 hover:text-teal-900">View all</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-sm">
                    <thead class="border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-3 py-3 text-left">Name</th>
                            <th class="px-3 py-3 text-left">Gender</th>
                            <th class="px-3 py-3 text-left">Age</th>
                            <th class="px-3 py-3 text-left">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentResidents as $resident)
                            <tr class="border-b border-slate-100">
                                <td class="px-3 py-3 font-semibold text-slate-800">{{ $resident->full_name }}</td>
                                <td class="px-3 py-3 text-slate-600">{{ $resident->gender }}</td>
                                <td class="px-3 py-3 text-slate-600">{{ $resident->age }}</td>
                                <td class="px-3 py-3 text-slate-600">{{ $resident->created_at?->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-6 text-center text-slate-500">No resident records yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="glass-card p-5">
                <h2 class="text-lg font-bold text-slate-900">Gender Breakdown</h2>
                <div class="mt-4 space-y-3">
                    @forelse ($genderStats as $gender)
                        <div class="flex items-center justify-between rounded-lg bg-slate-50 px-3 py-2 text-sm">
                            <span class="font-semibold text-slate-700">{{ $gender->gender }}</span>
                            <span class="data-pill">{{ number_format($gender->total) }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">No data available.</p>
                    @endforelse
                </div>
            </div>

            <div class="glass-card p-5">
                <h2 class="text-lg font-bold text-slate-900">Age Groups</h2>
                <div class="mt-4 space-y-3">
                    @foreach ($ageGroups as $label => $total)
                        @php
                            $percent = $summary['totalPopulation'] > 0 ? round(($total / $summary['totalPopulation']) * 100) : 0;
                        @endphp
                        <div>
                            <div class="mb-1 flex justify-between text-sm">
                                <span class="font-semibold text-slate-700">{{ $label }}</span>
                                <span class="text-slate-500">{{ $total }}</span>
                            </div>
                            <div class="h-2 rounded-full bg-slate-200">
                                <div class="h-2 rounded-full bg-teal-500" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
