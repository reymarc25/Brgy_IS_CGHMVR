<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barangay Management System')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}?v=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-slate-900 antialiased">
    <div class="print:hidden">
        @include('layouts.sidebar')
    </div>

    <div id="app-shell" class="min-h-screen lg:pl-72">
        <main class="w-full p-4 sm:p-6 lg:p-8 print:p-0">
            <div class="relative z-40 mb-4 flex items-center justify-between print:hidden">
                <span></span>

                <div class="ml-auto flex items-center gap-3">
                    <button type="button" class="relative inline-flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-slate-100 hover:text-slate-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0" />
                        </svg>
                        <span class="absolute right-2.5 top-2 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>

                    <div class="relative z-50" id="user-menu">
                        <button type="button" onclick="toggleUserMenu()" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-pink-500 to-blue-500 text-xs font-bold text-white shadow-md shadow-pink-200 transition hover:brightness-95">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </button>

                        <div id="user-dropdown" class="hidden absolute right-0 z-[120] mt-2 w-56 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl">
                            <div class="bg-gradient-to-r from-pink-500 to-blue-500 px-4 py-4 text-white">
                                <p class="text-sm font-bold">{{ auth()->user()->name ?? 'Administrator' }}</p>
                                <p class="text-xs text-pink-100">{{ auth()->user()->email ?? '' }}</p>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('password.change') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                    Settings
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="mt-1 flex w-full items-center gap-2 rounded-xl px-3 py-2 text-left text-sm font-semibold text-red-600 hover:bg-red-50">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 print:hidden">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
