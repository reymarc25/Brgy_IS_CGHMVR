<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barangay Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}?v=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased overflow-x-hidden">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 inset-x-0 z-50 border-b border-white/10 bg-slate-900/90 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('favicon.png') }}" alt="BMS Logo" class="h-9 w-9 rounded-xl object-cover ring-2 ring-teal-400/40">
                <div class="leading-tight">
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-teal-400">Republic of the Philippines</p>
                    <p class="text-sm font-extrabold text-white">Barangay Management System</p>
                </div>
            </div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="rounded-xl bg-teal-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/30 transition hover:bg-teal-400">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-xl bg-teal-500 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-teal-500/30 transition hover:bg-teal-400">
                        Admin Login
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative min-h-screen bg-slate-900 pt-16 flex items-center overflow-hidden">
        <div class="pointer-events-none absolute -top-40 -right-40 h-[600px] w-[600px] rounded-full bg-teal-600/20 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -left-40 h-[600px] w-[600px] rounded-full bg-orange-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-[900px] w-[900px] rounded-full bg-teal-900/30 blur-3xl"></div>

        <div class="relative mx-auto max-w-5xl px-6 py-28 text-center">
            <span class="inline-flex items-center gap-2 rounded-full border border-teal-500/30 bg-teal-500/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-teal-300">
                <span class="h-1.5 w-1.5 rounded-full bg-teal-400 animate-pulse"></span>
                Digital Governance Platform
            </span>

            <div class="mt-8 flex justify-center">
                <div class="relative">
                    <div class="absolute inset-0 rounded-3xl bg-teal-500/20 blur-2xl scale-150"></div>
                    <img src="{{ asset('favicon.png') }}" alt="BMS Logo" class="relative h-24 w-24 rounded-3xl object-cover ring-4 ring-teal-400/40 shadow-2xl">
                </div>
            </div>

            <h1 class="mt-8 text-5xl font-black leading-tight text-white sm:text-6xl lg:text-7xl">
                Barangay<br>
                <span class="bg-gradient-to-r from-teal-400 to-cyan-300 bg-clip-text text-transparent">
                    Management System
                </span>
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-slate-400 leading-relaxed">
                Modernizing barangay governance — fast resident profiling, real-time demographic analytics,
                and secure digital records all in one platform.
            </p>

            <div class="mt-10 flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl bg-teal-500 px-8 py-4 text-base font-bold text-white shadow-xl shadow-teal-500/30 transition hover:bg-teal-400 hover:-translate-y-0.5">
                        Open Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-2xl bg-teal-500 px-8 py-4 text-base font-bold text-white shadow-xl shadow-teal-500/30 transition hover:bg-teal-400 hover:-translate-y-0.5">
                        Sign In to System
                    </a>
                    <a href="#features" class="inline-flex items-center gap-2 rounded-2xl border border-slate-700 bg-slate-800/50 px-8 py-4 text-base font-bold text-slate-300 transition hover:bg-slate-700 hover:-translate-y-0.5">
                        Learn More
                    </a>
                @endauth
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-3 gap-6">
                <div class="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-4 backdrop-blur">
                    <p class="text-2xl font-extrabold text-teal-400">100%</p>
                    <p class="mt-1 text-xs text-slate-500 font-medium">Digital Records</p>
                </div>
                <div class="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-4 backdrop-blur">
                    <p class="text-2xl font-extrabold text-teal-400">Real-time</p>
                    <p class="mt-1 text-xs text-slate-500 font-medium">Analytics</p>
                </div>
                <div class="rounded-2xl border border-slate-700/60 bg-slate-800/50 p-4 backdrop-blur">
                    <p class="text-2xl font-extrabold text-teal-400">Secure</p>
                    <p class="mt-1 text-xs text-slate-500 font-medium">Access Control</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section id="features" class="bg-slate-950 py-24">
        <div class="mx-auto max-w-6xl px-6">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-teal-400">Core Modules</p>
                <h2 class="mt-3 text-4xl font-black text-white">Everything you need to manage<br>your barangay efficiently</h2>
            </div>

            <div class="mt-16 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="group rounded-3xl border border-slate-800 bg-slate-900 p-8 transition hover:border-teal-500/50 hover:bg-slate-800/80">
                    <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-500/10 text-teal-400 ring-1 ring-teal-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Resident Registry</h3>
                    <p class="mt-2 text-sm text-slate-400 leading-relaxed">Complete resident profiling with searchable records, contact details, and household tracking.</p>
                </div>

                <div class="group rounded-3xl border border-slate-800 bg-slate-900 p-8 transition hover:border-teal-500/50 hover:bg-slate-800/80">
                    <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500/10 text-cyan-400 ring-1 ring-cyan-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Demographics Dashboard</h3>
                    <p class="mt-2 text-sm text-slate-400 leading-relaxed">Live population statistics with age group breakdowns, gender distribution, and trend analysis.</p>
                </div>

                <div class="group rounded-3xl border border-slate-800 bg-slate-900 p-8 transition hover:border-teal-500/50 hover:bg-slate-800/80">
                    <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-500/10 text-orange-400 ring-1 ring-orange-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Secure Access Control</h3>
                    <p class="mt-2 text-sm text-slate-400 leading-relaxed">Role-based authentication with secure barangay staff portals and audit trail logging.</p>
                </div>

                <div class="group rounded-3xl border border-slate-800 bg-slate-900 p-8 transition hover:border-teal-500/50 hover:bg-slate-800/80">
                    <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-500/10 text-purple-400 ring-1 ring-purple-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Advanced Search & Filter</h3>
                    <p class="mt-2 text-sm text-slate-400 leading-relaxed">Quickly find residents by name, address, gender, or civil status with powerful filtering tools.</p>
                </div>

                <div class="group rounded-3xl border border-slate-800 bg-slate-900 p-8 transition hover:border-teal-500/50 hover:bg-slate-800/80">
                    <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Birthday Monitoring</h3>
                    <p class="mt-2 text-sm text-slate-400 leading-relaxed">Track today's birthdays and upcoming milestones including senior citizen recognition.</p>
                </div>

                <div class="group rounded-3xl border border-slate-800 bg-slate-900 p-8 transition hover:border-teal-500/50 hover:bg-slate-800/80">
                    <div class="mb-5 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-500/10 text-rose-400 ring-1 ring-rose-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Digital Record Keeping</h3>
                    <p class="mt-2 text-sm text-slate-400 leading-relaxed">Paperless management of resident records with complete create, edit, and archive capabilities.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA BANNER --}}
    <section class="bg-gradient-to-br from-teal-700 via-teal-600 to-teal-800 py-20">
        <div class="mx-auto max-w-3xl px-6 text-center">
            <img src="{{ asset('favicon.png') }}" alt="Logo" class="mx-auto mb-6 h-16 w-16 rounded-2xl object-cover shadow-2xl ring-4 ring-white/20">
            <h2 class="text-3xl font-black text-white sm:text-4xl">Ready to digitize your barangay?</h2>
            <p class="mt-4 text-teal-100">Manage residents and demographics faster, smarter, and more securely.</p>
            @guest
                <a href="{{ route('login') }}" class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-white px-8 py-4 text-base font-bold text-teal-700 shadow-xl transition hover:bg-teal-50 hover:-translate-y-0.5">
                    Access the System
                </a>
            @endguest
            @auth
                <a href="{{ url('/dashboard') }}" class="mt-8 inline-flex items-center gap-2 rounded-2xl bg-white px-8 py-4 text-base font-bold text-teal-700 shadow-xl transition hover:bg-teal-50 hover:-translate-y-0.5">
                    Go to Dashboard
                </a>
            @endauth
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-slate-950 py-8 text-center">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-3 px-6 sm:flex-row sm:justify-between">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('favicon.png') }}" alt="Logo" class="h-7 w-7 rounded-lg object-cover">
                <span class="text-sm font-bold text-slate-400">Barangay Management System</span>
            </div>
            <p class="text-xs text-slate-600">&copy; {{ date('Y') }} All rights reserved. Built for the people of the barangay.</p>
        </div>
    </footer>

</body>
</html>
