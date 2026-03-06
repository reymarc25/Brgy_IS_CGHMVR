@extends('layouts.app')

@section('title', 'Audit Logs')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <p class="section-kicker">Admin Only</p>
        <h1 class="page-title mt-2">System Audit Trail</h1>
        <p class="mt-2 text-sm text-slate-600">Tracks who edited what and when.</p>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-4 py-3 text-left">When</th>
                        <th class="px-4 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-left">Action</th>
                        <th class="px-4 py-3 text-left">Entity</th>
                        <th class="px-4 py-3 text-left">Details</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($logs as $log)
                        <tr>
                            <td class="px-4 py-3 text-slate-700">{{ $log->created_at?->format('M d, Y h:i A') }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $log->user?->name ?? 'System' }}</td>
                            <td class="px-4 py-3"><span class="data-pill">{{ $log->action }}</span></td>
                            <td class="px-4 py-3 text-slate-700">{{ $log->auditable_type }} #{{ $log->auditable_id }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ json_encode($log->new_values) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No audit logs yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-4 py-3">{{ $logs->links() }}</div>
    </section>
</div>
@endsection
