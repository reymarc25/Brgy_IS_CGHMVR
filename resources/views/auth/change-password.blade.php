@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-teal-600">Account Security</p>
        <h1 class="page-title mt-2">Change Password</h1>
        <p class="mt-2 text-sm text-slate-600">Update your password to keep your account secure.</p>
    </div>

    <div class="glass-card p-6 sm:p-8">
        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="mb-2 block text-xs font-bold uppercase tracking-[0.15em] text-slate-500">Current Password</label>
                <input id="current_password" name="current_password" type="password" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-teal-400 focus:ring-2 focus:ring-teal-100">
                @error('current_password')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-xs font-bold uppercase tracking-[0.15em] text-slate-500">New Password</label>
                <input id="password" name="password" type="password" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-teal-400 focus:ring-2 focus:ring-teal-100">
                @error('password')
                    <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-xs font-bold uppercase tracking-[0.15em] text-slate-500">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-teal-400 focus:ring-2 focus:ring-teal-100">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-xl bg-teal-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-teal-700">
                    Save New Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
