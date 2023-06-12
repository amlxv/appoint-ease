<div class="px-4 sm:px-0 lg:px-0">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">{{ str($action)->title() }} {{ str($id)->title() }}</h1>
            <p class="mt-2 text-sm text-gray-700">Manage {{ $id }} information in the system.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            @if(request()->is('*/create'))
                <a href="{{ route(str($id)->plural().'.index') }}"
                   class="inline-flex items-center justify-center rounded-md border bg-white border-1 border-red-500 px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto transition-colors hover:text-white">
                    Cancel
                </a>
            @elseif(request()->is('*/edit'))
                <form action="{{ route(str($id)->plural().'.destroy', data_get($formData, "id")) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-md border bg-white border-1 border-red-500 px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto transition-colors hover:text-white">
                        Delete
                    </button>
                </form>
            @elseif(request()->is('profile'))
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center rounded-md border bg-white border-1 border-red-500 px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto transition-colors hover:text-white">
                    Cancel
                </a>
            @endif
        </div>
    </div>

    @if(session()->has('status'))
        <x-alert custom-class="mt-6" :type="session('status')" :message="session('message')"/>
    @endif

    <div class="mt-8">
        <div class="bg-white rounded-xl p-6 shadow-2xl">
            <form method="POST"
                  action="@if(request()->is('*/create')) {{ route(str($id)->plural().'.store') }} @elseif(request()->is('*/edit')) {{ route(str($id)->plural().'.update', data_get($formData, "id")) }} @elseif(request()->is('profile')) {{ route('profile.update') }} @endif"
                  class="space-y-8 divide-y divide-gray-200">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        @csrf

                        @if(request()->is('*/edit') || request()->is('profile'))
                            @method('PUT')
                        @endif

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
                                        <input id="avatar" name="avatar" type="file" class="sr-only"
                                               value="{{ old('avatar') }}">
                                    </label>
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="name"
                                       class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" required
                                           autocomplete="name"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                           value="{{ old('name') ?? data_get($formData, "user.name")}}">
                                    @error('name')
                                    <p class="mt-2 text-sm text-red-600" id="name-error">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="email"
                                       class="block text-sm font-medium text-gray-700">Email Address</label>
                                <div class="mt-1">
                                    <input type="email" name="email" id="email" required
                                           autocomplete="email"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                           value="{{ old('email') ?? data_get($formData, "user.email")}}">
                                    @error('email')
                                    <p class="mt-2 text-sm text-red-600" id="email-error">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password"
                                       class="block text-sm font-medium text-gray-700">Password</label>
                                <div class="mt-1">
                                    <input type="password" name="password" id="password"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                    >
                                    @if(request()->is('*/edit') || request()->is('profile'))
                                        <p class="mt-2 text-xs text-gray-600">
                                            Leave blank if you don't want to change the password.
                                        </p>
                                    @endif

                                    @error('password')
                                    <p class="mt-2 text-sm text-red-600" id="password-error">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password_confirmation"
                                       class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <div class="mt-1">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('password_confirmation') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                    >
                                    @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-600" id="password_confirmation-error">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="phone_number"
                                       class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <div class="mt-1">
                                    <input type="text" name="phone_number" id="phone_number" required
                                           autocomplete="phone_number"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('phone_number') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                           value="{{ old('phone_number') ?? data_get($formData, "user.phone_number")}}">
                                    @error('phone_number')
                                    <p class="mt-2 text-sm text-red-600" id="phone_number-error">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="address"
                                       class="block text-sm font-medium text-gray-700">Address</label>
                                <div class="mt-1">
                                    <input type="text" name="address" id="address" required
                                           autocomplete="address"
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:outline-none focus:ring-red-500 @enderror"
                                           value="{{ old('address') ?? data_get($formData, "user.address")}}">
                                    @error('address')
                                    <p class="mt-2 text-sm text-red-600" id="address-error">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ str($id)->title() }}
                            Information</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            The {{ $id }} information will be used for the doctor profile.
                        </p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        {{ $slot }}
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        @if(!request()->is('profile'))
                            <a href="{{ route(str($id)->plural().'.index') }}" type="button"
                               class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Cancel
                            </a>
                        @endif
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

