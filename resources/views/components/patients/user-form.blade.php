<x-layouts.user-form for="patient" :$action :$formData>
    <div class="sm:col-span-3">
        <label for="medical_records"
               class="block text-sm font-medium text-gray-700">Medical Records</label>
        <div class="mt-1">
            <input type="text" name="medical_records" id="medical_records"
                   autocomplete="medical_records"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('medical_records') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                   value="{{ old('medical_records') ?? data_get($formData, "medical_records")}}">
            @error('medical_records')
            <p class="mt-2 text-sm text-red-600" id="medical_records-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="allergies"
               class="block text-sm font-medium text-gray-700">Allergies</label>
        <div class="mt-1">
            <input type="text" name="allergies" id="allergies"
                   autocomplete="allergies"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('allergies') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                   value="{{ old('allergies')?? data_get($formData, "allergies") }}">
            @error('allergies')
            <p class="mt-2 text-sm text-red-600" id="allergies-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="blood_type"
               class="block text-sm font-medium text-gray-700">Blood Type</label>
        <div class="mt-1">
            <select name="blood_type" id="blood_type"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('blood_type') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
            >
                <option value="">
                    Select your blood type
                </option>
                <option value="A"
                    {{ (old('blood_type') ?? data_get($formData, "blood_type") == 'A' ? 'selected' : false) }}>
                    A
                </option>
                <option value="B"
                    {{ (old('blood_type') ?? data_get($formData, "blood_type") == 'B' ? 'selected' : false) }}>
                    B
                </option>
                <option value="AB"
                    {{ (old('blood_type') ?? data_get($formData, "blood_type") == 'AB' ? 'selected' : false) }}>
                    AB
                </option>
                <option value="O"
                    {{ (old('blood_type') ?? data_get($formData, "blood_type") == 'O' ? 'selected' : false) }}>
                    O
                </option>
            </select>
            @error('blood_type')
            <p class="mt-2 text-sm text-red-600" id="blood_type-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="gender"
               class="block text-sm font-medium text-gray-700">Gender</label>
        <div class="mt-1">
            <select name="gender" id="gender"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('gender') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
            >
                <option value="">
                    Select your gender
                </option>
                <option value="male"
                    {{ (old('gender') ?? data_get($formData, "gender") == 'male' ? 'selected' : false) }}>
                    Male
                </option>
                <option value="female"
                    {{ (old('gender') ?? data_get($formData, "gender") == 'female' ? 'selected' : false) }}>
                    Female
                </option>
            </select>
            @error('gender')
            <p class="mt-2 text-sm text-red-600" id="gender-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>
</x-layouts.user-form>
