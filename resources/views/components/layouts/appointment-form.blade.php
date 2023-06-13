<div class="px-4 sm:px-0 lg:px-0">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">{{ str($action)->title() }} Appointment</h1>
            <p class="mt-2 text-sm text-gray-700">Manage appointment information in the system.</p>
        </div>

        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('appointments.index') }}"
               class="inline-flex items-center justify-center rounded-md border bg-white border-1 border-red-500 px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto transition-colors hover:text-white">
                Cancel
            </a>
        </div>
    </div>

    @if(session()->has('status'))
        <x-alert custom-class="mt-6" :type="session('status')" :message="session('message')"/>
    @endif

    <div class="mt-8">
        <div class="bg-white rounded-xl p-6 shadow-2xl">
            <form method="POST"
                  action="{{ (request()->is('*/create')) ? route('appointments.store') : route('appointments.update', data_get($formData, "id")) }}"
                  class="space-y-8 divide-y divide-gray-200">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        @csrf

                        @if(request()->is('*/edit'))
                            @method('PUT')
                        @endif

                        @if(auth()->user()->isPatient())
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Appointment Information</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    This information will be shared with the doctors.
                                </p>
                            </div>

                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                <div class="sm:col-span-6">
                                    <label for="case"
                                           class="block text-sm font-medium text-gray-700">Case</label>
                                    <div class="mt-1">
                                        <input type="text" name="case" id="case" required
                                               autocomplete="case"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('case') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('case') ?? data_get($formData, "case")}}">
                                        @error('case')
                                        <p class="mt-2 text-sm text-red-600" id="case-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="date"
                                           class="block text-sm font-medium text-gray-700">Date</label>
                                    <div class="mt-1">
                                        <input type="date" name="date" id="date" required
                                               autocomplete="date"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('date') ?? data_get($formData, "date")}}"
                                        >
                                        <p class="mt-2 text-sm text-gray-600">
                                            The date must be at least 7 days from now.
                                        </p>
                                        @error('date')
                                        <p class="mt-2 text-sm text-red-600" id="date-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="time"
                                           class="block text-sm font-medium text-gray-700">Time</label>
                                    <div class="mt-1">
                                        <input type="time" name="time" id="time" required
                                               autocomplete="time"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('time') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('time') ?? data_get($formData, "time")}}">
                                        @error('time')
                                        <p class="mt-2 text-sm text-red-600" id="time-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="doctor"
                                           class="block text-sm font-medium text-gray-700">Doctor</label>
                                    <div class="mt-1">
                                        <select name="doctor" id="doctor"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('doctor') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                                required>
                                            <option value="">Select a doctor</option>
                                            @foreach($formData['doctors'] as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                        @if(old('doctor') == $doctor->id || data_get($formData, "doctor_id") == $doctor->id) selected @endif>{{ $doctor->user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('doctor')
                                        <p class="mt-2 text-sm text-red-600" id="doctor-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        @endif

                        @if(auth()->user()->isDoctor())
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Update Appointment</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    This information will be synced with the patient.
                                </p>
                            </div>

                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                <div class="sm:col-span-6">
                                    <label for="case"
                                           class="block text-sm font-medium text-gray-700">Case</label>
                                    <div class="mt-1">
                                        <input type="text" name="case" id="case" required
                                               autocomplete="case"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('case') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('case') ?? data_get($formData, "case")}}" readonly>
                                        @error('case')
                                        <p class="mt-2 text-sm text-red-600" id="case-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="date"
                                           class="block text-sm font-medium text-gray-700">Date</label>
                                    <div class="mt-1">
                                        <input type="date" name="date" id="date" required
                                               autocomplete="date"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('date') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('date') ?? data_get($formData, "date")}}" readonly
                                        >
                                        @error('date')
                                        <p class="mt-2 text-sm text-red-600" id="date-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="time"
                                           class="block text-sm font-medium text-gray-700">Time</label>
                                    <div class="mt-1">
                                        <input type="time" name="time" id="time" required
                                               autocomplete="time"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('time') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('time') ?? data_get($formData, "time")}}" readonly>
                                        @error('time')
                                        <p class="mt-2 text-sm text-red-600" id="time-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="medical_certificate"
                                           class="block text-sm font-medium text-gray-700">Medical Certificate
                                        (Day/s)</label>
                                    <div class="mt-1">
                                        <input type="number" min="0" name="medical_certificate" id="medical_certificate"
                                               autocomplete="medical_certificate"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('medical_certificate') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                               value="{{ old('medical_certificate') ?? data_get($formData, "medical_certificate")}}"
                                        >
                                        <p class="mt-2 text-xs text-gray-600">
                                            Leave blank if not required.
                                        </p>
                                        @error('case')
                                        <p class="mt-2 text-sm text-red-600" id="medical_certificate-error">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>

                <div class="pt-5 flex justify-between items-center">
                    @if(auth()->user()->isPatient())
                        <div class="text-sm text-gray-600">
                            A new appointment will cost you <span
                                class="font-medium text-gray-900">RM 150</span>.
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('appointments.index') }}" type="button"
                               class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Pay
                            </button>
                        </div>
                    @endif
                    @if(auth()->user()->isDoctor())
                        <div class="text-sm text-gray-600">

                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Mark as done
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

