@extends('layouts.template')


@section('x-content')
    <div class="px-4 sm:px-0 lg:px-0">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">New Doctor</h1>
                <p class="mt-2 text-sm text-gray-700">Register a new doctor into the system.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('doctors') }}"
                   class="inline-flex items-center justify-center rounded-md border bg-white border-1 border-red-500 px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto transition-colors hover:text-white">
                    Cancel
                </a>
            </div>
        </div>
        <div class="mt-8">
            <div class="bg-white rounded-xl p-6 shadow-2xl">
                <form method="POST" action="{{ route('doctors.store') }}" class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 divide-y divide-gray-200">
                        <div>
                            @csrf
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">User Information</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    The user information will be used for login into the system.
                                </p>
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <div class="mt-3 flex flex-col items-center justify-center space-y-6">
                                        <span class="h-32 w-32 overflow-hidden rounded-full bg-gray-100">
                                            <svg class="h-full w-full text-gray-300" fill="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path
                                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                        </span>
                                        <label for="avatar"
                                               class="rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer">
                                            <span>Change</span>
                                            <input id="avatar" name="avatar" type="file" class="sr-only">
                                        </label>
                                    </div>
                                </div>

                                @foreach($items as $key => $item)
                                    <x-inputs.user-add-input :$item :$key/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pt-8">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Doctor Information</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                The doctor information will be used for the doctor profile.
                            </p>
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            @foreach($additionalItems as $key => $item)
                                <x-inputs.user-add-input :$item :$key/>
                            @endforeach
                        </div>
                    </div>

            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <button type="button"
                            class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancel
                    </button>
                    <button type="submit"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>

@endsection
