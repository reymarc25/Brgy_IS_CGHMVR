@extends('layouts.app')

@section('title', 'Blotter Registry')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6 flex items-center justify-between">
        <div>
            <p class="section-kicker">Legal Module</p>
            <h1 class="page-title mt-2">Blotter Registry</h1>
        </div>
        <a href="{{ route('blotter.create') }}" class="btn-primary">New Case</a>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Case</th>
                        <th class="px-4 py-3 text-left">Complainant</th>
                        <th class="px-4 py-3 text-left">Respondent</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($cases as $case)
                        <tr>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-slate-800">{{ $case->incident_type }}</p>
                                <p class="text-xs text-slate-500">{{ \Illuminate\Support\Str::limit($case->narrative, 60) }}</p>
                            </td>
                            <td class="px-4 py-3 text-slate-700">{{ $case->complainantResident?->full_name ?? $case->complainant_name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $case->respondentResident?->full_name ?? $case->respondent_name ?? 'N/A' }}</td>
                            <td class="px-4 py-3"><span class="data-pill">{{ $case->status }}</span></td>
                            <td class="px-4 py-3">
                                <form action="{{ route('blotter.status.update', $case) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-input py-2">
                                        @foreach (['Pending', 'Scheduled for Mediation', 'Settled', 'Referred to PNP'] as $status)
                                            <option value="{{ $status }}" @selected($case->status === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn-muted px-3 py-2 text-xs">Save</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No blotter cases yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-4 py-3">{{ $cases->links() }}</div>
    </section>
</div>
@endsection
