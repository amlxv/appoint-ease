<div class="px-4 sm:px-0 lg:px-0">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">{{ $title }}</h1>
            <p class="mt-2 text-sm text-gray-700">{{ $description }}</p>
        </div>
        @if($route && $addButtonText)
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ $route }}"
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    {{ $addButtonText }}
                </a>
            </div>
        @endif
    </div>

    @if(session()->has('status'))
        <x-alert custom-class="mt-6" :type="session('status')" :message="session('message')"/>
    @endif

    <div class="mt-8 ">
        {{ $slot }}
    </div>
</div>
