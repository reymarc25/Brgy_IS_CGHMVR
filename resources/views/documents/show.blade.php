@extends('layouts.app')

@section('title', 'Document Preview')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6 flex flex-wrap items-center justify-between gap-3 print:hidden">
        <div>
            <p class="section-kicker">Certificate Preview</p>
            <h1 class="page-title mt-2">{{ $document->document_type }}</h1>
            <p class="mt-2 text-sm text-slate-600">{{ $document->resident?->full_name }}</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <button type="button" onclick="window.print()" class="btn-primary">Print / Save PDF</button>
            @if ($document->status !== 'cancelled')
                <form action="{{ route('documents.cancel', $document) }}" method="POST" onsubmit="return confirm('Cancel this document request?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-muted">Cancel Request</button>
                </form>
            @endif
            @if (auth()->user()?->isAdmin())
                <form action="{{ route('documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Delete this document request permanently?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete</button>
                </form>
            @endif
        </div>
    </section>

    @php
        $resident = $document->resident;
        $issuedDate = now()->format('jS \d\a\y \o\f F, Y');
    @endphp

    @if ($document->document_type === 'Indigency')
        <section class="surface-card print-a4 bg-white p-6 sm:p-10 print:border-0 print:shadow-none">
            <div class="relative mx-auto max-w-3xl overflow-hidden bg-white px-4 py-6 sm:px-10">
                <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                    <div class="h-[28rem] w-[28rem] rounded-full border-[14px] border-blue-200/45"></div>
                </div>
                <div class="pointer-events-none absolute inset-0 flex items-center justify-center">
                    <img src="{{ asset('favicon.png') }}" alt="Watermark" class="h-72 w-72 opacity-10">
                </div>

                <div class="relative z-10">
                    <div class="mb-5 flex items-start justify-between">
                        <img src="{{ asset('favicon.png') }}" alt="Barangay Logo" class="h-20 w-20 object-contain">
                        <div class="text-center text-slate-900">
                            <p class="text-2xl font-black tracking-wide">BARANGAY AGSILAB</p>
                            <p class="text-sm font-semibold">TANGGAPAN NG PUNONG BARANGAY</p>
                        </div>
                        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-blue-600 via-red-500 to-yellow-400"></div>
                    </div>

                    <div class="mb-8 text-center">
                        <p class="text-lg font-black tracking-wide">CERTIFICATE OF INDIGENCY</p>
                    </div>

                    <div class="space-y-4 text-[17px] leading-8 text-slate-900">
                        <p class="font-semibold">TO WHOM IT MAY CONCERN:</p>
                        <p>
                            This is to certify that
                            <span class="font-black underline uppercase">{{ $resident?->full_name }}</span>
                            born on
                            <span class="font-semibold">{{ $resident?->birthdate?->format('F d, Y') }}</span>,
                            of legal age, a resident of
                            <span class="font-semibold">{{ $resident?->address }}</span>,
                            belongs to no income / low income bracket in the barangay.
                        </p>
                        <p>
                            This certification is being issued upon the request of the above-mentioned name for whatever legal
                            purpose/s this may serve him/her best.
                        </p>
                        <p>
                            Issued this {{ $issuedDate }} at the Office of the Punong Barangay, Barangay Agsilab, Sapian, Capiz.
                        </p>
                    </div>

                    <div class="mt-16 text-right">
                        <p class="text-xl font-black uppercase">BASSANIO V. TUPAZ, MPA</p>
                        <p class="text-sm font-semibold">Punong Barangay</p>
                    </div>
                </div>
            </div>
        </section>
    @elseif ($document->document_type === 'Barangay Clearance')
        <section class="surface-card print-a4 bg-white p-6 sm:p-10 print:border-0 print:shadow-none">
            <div class="mx-auto max-w-3xl border-4 border-slate-700 bg-white px-6 py-8 sm:px-10">
                <div class="mb-6 flex items-start justify-between">
                    <img src="{{ asset('favicon.png') }}" alt="Barangay Logo" class="h-20 w-20 object-contain">
                    <div class="text-center">
                        <p class="text-sm">Republic of the Philippines</p>
                        <p class="text-sm">Province of Capiz</p>
                        <p class="text-sm">Municipality of Sapian</p>
                        <p class="text-xl font-black uppercase">Barangay Agsilab</p>
                        <p class="mt-2 text-sm font-semibold uppercase">Office of the Barangay Captain</p>
                    </div>
                    <img src="{{ asset('favicon.png') }}" alt="Municipality Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="mb-8 text-center text-4xl font-black uppercase tracking-wide">Barangay Clearance</h2>
                <div class="space-y-4 text-[16px] leading-8">
                    <p class="font-semibold">To Whom It May Concern:</p>
                    <p>
                        This is to certify that <strong>{{ strtoupper($resident?->full_name) }}</strong>, of legal age,
                        and a resident of <strong>{{ $resident?->address }}</strong>, has no derogatory records and is
                        in good standing in this barangay.
                    </p>
                    <p>
                        This clearance is issued upon the request of the above named person for
                        <strong>{{ $document->purpose ?: 'legal purpose/s' }}</strong>.
                    </p>
                    <p>Issued this {{ $issuedDate }} at the office of the Barangay Captain.</p>
                </div>
                <div class="mt-16 text-right">
                    <p class="text-xl font-black uppercase">BASSANIO V. TUPAZ, MPA</p>
                    <p class="text-sm">Punong Barangay</p>
                </div>
                <div class="mt-12 text-sm">
                    <p>Paid Under OR #: {{ $document->or_number ?: '____________' }}</p>
                    <p>Amount Paid: PHP {{ number_format((float) $document->amount_paid, 2) }}</p>
                </div>
            </div>
        </section>
    @elseif ($document->document_type === 'Residency')
        <section class="surface-card print-a4 bg-white p-6 sm:p-10 print:border-0 print:shadow-none">
            <div class="mx-auto max-w-3xl bg-white px-6 py-8 sm:px-10">
                <div class="mb-6 flex items-start justify-between">
                    <img src="{{ asset('favicon.png') }}" alt="Barangay Logo" class="h-20 w-20 object-contain">
                    <div class="text-center">
                        <p class="text-sm">Republic of the Philippines</p>
                        <p class="text-sm">Province of Capiz</p>
                        <p class="text-sm">Municipality of Sapian</p>
                        <p class="text-2xl font-black uppercase">Barangay Agsilab</p>
                        <p class="mt-2 text-sm font-semibold uppercase">Office of the Barangay Captain</p>
                    </div>
                    <img src="{{ asset('favicon.png') }}" alt="Municipality Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="mb-12 text-center text-4xl font-black uppercase tracking-wide">Certificate of Residency</h2>
                <div class="space-y-6 text-[16px] leading-8">
                    <p class="font-semibold">To Whom It May Concern:</p>
                    <p>
                        This is to certify that <strong>{{ strtoupper($resident?->full_name) }}</strong> is a permanent
                        resident of <strong>{{ $resident?->address }}</strong> and has been residing in this barangay.
                    </p>
                    <p>
                        This certification is issued upon request for
                        <strong>{{ $document->purpose ?: 'legal purpose/s' }}</strong>.
                    </p>
                    <p>Issued this {{ $issuedDate }} at Barangay Agsilab, Sapian, Capiz.</p>
                </div>
                <div class="mt-24 flex items-end justify-between">
                    <div>
                        <p class="text-sm">Specimen Signature:</p>
                        <div class="mt-6 h-10 w-40 border-b border-slate-500"></div>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black uppercase">BASSANIO V. TUPAZ, MPA</p>
                        <p class="text-sm">Punong Barangay</p>
                    </div>
                </div>
            </div>
        </section>
    @elseif ($document->document_type === 'Business Permit')
        <section class="surface-card print-a4 bg-white p-6 sm:p-10 print:border-0 print:shadow-none">
            <div class="mx-auto max-w-3xl border-4 border-slate-700 bg-white px-6 py-8 sm:px-10">
                <div class="mb-6 flex items-start justify-between">
                    <img src="{{ asset('favicon.png') }}" alt="Barangay Logo" class="h-20 w-20 object-contain">
                    <div class="text-center">
                        <p class="text-sm">Republic of the Philippines</p>
                        <p class="text-sm">Province of Capiz</p>
                        <p class="text-sm">Municipality of Sapian</p>
                        <p class="text-xl font-black uppercase">Barangay Agsilab</p>
                        <p class="mt-2 text-sm font-semibold uppercase">Office of the Punong Barangay</p>
                    </div>
                    <img src="{{ asset('favicon.png') }}" alt="Municipality Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="mb-8 text-center text-4xl font-black uppercase tracking-wide">Barangay Business Permit</h2>
                <div class="grid grid-cols-1 gap-3 text-[16px] leading-8">
                    <p><strong>Name of Owner:</strong> {{ strtoupper($resident?->full_name) }}</p>
                    <p><strong>Business Address:</strong> {{ $resident?->address }}</p>
                    <p><strong>Nature of Business:</strong> {{ $document->purpose ?: 'Sari-sari Store' }}</p>
                    <p><strong>Permit Number:</strong> BP-{{ str_pad((string) $document->id, 4, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Status:</strong> Operating</p>
                </div>
                <p class="mt-5 text-[16px] leading-8">
                    This permit is issued subject to existing rules and regulations and is valid for business operations
                    within this barangay.
                </p>
                <p class="mt-4 text-[16px] leading-8">Given this {{ $issuedDate }} at Barangay Agsilab, Sapian, Capiz.</p>
                <div class="mt-16 flex items-end justify-between">
                    <div>
                        <p class="text-sm font-semibold">{{ strtoupper($resident?->full_name) }}</p>
                        <p class="text-xs uppercase">Owner</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black uppercase">BASSANIO V. TUPAZ, MPA</p>
                        <p class="text-sm">Punong Barangay</p>
                    </div>
                </div>
                <div class="mt-12 text-sm">
                    <p>OR #: {{ $document->or_number ?: '____________' }}</p>
                    <p>Amount Paid: PHP {{ number_format((float) $document->amount_paid, 2) }}</p>
                </div>
            </div>
        </section>
    @else
        <section class="surface-card print-a4 p-6 sm:p-10">
            <div class="mx-auto max-w-3xl space-y-6">
                <div class="text-center">
                    <div class="mx-auto mb-3 h-20 w-20 rounded-full border-2 border-dashed border-slate-300"></div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Barangay Logo Placeholder</p>
                    <h2 class="mt-4 text-2xl font-extrabold text-slate-900">{{ strtoupper($document->document_type) }}</h2>
                </div>
                <p class="text-sm leading-7 text-slate-700">
                    This certifies that <strong>{{ $resident?->full_name }}</strong>, residing at
                    <strong>{{ $resident?->address }}</strong>, is a bonafide resident of this barangay.
                </p>
                <p class="text-sm leading-7 text-slate-700">Purpose: {{ $document->purpose ?: 'Not specified' }}</p>
                <div class="grid grid-cols-1 gap-6 pt-8 sm:grid-cols-2">
                    <div class="text-center">
                        <div class="mx-auto h-12 w-40 border-b border-slate-400"></div>
                        <p class="mt-2 text-xs uppercase tracking-wider text-slate-500">Captain Signature Placeholder</p>
                    </div>
                    <div class="text-center">
                        <div class="mx-auto h-20 w-20 rounded-full border-2 border-dashed border-slate-300"></div>
                        <p class="mt-2 text-xs uppercase tracking-wider text-slate-500">Dry Seal Placeholder</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="surface-card mt-8 p-5 sm:p-6 print:hidden">
        <h2 class="text-lg font-bold text-slate-900">Payment Tracker</h2>
        <form action="{{ route('documents.payment.update', $document) }}" method="POST" class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-4">
            @csrf
            @method('PUT')
            <input type="text" name="or_number" value="{{ old('or_number', $document->or_number) }}" placeholder="OR Number" class="form-input">
            <input type="number" step="0.01" min="0" name="amount_paid" value="{{ old('amount_paid', $document->amount_paid) }}" placeholder="Amount Paid" class="form-input" required>
            <input type="date" name="payment_date" value="{{ old('payment_date', optional($document->payment_date)->format('Y-m-d')) }}" class="form-input">
            <button type="submit" class="btn-primary">Update Payment</button>
        </form>
    </section>
</div>
@endsection
