@extends('layouts.app')

@section('title', 'Document Issuance')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6 flex items-center justify-between">
        <div>
            <p class="section-kicker">Transactions</p>
            <h1 class="page-title mt-2">Document Issuance</h1>
            <p class="mt-2 text-sm text-slate-600">Process resident document requests and payments.</p>
        </div>
        <a href="{{ route('documents.create') }}" class="btn-primary">Request Document</a>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Resident</th>
                        <th class="px-4 py-3 text-left">Document</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Payment</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($documents as $document)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-slate-800">{{ $document->resident?->full_name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $document->document_type }}</td>
                            <td class="px-4 py-3"><span class="data-pill">{{ ucfirst($document->status) }}</span></td>
                            <td class="px-4 py-3 text-slate-600">PHP {{ number_format((float) $document->amount_paid, 2) }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('documents.show', $document) }}" class="btn-muted px-3 py-2 text-xs">Open</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No document requests yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-4 py-3">{{ $documents->links() }}</div>
    </section>
</div>
@endsection
