<div class="sm:col-span-{{ $item['colspan'] }}">
    <label for="{{ $key }}"
           class="block text-sm font-medium text-gray-700">{{ $item['label'] }}</label>
    <div class="mt-1">
        <input type="{{ $item['type'] }}" name="{{ $key }}" id="{{ $key }}" required
               autocomplete="{{ $key }}"
               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error($key) border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
               value="{{ old($key) }}"
        >
        @error($key)
        <p class="mt-2 text-sm text-red-600" id="name-error">
            {{ $message }}
        </p>
        @enderror
    </div>
</div>
