<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Barangay Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen antialiased font-['Manrope',sans-serif]" style="
    --base-navy: #0c2c4f;
    --deep-navy: #081f38;
    --soft-sky: #c5dff8;
    --signal-emerald: #0f9f82;
    --paper: #f5f7fb;
    background:
    radial-gradient(720px circle at 12% 16%, rgba(197,223,248,0.38), transparent 56%),
    radial-gradient(820px circle at 88% 84%, rgba(15,159,130,0.2), transparent 58%),
    linear-gradient(145deg, #071a30 0%, #0b2f54 58%, #134577 100%);
">
    <div class="pointer-events-none fixed inset-0" style="
        background-image: linear-gradient(rgba(255,255,255,0.045) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.045) 1px, transparent 1px);
        background-size: 36px 36px;
        mask-image: radial-gradient(circle at 50% 45%, #000 42%, transparent 100%);
    "></div>

    <main class="relative z-10 flex min-h-screen items-center justify-center p-4 sm:p-8 lg:p-10">
        <div class="grid w-full max-w-6xl overflow-hidden rounded-4xl border border-white/15 bg-white/8 shadow-[0_36px_90px_-32px_rgba(2,6,23,0.85)] backdrop-blur-sm lg:grid-cols-[1.05fr_0.95fr]">
            <section class="relative overflow-hidden bg-[linear-gradient(165deg,#0b2b4a_0%,#114070_52%,#0f9f82_140%)] p-8 text-white sm:p-10 lg:p-12">
                <div class="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full bg-white/10 blur-2xl"></div>
                <div class="pointer-events-none absolute -bottom-20 left-8 h-56 w-56 rounded-full bg-cyan-300/20 blur-2xl"></div>

                <div class="relative flex h-full flex-col justify-between gap-10">
                    <div>
                        <div class="inline-flex items-center gap-3 rounded-2xl border border-white/20 bg-white/10 px-4 py-3">
                            <img src="{{ asset('favicon.png') }}" alt="BMS Logo" class="h-10 w-10 rounded-xl object-cover ring-1 ring-white/30">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-sky-100/85">Republic of the Philippines</p>
                                <p class="text-sm font-extrabold text-white">Barangay Management System</p>
                            </div>
                        </div>

                        <h1 class="mt-10 max-w-md text-4xl font-extrabold leading-tight sm:text-5xl font-['Sora',sans-serif]">
                            Trusted Records.
                            <span class="block text-cyan-100">Safer Services.</span>
                            Better Barangay Governance.
                        </h1>

                        <p class="mt-5 max-w-md text-sm leading-relaxed text-sky-100/90 sm:text-base">
                            Centralized resident profiles, transparent documentation, and daily barangay operations in one secure professional portal.
                        </p>
                    </div>

                    <div class="grid gap-3 text-sm">
                        <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 backdrop-blur">
                            Real-time resident and purok overview
                        </div>
                        <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 backdrop-blur">
                            Standardized document and blotter handling
                        </div>
                        <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 backdrop-blur">
                            Role-based admin access with activity logs
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-(--paper) p-7 sm:p-10 lg:p-12">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-8 flex items-center gap-3 lg:hidden">
                        <img src="{{ asset('favicon.png') }}" alt="Logo" class="h-10 w-10 rounded-xl object-cover">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-slate-500">BMS Portal</p>
                            <p class="text-sm font-bold text-slate-900">Barangay Management System</p>
                        </div>
                    </div>

                    <p class="text-xs font-extrabold uppercase tracking-[0.26em] text-(--signal-emerald)">Secure Access</p>
                    <h2 class="mt-3 text-3xl font-extrabold text-slate-900 font-['Sora',sans-serif]">Admin Login</h2>
                    <p class="mt-2 text-sm text-slate-600">Sign in to continue to the barangay administration portal.</p>

                    @if (session('success'))
                        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="login-form" action="{{ route('login.authenticate') }}" method="POST" class="mt-7 space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-(--signal-emerald) focus:ring-4 focus:ring-emerald-100"
                                placeholder="admin@barangay.gov"
                            >
                            @error('email')
                                <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-(--signal-emerald) focus:ring-4 focus:ring-emerald-100"
                                placeholder="Enter your password"
                            >
                        </div>

                        <label class="flex items-center gap-2.5 text-sm font-medium text-slate-600">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-(--signal-emerald) focus:ring-(--signal-emerald)">
                            Keep me signed in
                        </label>

                        <button type="submit" class="w-full rounded-2xl bg-(--base-navy) px-4 py-3 text-sm font-bold text-white shadow-[0_14px_30px_-16px_rgba(8,31,56,0.85)] transition hover:-translate-y-0.5 hover:bg-(--deep-navy)">
                            <span data-label>Sign In</span>
                        </button>
                    </form>

                    <div class="mt-7 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-xs text-slate-600">
                        Default admin credentials: <strong>admin@barangay.gov</strong> / <strong>admin1234</strong>
                    </div>

                    <div class="mt-6 border-t border-slate-200/80 pt-6">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 transition hover:text-(--base-navy)">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Back to homepage
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
