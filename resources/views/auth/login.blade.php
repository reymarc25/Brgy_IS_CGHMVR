<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Barangay Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative min-h-screen overflow-hidden antialiased" style="background:
    radial-gradient(1100px circle at 12% 92%, rgba(236,72,153,0.42), transparent 50%),
    radial-gradient(1000px circle at 90% 8%, rgba(37,99,235,0.4), transparent 48%),
    linear-gradient(135deg, #2a1f3d 0%, #1e2a53 46%, #1b3766 100%);">
    <div class="pointer-events-none absolute inset-0" style="background:
        radial-gradient(circle at 50% 42%, rgba(255,255,255,0.14), transparent 60%),
        linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));"></div>
    <div class="pointer-events-none absolute -bottom-44 -left-40 h-[34rem] w-[40rem] rounded-full" style="background: rgba(236,72,153,0.34); filter: blur(90px);"></div>
    <div class="pointer-events-none absolute -top-36 right-12 h-[26rem] w-[34rem] rounded-full" style="background: rgba(37,99,235,0.34); filter: blur(90px);"></div>

    <div class="relative z-10 flex min-h-screen items-center justify-center p-4 sm:p-8">
    <div class="grid w-full max-w-5xl overflow-hidden rounded-3xl border border-slate-900/55 bg-white/60 shadow-2xl backdrop-blur-sm lg:grid-cols-2" style="box-shadow: 0 36px 80px -24px rgba(15, 23, 42, 0.45)">

        {{-- Left Branding Panel --}}
        <div class="relative hidden overflow-hidden bg-gradient-to-br from-pink-600/85 via-blue-600/80 to-blue-900/85 p-10 text-white lg:flex lg:flex-col lg:justify-between">
            {{-- Background decoration --}}
            <div class="pointer-events-none absolute -top-24 -right-24 h-64 w-64 rounded-full bg-white/5"></div>
            <div class="pointer-events-none absolute -bottom-16 -left-16 h-48 w-48 rounded-full bg-teal-500/20"></div>
            <div class="pointer-events-none absolute top-1/2 right-0 h-32 w-32 -translate-y-1/2 rounded-full bg-orange-400/10"></div>

            {{-- Top branding --}}
            <div class="relative">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 ring-2 ring-white/30">
                        <img src="{{ asset('favicon.png') }}" alt="BMS Logo" class="h-9 w-9 rounded-xl object-cover">
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-teal-200">Republic of the Philippines</p>
                        <p class="text-sm font-extrabold text-white">Barangay Management System</p>
                    </div>
                </div>

                <h1 class="mt-10 text-4xl font-black leading-tight">Serving the<br><span class="text-teal-200">Community</span><br>Digitally.</h1>
                <p class="mt-4 text-sm font-medium leading-relaxed text-teal-100/80">Fast resident profiling, demographic reports, and secure barangay records all in one place.</p>
            </div>

            {{-- Features list --}}
            <div class="relative space-y-3 text-sm">
                <div class="flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 backdrop-blur-sm">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-teal-400/30">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    Live dashboard with resident statistics
                </div>
                <div class="flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 backdrop-blur-sm">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-teal-400/30">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    Searchable and editable resident records
                </div>
                <div class="flex items-center gap-3 rounded-2xl bg-white/10 px-4 py-3 backdrop-blur-sm">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-teal-400/30">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    Role-based access via secure login
                </div>
            </div>
        </div>

        {{-- Right Login Panel --}}
        <div class="flex items-center bg-white/95 p-8 backdrop-blur sm:p-12">
            <div class="w-full">
                {{-- Mobile logo --}}
                <div class="mb-8 flex items-center gap-3 lg:hidden">
                    <img src="{{ asset('favicon.png') }}" alt="Logo" class="h-10 w-10 rounded-xl object-cover">
                    <div>
                        <p class="text-xs font-bold text-teal-600 uppercase tracking-widest">BMS</p>
                        <p class="text-sm font-extrabold text-slate-800">Barangay Management System</p>
                    </div>
                </div>
                <div class="mb-8">
                    <p class="text-xs font-extrabold uppercase tracking-[0.28em] text-teal-600">Secure Portal</p>
                    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">Admin Login</h2>
                    <p class="mt-2 text-sm text-slate-500">Use your barangay account to continue.</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="login-form" action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-teal-400 focus:ring-2 focus:ring-teal-100">
                        @error('email')
                            <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Password</label>
                        <input id="password" type="password" name="password" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-teal-400 focus:ring-2 focus:ring-teal-100">
                    </div>

                    <label class="flex items-center gap-2 text-sm font-medium text-slate-600">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500">
                        Keep me signed in
                    </label>

                    <button type="submit" class="w-full rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-teal-700">
                        <span data-label>Sign In</span>
                    </button>
                </form>

                <p class="mt-8 text-xs text-slate-500">Default admin: <strong>admin@barangay.gov</strong> / <strong>admin1234</strong></p>

                <div class="mt-6 border-t border-slate-100 pt-6">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-400 transition hover:text-teal-600">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
