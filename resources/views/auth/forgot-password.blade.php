@extends('layouts.scaffold')

@section('content')
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto" src="{{ asset('images/logo.svg') }}" alt="AppointEase">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Forgot password?</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Dont't worry we will send you a reset link to your email.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="#" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Reset
                            password</button>

                        @if (session('status'))
                            <div class="mt-4">
                                <x-alert type="success" :message="session('status')"></x-alert>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mt-4">
                                <x-alert type="error" :message="$errors->first()"></x-alert>
                            </div>
                        @endif

                    </div>
                </form>
            </div>

            <div class="text-sm mt-8 ml-4">
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    <span class="ml-2">Back to login</span>
                </a>
            </div>
        </div>

    </div>
@endsection
