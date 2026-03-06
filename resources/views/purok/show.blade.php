@extends('layouts.app')

@section('title', $purok . ' Residents')

@section('content')
<div class="space-y-6">
    <section class="surface-card p-5 sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="section-kicker">Community Mapping</p>
                <h1 class="page-title mt-2">{{ $purok }} Residents</h1>
                <p class="mt-2 text-sm text-slate-600">Listahan ng lahat ng nakatira sa {{ $purok }}.</p>
            </div>
            <a href="{{ route('purok.index') }}" class="btn-muted">Back to Purok List</a>
        </div>
    </section>

    <section class="surface-card p-5 sm:p-6">
        <form method="GET" action="{{ route('purok.show', (int) str_replace('Purok ', '', $purok)) }}" class="grid grid-cols-1 gap-3 sm:grid-cols-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name or address..." class="form-input sm:col-span-3">
            <button type="submit" class="btn-primary">Search</button>
        </form>
    </section>

    <section class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Age</th>
                        <th class="px-4 py-3 text-left">Gender</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Address</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($residents as $resident)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-slate-800">{{ $resident->full_name }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $resident->age }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $resident->gender }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('residents.status.update', $resident) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="resident_status" class="form-input py-2 text-xs">
                                        @foreach (['Active', 'Lumipat', 'Patay'] as $status)
                                            <option value="{{ $status }}" @selected($resident->resident_status === $status)>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn-muted px-2 py-1 text-xs">Save</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ $resident->address }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('residents.show', $resident) }}" class="btn-muted px-3 py-2 text-xs">View</a>
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
                            <td colspan="6" class="px-4 py-10 text-center text-slate-500">Walang residenteng nahanap sa search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-4 py-3">
            {{ $residents->links() }}
        </div>
    </section>
</div>
@endsection
