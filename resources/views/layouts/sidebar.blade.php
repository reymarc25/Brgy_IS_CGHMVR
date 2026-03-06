<div id="sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-slate-950/50 backdrop-blur-sm lg:hidden"></div>

@php
    $itemClass = function (bool $active): string {
        return 'nav-item group mb-1 flex items-center gap-3 rounded-2xl px-3 py-3 text-sm font-semibold transition ' .
            ($active
                ? 'bg-pink-50 text-pink-700 ring-1 ring-pink-200'
                : 'text-slate-600 hover:bg-slate-100');
    };

    $iconClass = function (bool $active): string {
        return 'inline-flex h-8 w-8 items-center justify-center rounded-xl shrink-0 ' .
            ($active
                ? 'bg-gradient-to-br from-pink-500 to-blue-500 text-white shadow'
                : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200');
    };
@endphp

<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col -translate-x-full border-r border-slate-200/80 bg-white shadow-2xl transition-all duration-300 lg:translate-x-0">
    <div class="relative overflow-hidden border-b border-slate-100 px-5 py-5">
        <div class="absolute -top-8 -right-8 h-24 w-24 rounded-full bg-blue-100"></div>
        <div class="absolute -bottom-10 -left-8 h-24 w-24 rounded-full bg-pink-100"></div>
        <div class="relative flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-pink-500 to-blue-500 shadow-lg shadow-pink-200 shrink-0">
                <img src="{{ asset('favicon.png') }}" alt="BMS Logo" class="h-8 w-8 rounded-xl object-cover">
            </div>
            <div class="brand-text">
                <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-pink-700">Barangay IS</p>
                <h1 class="text-base font-extrabold leading-tight text-slate-900">Management System</h1>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-5 overflow-y-auto px-3 py-4">
        <div>
            <p class="nav-section-title mb-2 px-3 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400">Main Menu</p>

            @php $isDash = request()->routeIs('admin.dashboard'); @endphp
            <a href="{{ route('admin.dashboard') }}" class="{{ $itemClass($isDash) }}">
                <span class="{{ $iconClass($isDash) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 17h7v7H3z" /></svg>
                </span>
                <span class="nav-label">Dashboard</span>
            </a>

            @php $isRes = request()->routeIs('residents.index') || request()->routeIs('residents.show') || request()->routeIs('residents.edit'); @endphp
            <a href="{{ route('residents.index') }}" class="{{ $itemClass($isRes) }}">
                <span class="{{ $iconClass($isRes) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0a5 5 0 00-10 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </span>
                <span class="nav-label">Resident List</span>
            </a>

            @php $isCreate = request()->routeIs('residents.create'); @endphp
            <a href="{{ route('residents.create') }}" class="{{ $itemClass($isCreate) }}">
                <span class="{{ $iconClass($isCreate) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                </span>
                <span class="nav-label">Add Resident</span>
            </a>

            @php $isDemog = request()->routeIs('demographic.*'); @endphp
            <a href="{{ route('demographic.index') }}" class="{{ $itemClass($isDemog) }}">
                <span class="{{ $iconClass($isDemog) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18m0 0h14m-4-4V9m-4 8V5m-4 12v-6" /></svg>
                </span>
                <span class="nav-label">Demographics</span>
            </a>

            @php $isDocs = request()->routeIs('documents.*'); @endphp
            <a href="{{ route('documents.index') }}" class="{{ $itemClass($isDocs) }}">
                <span class="{{ $iconClass($isDocs) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h8l5 5v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1zM14 3v5h5"/></svg>
                </span>
                <span class="nav-label">Document Issuance</span>
            </a>

            @php $isPurok = request()->routeIs('purok.*'); @endphp
            <a href="{{ route('purok.index') }}" class="{{ $itemClass($isPurok) }}">
                <span class="{{ $iconClass($isPurok) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 21h8m-4-4v4M5 3h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
                </span>
                <span class="nav-label">Purok List</span>
            </a>

            @php $isBlotter = request()->routeIs('blotter.*'); @endphp
            <a href="{{ route('blotter.index') }}" class="{{ $itemClass($isBlotter) }}">
                <span class="{{ $iconClass($isBlotter) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M8 4h8l4 4v12a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1h3z"/></svg>
                </span>
                <span class="nav-label">Blotter Cases</span>
            </a>

            @php $isAid = request()->routeIs('aid.*'); @endphp
            <a href="{{ route('aid.index') }}" class="{{ $itemClass($isAid) }}">
                <span class="{{ $iconClass($isAid) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6m3-7h6a2 2 0 012 2v10a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2z"/></svg>
                </span>
                <span class="nav-label">Aid Distribution</span>
            </a>
        </div>

        <div class="border-t border-slate-100 pt-4">
            <p class="nav-section-title mb-2 px-3 text-[10px] font-extrabold uppercase tracking-[0.2em] text-slate-400">Account</p>
            @php $isSec = request()->routeIs('password.*'); @endphp
            <a href="{{ route('password.change') }}" class="{{ $itemClass($isSec) }}">
                <span class="{{ $iconClass($isSec) }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                </span>
                <span class="nav-label">Security</span>
            </a>

            @if (auth()->user()?->isAdmin())
                @php $isAudit = request()->routeIs('audit.*'); @endphp
                <a href="{{ route('audit.index') }}" class="{{ $itemClass($isAudit) }}">
                    <span class="{{ $iconClass($isAudit) }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a3 3 0 013-3h3m-6-4h6m4 10H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2z"/></svg>
                    </span>
                    <span class="nav-label">Audit Logs</span>
                </a>
            @endif
        </div>
    </nav>
</aside>

<button id="sidebar-arrow-toggle" type="button" onclick="toggleSidebar()" class="fixed left-[17.25rem] top-1/2 z-[60] hidden h-10 w-6 -translate-y-1/2 items-center justify-center rounded-r-full border border-slate-200 bg-white text-slate-500 shadow transition hover:bg-slate-50 lg:flex">
    <svg class="h-4 w-4 transition-transform duration-300" id="sidebar-arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
</button>
