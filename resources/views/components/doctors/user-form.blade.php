<x-layouts.user-form for="doctor" :$action :$formData>
    <div class="sm:col-span-3">
        <label for="specialization"
               class="block text-sm font-medium text-gray-700">Specialization</label>
        <div class="mt-1">
            <input type="text" name="specialization" id="specialization" required
                   autocomplete="specialization"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('specialization') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                   value="{{ old('specialization') ?? data_get($formData, "specialization")}}">
            @error('specialization')
            <p class="mt-2 text-sm text-red-600" id="specialization-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="qualification"
               class="block text-sm font-medium text-gray-700">Qualification</label>
        <div class="mt-1">
            <input type="text" name="qualification" id="qualification" required
                   autocomplete="qualification"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('qualification') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                   value="{{ old('qualification')?? data_get($formData, "qualification") }}">
            @error('qualification')
            <p class="mt-2 text-sm text-red-600" id="qualification-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="experience"
               class="block text-sm font-medium text-gray-700">Experience</label>
        <div class="mt-1">
            <input type="number" name="experience" id="experience" required
                   autocomplete="experience"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('experience') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                   value="{{ old('experience') ?? data_get($formData, "experience")}}">
            @error('experience')
            <p class="mt-2 text-sm text-red-600" id="experience-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>

    <div class="sm:col-span-3">
        <label for="status"
               class="block text-sm font-medium text-gray-700">Status</label>
        <div class="mt-1">
            <select name="status" id="status" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
            >
                <option value="active"
                    {{ (old('status') ?? data_get($formData, "status") == 'active' ? 'selected' : false) }}>
                    Available
                </option>
                <option value="inactive"
                    {{ (old('status') ?? data_get($formData, "status") == 'inactive' ? 'selected' : false) }}>
                    Not
                    Available
                </option>
            </select>
            @error('status')
            <p class="mt-2 text-sm text-red-600" id="status-error">
                {{ $message }}
            </p>
            @enderror
        </div>
    </div>
</x-layouts.user-form>
