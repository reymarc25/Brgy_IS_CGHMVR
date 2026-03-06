@extends('layouts.app')

@section('title', 'Aid Distribution')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <p class="section-kicker">Social Services</p>
        <h1 class="page-title mt-2">Relief / Aid Distribution Log</h1>
        <form action="{{ route('aid.store') }}" method="POST" class="mt-5 grid grid-cols-1 gap-3 md:grid-cols-6">
            @csrf
            <select name="resident_id" class="form-input md:col-span-2" required>
                <option value="">Resident</option>
                @foreach ($residents as $resident)
                    <option value="{{ $resident->id }}">{{ $resident->full_name }}</option>
                @endforeach
            </select>
            <input name="program_name" class="form-input" placeholder="Program" required>
            <input name="assistance_type" class="form-input" placeholder="Assistance Type" required>
            <input name="quantity" type="number" step="0.01" min="0.01" class="form-input" placeholder="Qty" required>
            <input name="distribution_date" type="date" class="form-input" required>
            <textarea name="remarks" rows="2" class="form-input md:col-span-5" placeholder="Remarks"></textarea>
            <button class="btn-primary md:col-span-1">Add Log</button>
        </form>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Resident</th>
                        <th class="px-4 py-3 text-left">Program</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Qty</th>
                        <th class="px-4 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($logs as $log)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-slate-800">{{ $log->resident?->full_name }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $log->program_name }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $log->assistance_type }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $log->quantity }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $log->distribution_date?->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No distribution logs yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-4 py-3">{{ $logs->links() }}</div>
    </section>
</div>
@endsection
