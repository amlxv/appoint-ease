@extends('layouts.scaffold')

@section('content')
    <div class="relative bg-white">
        <div class="mx-auto max-w-7xl">
            <div class="relative z-10 lg:w-full lg:max-w-2xl h-screen">
                <svg class="absolute inset-y-0 right-8 hidden h-full w-80 translate-x-1/2 transform fill-white lg:block"
                     viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="0,0 90,0 50,100 0,100"/>
                </svg>

                <div class="relative px-6 pt-6 lg:pl-8 lg:pr-0" x-data="{ showMenu: false }">
                    <nav class="flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">AppointEase</span>
                            <img alt="AppointEase" class="h-8 w-auto" src="{{ asset('images/logo.svg') }}">
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700 lg:hidden"
                                @click="showMenu = true">
                            <span class="sr-only">Open main menu</span>
                            <!-- Heroicon name: outline/bars-3 -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                            </svg>
                        </button>
                        <div class="hidden lg:ml-12 lg:block lg:space-x-14">
                            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Product</a>

                            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Features</a>

                            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900">Sign
                                Up</a>

                            <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">Sign
                                In</a>
                        </div>
                    </nav>
                    <!-- Mobile menu, show/hide based on menu open state. -->
                    <div role="dialog" aria-modal="true" x-show="showMenu">
                        <div class="fixed inset-0 z-10 overflow-y-auto bg-white px-6 py-6 lg:hidden">
                            <div class="flex flex-row-reverse items-center justify-between">
                                <button type="button" @click="showMenu = false"
                                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                                    <span class="sr-only">Close menu</span>
                                    <!-- Heroicon name: outline/x-mark -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                         aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                                <a href="#" class="-m-1.5 p-1.5">
                                    <span class="sr-only">AppointEase</span>
                                    <img class="h-8" src="{{ asset('images/logo.svg') }}" alt="">
                                </a>
                            </div>
                            <div class="mt-6 space-y-2">
                                <a href="#"
                                   class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Product</a>

                                <a href="#"
                                   class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Features</a>

                                <a href="{{ route('register') }}"
                                   class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Sign
                                    up</a>

                                <a href="{{ route('login') }}"
                                   class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Sign
                                    in</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative py-32 px-6 sm:py-40 lg:py-40 lg:px-8 lg:pr-0">
                    <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
                        <div class="hidden sm:mb-10 sm:flex">
                            {{-- <div
                                class="relative rounded-full py-1 px-3 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                                Anim aute id magna aliqua ad ad non deserunt sunt. <a href="#"
                                    class="whitespace-nowrap font-semibold text-indigo-600"><span class="absolute inset-0"
                                        aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
                            </div> --}}
                        </div>
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Simplify Booking with
                            AppointEase</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            Effortlessly book appointments online, anytime.
                            Simplify your healthcare scheduling with just a few clicks.</p>
                        <div class="mt-10 flex items-center gap-x-6">
                            <a href="{{ route('register') }}"
                               class="rounded-md bg-indigo-600 px-3.5 py-1.5 text-base font-semibold leading-7 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                                started
                            </a>
                            <a href="#" class="text-base font-semibold leading-7 text-gray-900">Learn more <span
                                    aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="aspect-[3/2] object-cover lg:aspect-auto lg:h-full lg:w-full"
                 src="{{ asset('images/illustrations/landing.jpg') }}" alt="">
        </div>
    </div>
@endsection
