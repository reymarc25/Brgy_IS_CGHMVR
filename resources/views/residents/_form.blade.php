@php
    $resident = $resident ?? null;
@endphp

<div class="grid grid-cols-1 gap-5 xl:grid-cols-3">
    <div>
        <label for="first_name" class="form-label">First Name</label>
        <input id="first_name" type="text" name="first_name" value="{{ old('first_name', $resident?->first_name) }}" required class="form-input">
        @error('first_name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="middle_name" class="form-label">Middle Name</label>
        <input id="middle_name" type="text" name="middle_name" value="{{ old('middle_name', $resident?->middle_name) }}" class="form-input">
        @error('middle_name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="last_name" class="form-label">Last Name</label>
        <input id="last_name" type="text" name="last_name" value="{{ old('last_name', $resident?->last_name) }}" required class="form-input">
        @error('last_name') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
    <div>
        <label for="birthdate" class="form-label">Birthdate</label>
        <input id="birthdate" type="date" name="birthdate" value="{{ old('birthdate', $resident?->birthdate?->format('Y-m-d')) }}" required class="form-input">
        @error('birthdate') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="gender" class="form-label">Gender</label>
        <select id="gender" name="gender" required class="form-input">
            <option value="">Select Gender</option>
            @foreach (['Male', 'Female'] as $gender)
                <option value="{{ $gender }}" @selected(old('gender', $resident?->gender) === $gender)>{{ $gender }}</option>
            @endforeach
        </select>
        @error('gender') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="civil_status" class="form-label">Civil Status</label>
        <select id="civil_status" name="civil_status" required class="form-input">
            <option value="">Select Status</option>
            @foreach (['Single', 'Married', 'Widowed', 'Separated'] as $status)
                <option value="{{ $status }}" @selected(old('civil_status', $resident?->civil_status) === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('civil_status') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="contact_number" class="form-label">Contact Number</label>
        <input id="contact_number" type="text" name="contact_number" value="{{ old('contact_number', $resident?->contact_number) }}" class="form-input">
        @error('contact_number') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="purok" class="form-label">Purok</label>
        <select id="purok" name="purok" required class="form-input">
            @foreach (['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7'] as $purok)
                <option value="{{ $purok }}" @selected(old('purok', $resident?->purok ?? 'Purok 1') === $purok)>{{ $purok }}</option>
            @endforeach
        </select>
        @error('purok') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="household_code" class="form-label">Household ID</label>
        <input id="household_code" type="text" name="household_code" value="{{ old('household_code', $resident?->household_code) }}" class="form-input" placeholder="HH-001">
        @error('household_code') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="resident_status" class="form-label">Resident Status</label>
        <select id="resident_status" name="resident_status" class="form-input">
            @foreach (['Active', 'Lumipat', 'Patay'] as $status)
                <option value="{{ $status }}" @selected(old('resident_status', $resident?->resident_status ?? 'Active') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('resident_status') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-5">
    <label for="address" class="form-label">Complete Address</label>
    <textarea id="address" name="address" rows="4" required class="form-input">{{ old('address', $resident?->address) }}</textarea>
    @error('address') <p class="mt-1 text-xs font-semibold text-red-600">{{ $message }}</p> @enderror
</div>

<div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
    <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700">
        <input type="checkbox" name="is_pwd" value="1" @checked(old('is_pwd', $resident?->is_pwd)) class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
        PWD
    </label>
    <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700">
        <input type="checkbox" name="is_solo_parent" value="1" @checked(old('is_solo_parent', $resident?->is_solo_parent)) class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
        Solo Parent
    </label>
    <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700">
        <input type="checkbox" name="is_4ps" value="1" @checked(old('is_4ps', $resident?->is_4ps)) class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
        4Ps Recipient
    </label>
    <label class="flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-700">
        <input type="checkbox" name="is_voter" value="1" @checked(old('is_voter', $resident?->is_voter)) class="rounded border-slate-300 text-teal-600 focus:ring-teal-500">
        Registered Voter
    </label>
</div>
