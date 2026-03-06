@extends('layouts.app')

@section('title', 'Residents')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="section-kicker">Resident Registry</p>
                <h1 class="page-title mt-2">Resident Records</h1>
                <p class="mt-2 text-sm text-slate-600">Manage and monitor all resident profiles in one table.</p>
            </div>
            <a href="{{ route('residents.create') }}" class="btn-primary">
                Add Resident
            </a>
        </div>
        <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
            <div class="rounded-xl bg-slate-50 p-3">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Records</p>
                <p class="mt-1 text-2xl font-extrabold text-slate-900">{{ number_format($residents->total()) }}</p>
            </div>
            <div class="rounded-xl bg-slate-50 p-3">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">This Page</p>
                <p class="mt-1 text-2xl font-extrabold text-slate-900">{{ number_format($residents->count()) }}</p>
            </div>
            <div class="rounded-xl bg-slate-50 p-3">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Current Page</p>
                <p class="mt-1 text-2xl font-extrabold text-slate-900">{{ $residents->currentPage() }}</p>
            </div>
            <div class="rounded-xl bg-slate-50 p-3">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">Last Page</p>
                <p class="mt-1 text-2xl font-extrabold text-slate-900">{{ $residents->lastPage() }}</p>
            </div>
        </div>
    </section>

    <section class="surface-card p-5 sm:p-6">
        <form method="GET" action="{{ route('residents.index') }}" class="grid grid-cols-1 gap-3 lg:grid-cols-7">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name, address, contact..." class="form-input lg:col-span-2">
            <select name="gender" class="form-input">
                <option value="">All Genders</option>
                @foreach (['Male', 'Female'] as $gender)
                    <option value="{{ $gender }}" @selected(request('gender') === $gender)>{{ $gender }}</option>
                @endforeach
            </select>
            <select name="civil_status" class="form-input">
                <option value="">All Civil Status</option>
                @foreach (['Single', 'Married', 'Widowed', 'Separated'] as $status)
                    <option value="{{ $status }}" @selected(request('civil_status') === $status)>{{ $status }}</option>
                @endforeach
            </select>
            <select name="purok" class="form-input">
                <option value="">All Purok</option>
                @foreach (['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7'] as $purok)
                    <option value="{{ $purok }}" @selected(request('purok') === $purok)>{{ $purok }}</option>
                @endforeach
            </select>
            <select name="sector" class="form-input">
                <option value="">All Sectors</option>
                <option value="senior" @selected(request('sector') === 'senior')>Senior Citizens</option>
                <option value="pwd" @selected(request('sector') === 'pwd')>PWDs</option>
                <option value="solo_parent" @selected(request('sector') === 'solo_parent')>Solo Parents</option>
                <option value="4ps" @selected(request('sector') === '4ps')>4Ps Recipients</option>
            </select>
            <div class="flex items-center gap-2">
                <button type="submit" class="btn-primary w-full">Apply</button>
                <a href="{{ route('residents.index') }}" class="btn-muted w-full">Reset</a>
            </div>
        </form>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4 text-left">Resident</th>
                        <th class="px-5 py-4 text-left">Birthdate / Age</th>
                        <th class="px-5 py-4 text-left">Address</th>
                        <th class="px-5 py-4 text-left">Contact</th>
                        <th class="px-5 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($residents as $resident)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-5 py-4">
                                <p class="font-semibold text-slate-900">{{ $resident->last_name }}, {{ $resident->first_name }} {{ $resident->middle_name }}</p>
                                <div class="mt-1 flex gap-2">
                                    <span class="data-pill">{{ $resident->gender }}</span>
                                    <span class="data-pill">{{ $resident->civil_status }}</span>
                                    <span class="data-pill">{{ $resident->purok }}</span>
                                    @if ($resident->is_pwd)<span class="data-pill">PWD</span>@endif
                                    @if ($resident->is_solo_parent)<span class="data-pill">Solo Parent</span>@endif
                                    @if ($resident->is_4ps)<span class="data-pill">4Ps</span>@endif
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-medium text-slate-700">{{ $resident->birthdate->format('M d, Y') }}</p>
                                <p class="text-xs text-slate-500">{{ $resident->age }} years old</p>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ \Illuminate\Support\Str::limit($resident->address, 48) }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ $resident->contact_number ?? 'N/A' }}</td>
                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex gap-2">
                                    <a href="{{ route('residents.show', $resident) }}" class="btn-muted px-3 py-2 text-xs">View</a>
                                    <a href="{{ route('residents.edit', $resident) }}" class="btn-muted px-3 py-2 text-xs">Edit</a>
                                    @if (auth()->user()?->isAdmin())
                                        <form action="{{ route('residents.destroy', $resident) }}" method="POST" onsubmit="return confirm('Delete this resident record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-xl bg-red-50 px-3 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-slate-500">No resident records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-100 px-5 py-4">
            {{ $residents->links() }}
        </div>
    </section>
</div>
@endsection
